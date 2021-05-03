<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021;

use ChrisHarrison\Personal2021\Output\OutputStream;
use PHPUnit\Framework\TestCase;
use ValueObjects\Artifact;
use ValueObjects\Artifacts;
use ValueObjects\Filepath;

final class RunnerMiddlewareChainTest extends TestCase
{
    public function test_it_runs_all_inner_middleware()
    {
        $testMiddleware = new class implements RunnerMiddleware
        {
            public function run(callable $stack): Artifacts
            {
                $out = Artifacts::null()->add(Artifact::fromNative([
                    'title' => 'before',
                    'filepath' => Filepath::fromString('blah.txt')->toNative(),
                    'body' => 'blah',
                ]));

                $out = $out->addMany($stack());

                return $out->add(Artifact::fromNative([
                    'title' => 'after',
                    'filepath' => Filepath::fromString('blah.txt')->toNative(),
                    'body' => 'blah',
                ]));
            }
        };

        $chain = new RunnerMiddlewareChain([$testMiddleware, $testMiddleware, $testMiddleware]);
        $artifacts = $chain->run(function () {
            return Artifacts::null()->add(Artifact::fromNative([
                'title' => 'action',
                'filepath' => Filepath::fromString('blah.txt')->toNative(),
                'body' => 'blah',
            ]));
        });

        $this->assertEquals(
            ['before', 'before', 'before', 'action', 'after', 'after', 'after'],
            $artifacts->reduce(function (array $acc, Artifact $artifact) {
                $acc[] = $artifact->title()->toNative();
                return $acc;
            }, [])
        );
    }
}
