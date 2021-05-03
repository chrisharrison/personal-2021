<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\Input;

use PHPUnit\Framework\TestCase;
use ValueObjects\Artifact;
use ValueObjects\Artifacts;

final class LocalInputStreamTest extends TestCase
{
    public function test_it_streams_files_in_directory()
    {
        $artifacts = Artifacts::null();

        $subject = new LocalInputStream(__DIR__ . '/mocks');
        $subject->iterate(function (Artifact $artifact) use (&$artifacts) {
            $artifacts = $artifacts->add($artifact);
        });

        $this->assertEquals('Dummy body 1', $artifacts->atIndex(0)->body()->toNative());
        $this->assertEquals('test.html', $artifacts->atIndex(0)->filepath()->filenameAndExtension());
        $this->assertEquals('Test Title', $artifacts->atIndex(0)->title()->toNative());

        $this->assertEquals('Dummy body 2', $artifacts->atIndex(1)->body()->toNative());
        $this->assertEquals('test.md', $artifacts->atIndex(1)->filepath()->filenameAndExtension());

        $this->assertEquals('Dummy body 3', $artifacts->atIndex(2)->body()->toNative());
        $this->assertEquals('test2.md', $artifacts->atIndex(2)->filepath()->filenameAndExtension());
    }
}
