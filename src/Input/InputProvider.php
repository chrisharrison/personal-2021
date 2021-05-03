<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\Input;

interface InputProvider
{
    public function provide(): InputStream;
}
