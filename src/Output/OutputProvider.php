<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\Output;

interface OutputProvider
{
    public function provide(): OutputStream;
}
