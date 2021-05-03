<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\ValueObjects;

use ChrisHarrison\VoGenerator\Attributes\Enriches;

#[Enriches('Filepath')]
trait FilepathTrait
{
    public function hookConstruct(callable $inner, $value)
    {
        $inner([
            'root' => ($value['root'] ?? null) !== null ? rtrim($value['root'], '/') : null,
            'base' => ($value['base'] ?? null) !== null ? trim($value['base'], '/') : null,
            'filename' => ($value['filename'] ?? null) !== null ? $value['filename'] : null,
            'extension' => ($value['extension'] ?? null) !== null ? ltrim($value['extension'], '.') : null,
        ]);
    }

    public function full(): string
    {
        $path = array_filter([$this->root()->toNative(), $this->base()->toNative(), $this->filename()->toNative()], function ($part) {
            return strlen($part ?? '') > 0;
        });
        return implode('/', $path) . ".{$this->extension()->toNative()}";
    }

    public function filenameAndExtension(): string
    {
        return "{$this->filename()->toNative()}.{$this->extension()->toNative()}";
    }

    public function rootAndBase(): string
    {
        return "{$this->root()->toNative()}/{$this->base()->toNative()}";
    }

    public static function fromString(string $string): static
    {
        $info = pathinfo($string);
        return new static([
            'root' => $info['dirname'],
            'base' => '',
            'filename' => $info['filename'],
            'extension' => $info['extension'],
        ]);
    }
}
