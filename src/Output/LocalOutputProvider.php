<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\Output;

final class LocalOutputProvider implements OutputProvider
{
    private string $rootPath;

    public function __construct(string $rootPath)
    {
        $this->rootPath = $rootPath;
    }

    public function provide(): OutputStream
    {
        return new LocalOutputStream($this->rootPath);
    }
}
