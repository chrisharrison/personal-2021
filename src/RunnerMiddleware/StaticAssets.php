<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\RunnerMiddleware;

use ChrisHarrison\Personal2021\Input\InputProvider;
use ChrisHarrison\Personal2021\RunnerMiddleware;
use ValueObjects\Artifact;
use ValueObjects\Artifacts;

final class StaticAssets implements RunnerMiddleware
{
    private $assetsInput;

    public function __construct(InputProvider $assetsInput)
    {
        $this->assetsInput = $assetsInput;
    }

    public function run(callable $stack): Artifacts
    {
        $artifacts = $stack();
        $this->assetsInput->provide()->iterate(function (Artifact $artifact) use (&$artifacts) {
            $artifacts = $artifacts->add($artifact);
        });
        return $artifacts;
    }
}
