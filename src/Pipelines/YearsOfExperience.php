<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\Pipelines;

use ChrisHarrison\Clock\Clock;
use ChrisHarrison\Personal2021\Pipeline;
use DateTimeImmutable;
use ValueObjects\Artifact;

final class YearsOfExperience implements Pipeline
{
    private $clock;

    public function __construct(Clock $clock)
    {
        $this->clock = $clock;
    }

    public function run(Artifact $artifact): Artifact
    {
        $yearsOfExperience = DateTimeImmutable::createFromFormat('Y/m', '2009/05')
            ->diff($this->clock->now())->format('%y');

        return $artifact->withBody(strtr(
            $artifact->body()->toNative(),
            [
                '{$YEARS_OF_EXPERIENCE}' => $yearsOfExperience,
            ],
        ));
    }
}
