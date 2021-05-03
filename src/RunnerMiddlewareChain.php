<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021;

use ValueObjects\Artifacts;

final class RunnerMiddlewareChain implements RunnerMiddleware
{
    /**
     * @var RunnerMiddleware[]
     */
    private $middleware;

    public function __construct(array $middleware)
    {
        $this->middleware = $middleware;
    }

    public function run(callable $stack): Artifacts
    {
        foreach ($this->middleware as $middleware) {
            $stack = function () use ($middleware, $stack) {
                return $middleware->run($stack);
            };
        }
        return $stack();
    }
}
