<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\Output;

use PHPUnit\Framework\TestCase;
use ValueObjects\Artifact;

final class LocalOutputStreamTest extends TestCase
{
    public function test_it_writes_files_to_directory()
    {
        $artifact1 = Artifact::fromNative([
            'body' => 'dummy body 1',
            'filepath' => [
                'root' => '/boo',
                'filename' => 'dummy1',
                'extension' => 'html',
            ],
        ]);

        $artifact2 = Artifact::fromNative([
            'body' => 'dummy body 2',
            'filepath' => [
                'root' => '/boo',
                'filename' => 'dummy2',
                'extension' => 'md',
            ],
        ]);

        $root = __DIR__ . '/mocks';

        $subject = new LocalOutputStream($root);
        $subject->write($artifact1);
        $subject->write($artifact2);
        $subject->flush();

        $output1 = file_get_contents($artifact1->withFilepath($artifact1->filepath()->withRoot($root))->filepath()->full());
        $output2 = file_get_contents($artifact2->withFilepath($artifact2->filepath()->withRoot($root))->filepath()->full());

        $this->assertEquals('dummy body 1', $output1);
        $this->assertEquals('dummy body 2', $output2);

        rrmdir($root);
    }
}
