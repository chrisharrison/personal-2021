<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021;

use ValueObjects\Artifacts;

interface RunnerMiddleware
{
    public function run(callable $stack): Artifacts;
}
