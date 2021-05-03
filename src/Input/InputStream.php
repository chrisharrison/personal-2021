<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\Input;

interface InputStream
{
    public function iterate(callable $callback): void;
}
