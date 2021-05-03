<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021;

use ChrisHarrison\Personal2021\Input\InputProvider;
use ChrisHarrison\Personal2021\Input\InputStream;
use ChrisHarrison\Personal2021\Output\OutputProvider;
use ChrisHarrison\Personal2021\Output\OutputStream;
use PHPUnit\Framework\TestCase;
use ValueObjects\Artifact;
use ValueObjects\Artifacts;
use ValueObjects\Filepath;

final class PipelineRunnerTest extends TestCase
{
    public function test_it_iterates_a_pipeline_through_an_input_stream_and_streams_to_output()
    {
        $filepath = Filepath::fromNative(['root' => 'a', 'filename' => 'b', 'extension' => 'c']);

        $outputExpectation = function (Artifacts $artifacts) use ($filepath) {
            $this->assertEquals([
                [
                    'title' => null,
                    'body' => '0-pipelined',
                    'filepath' => $filepath->toNative(),
                ],
                [
                    'title' => null,
                    'body' => '1-pipelined',
                    'filepath' => $filepath->toNative(),
                ],
                [
                    'title' => null,
                    'body' => '2-pipelined',
                    'filepath' => $filepath->toNative(),
                ],
                [
                    'title' => null,
                    'body' => 'middleware-provided',
                    'filepath' => $filepath->toNative(),
                ],
            ], $artifacts->toNative());
        };

        $pipeline = new class implements Pipeline
        {
            public function run(Artifact $artifact): Artifact
            {
                return $artifact->withBody($artifact->body()->toNative() . '-pipelined');
            }
        };

        $middleware = new class ($filepath) implements RunnerMiddleware
        {
            private $filepath;

            public function __construct(Filepath $filepath)
            {
                $this->filepath = $filepath;
            }

            public function run(callable $stack, OutputStream $output): void
            {
                $stack();
                $output->write(Artifact::fromNative([
                    'title' => null,
                    'body' => 'middleware-provided',
                    'filepath' => $this->filepath->toNative(),
                ]));
            }
        };

        $inputStream = new class ($filepath) implements InputStream
        {
            private $filepath;

            public function __construct($filepath)
            {
                $this->filepath = $filepath;
            }

            public function iterate(callable $callback): void
            {
                for ($i = 0; $i < 3; $i++) {
                    $callback(Artifact::fromNative(['body' => (string) $i, 'filepath' => $this->filepath->toNative()]));
                }
            }
        };

        $outputStream = new class ($outputExpectation) implements OutputStream
        {
            private $outputExpectation;
            private $artifacts;

            public function __construct(callable $outputExpectation)
            {
                $this->outputExpectation = $outputExpectation;
                $this->artifacts = Artifacts::null();
            }

            public function write(Artifact $artifact): void
            {
                $this->artifacts = $this->artifacts->add($artifact);
            }

            public function flush(): void
            {
                $outputExpectation = $this->outputExpectation;
                $outputExpectation($this->artifacts);
            }
        };

        $inputProvider = new class ($inputStream) implements InputProvider
        {
            private $input;

            public function __construct($input)
            {
                $this->input = $input;
            }

            public function provide(): InputStream
            {
                return $this->input;
            }
        };

        $outputProvider = new class ($outputStream) implements OutputProvider
        {
            private $output;

            public function __construct($output)
            {
                $this->output = $output;
            }

            public function provide(): OutputStream
            {
                return $this->output;
            }
        };

        $subject = new PipelineRunner($pipeline, $middleware, $inputProvider, $outputProvider);

        $subject->run();
    }
}
