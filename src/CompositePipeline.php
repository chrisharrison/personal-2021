<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021;

use ValueObjects\Artifact;

final class CompositePipeline implements Pipeline
{
    private array $pipelines;

    public function __construct(array $pipelines)
    {
        $this->pipelines = $pipelines;
    }

    public function run(Artifact $artifact): Artifact
    {
        return array_reduce($this->pipelines, function (Artifact $artifact, Pipeline $pipeline) {
            return $pipeline->run($artifact);
        }, $artifact);
    }
}
