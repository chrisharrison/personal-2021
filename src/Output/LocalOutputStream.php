<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\Output;

use ValueObjects\Artifact;

final class LocalOutputStream implements OutputStream
{
    private string $rootPath;

    public function __construct(string $rootPath)
    {
        $this->rootPath = $rootPath;
    }

    public function write(Artifact $artifact): void
    {
        $modifiedPath = $artifact->filepath()->withRoot($this->rootPath);

        if (!file_exists($modifiedPath->rootAndBase())) {
            mkdir($modifiedPath->rootAndBase(), 0777, true);
        }

        file_put_contents($modifiedPath->full(), $artifact->body()->toNative());
    }

    public function flush(): void
    {
    }
}
