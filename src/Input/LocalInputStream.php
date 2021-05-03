<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\Input;

use FilesystemIterator;
use Symfony\Component\Yaml\Yaml;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;
use ValueObjects\Artifact;
use ValueObjects\Filepath;

final class LocalInputStream implements InputStream
{
    private string $rootPath;

    public function __construct(string $rootPath)
    {
        $this->rootPath = $rootPath;
    }

    public function iterate(callable $callback): void
    {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(
            $this->rootPath,
            FilesystemIterator::SKIP_DOTS,
        ));

        foreach ($iterator as $file) {
            /** @var SplFileInfo $file */

            if ($file->getExtension() === 'yml') {
                continue;
            }

            $filepath = Filepath::fromNative([
                'root' => $this->rootPath,
                'base' => substr($file->getPath(), strlen($this->rootPath)),
                'filename' => $file->getBasename('.' . $file->getExtension()),
                'extension' => $file->getExtension(),
            ]);

            $metadataPath = $filepath->withExtension('yml')->full();
            if (file_exists($metadataPath)) {
                $metadata = Yaml::parse(file_get_contents($metadataPath));
            } else {
                $metadata = [];
            }

            $artifact = Artifact::fromNative([
                'title' => $metadata['title'] ?? null,
                'filepath' => $filepath->toNative(),
                'body' => file_get_contents($file->getPathname()),
            ]);
            $callback($artifact);
        }
    }
}
