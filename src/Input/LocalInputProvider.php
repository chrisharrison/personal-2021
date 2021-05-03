<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\Input;

final class LocalInputProvider implements InputProvider
{
    private string $rootPath;

    public function __construct(string $rootPath)
    {
        $this->rootPath = $rootPath;
    }

    public function provide(): InputStream
    {
        return new LocalInputStream($this->rootPath);
    }
}
