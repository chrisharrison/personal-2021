<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021;

use PHPUnit\Framework\TestCase;
use ValueObjects\Artifact;

final class CompositePipelineTest extends TestCase
{
    public function test_it_runs_all_pipelines(): void
    {
        $artifact = Artifact::fromNative(['body' => '0', 'filepath' => ['root' => 'a', 'filename' => 'b', 'extension' => 'c']]);

        $pipelines = array_map(function ($i) {
            return new class ($i) implements Pipeline
            {
                private $i;

                public function __construct($i)
                {
                    $this->i = $i;
                }

                public function run(Artifact $artifact): Artifact
                {
                    return $artifact->withBody($artifact->body()->toNative() . $this->i);
                }
            };
        }, ['1', '2', '3']);

        $subject = new CompositePipeline($pipelines);
        $out = $subject->run($artifact);

        $this->assertEquals('0123', $out->body()->toNative());
    }
}
