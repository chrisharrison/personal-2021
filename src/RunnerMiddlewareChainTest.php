<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021;

use ChrisHarrison\Personal2021\Output\OutputStream;
use PHPUnit\Framework\TestCase;
use ValueObjects\Artifact;

final class RunnerMiddlewareChainTest extends TestCase
{
    public function test_it_runs_all_inner_middleware()
    {
        $buffer = new class {
            private array $buffer = [];

            public function buffer(string $description): void
            {
                $this->buffer[] = $description;
            }

            public function get(): array
            {
                return $this->buffer;
            }
        };

        $testMiddleware = new class ($buffer) implements RunnerMiddleware
        {
            private $buffer;

            public function __construct($buffer)
            {
                $this->buffer = $buffer;
            }

            public function run(callable $stack, OutputStream $output)
            {
                $this->buffer->buffer('before');
                $out = $stack();
                $this->buffer->buffer('after-' . $out);
                return $out;
            }
        };

        $output = new class implements OutputStream
        {
            public function write(Artifact $artifact): void
            {
            }

            public function flush(): void
            {
            }
        };

        $chain = new RunnerMiddlewareChain([$testMiddleware, $testMiddleware, $testMiddleware]);
        $chain->run(function () use ($buffer) {
            $buffer->buffer('action');
            return 'dummy-output';
        }, $output);

        $this->assertEquals(
            ['before', 'before', 'before', 'action', 'after-dummy-output', 'after-dummy-output', 'after-dummy-output'],
            $buffer->get(),
        );
    }
}
