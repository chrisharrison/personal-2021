<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021;

use ChrisHarrison\Personal2021\Input\InputProvider;
use ChrisHarrison\Personal2021\Output\OutputProvider;
use ValueObjects\Artifact;
use ValueObjects\Artifacts;

final class PipelineRunner
{
    private Pipeline $pipeline;
    private RunnerMiddleware $middleware;
    private InputProvider $inputProvider;
    private OutputProvider $outputProvider;

    public function __construct(
        Pipeline $pipeline,
        RunnerMiddleware $middleware,
        InputProvider $inputProvider,
        OutputProvider $outputProvider,
    ) {
        $this->pipeline = $pipeline;
        $this->middleware = $middleware;
        $this->inputProvider = $inputProvider;
        $this->outputProvider = $outputProvider;
    }

    public function run(): void
    {
        $inputStream = $this->inputProvider->provide();
        $outputStream = $this->outputProvider->provide();

        $stack = function () use ($inputStream, $outputStream) {
            $artifacts = Artifacts::null();
            $inputStream->iterate(function (Artifact $artifact) use ($outputStream, &$artifacts) {
                $artifacts = $artifacts->add($this->pipeline->run($artifact));
            });
            return $artifacts;
        };

        $this->middleware->run($stack)->iterate(function (Artifact $artifact) use ($outputStream) {
            $outputStream->write($artifact);
        });
    }
}
