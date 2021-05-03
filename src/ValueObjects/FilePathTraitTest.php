<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\ValueObjects;

use PHPUnit\Framework\TestCase;
use ValueObjects\Filepath;

final class FilePathTraitTest extends TestCase
{
    public function test_full_returns_a_usable_filepath()
    {
        $filepath = Filepath::fromNative([
            'root' => 'a',
            'base' => 'b',
            'filename' => 'c',
            'extension' => 'd',
        ]);

        $this->assertEquals('a/b/c.d', $filepath->full());
    }

    public function test_filename_returns_base_and_extension()
    {
        $filepath = Filepath::fromNative([
            'root' => 'a',
            'base' => 'b',
            'filename' => 'c',
            'extension' => 'd',
        ]);

        $this->assertEquals('c.d', $filepath->filenameAndExtension());
    }

    public function test_it_instantiates_from_string_path()
    {
        $filepath = Filepath::fromString('test/path/bob.php');
        $this->assertEquals([
            'root' => 'test/path',
            'base' => '',
            'filename' => 'bob',
            'extension' => 'php',
        ], $filepath->toNative());
    }
}
