<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\Output;

use ValueObjects\Artifact;

interface OutputStream
{
    public function write(Artifact $artifact): void;
    public function flush(): void;
}
