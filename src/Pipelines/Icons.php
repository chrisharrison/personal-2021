<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\Pipelines;

use ChrisHarrison\Personal2021\Pipeline;
use ValueObjects\Artifact;

final class Icons implements Pipeline
{
    public function run(Artifact $artifact): Artifact
    {
        return $artifact->withBody(strtr(
            $artifact->body()->toNative(),
            [
                '{$MAP}' => '<i class="fa fa-map-marker" aria-hidden="true"></i>',
                '{$CAL}' => '<i class="fa fa-calendar" aria-hidden="true"></i>',
            ],
        ));
    }
}
