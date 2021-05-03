<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021;

use ValueObjects\Artifact;

interface Pipeline
{
    public function run(Artifact $artifact): Artifact;
}
