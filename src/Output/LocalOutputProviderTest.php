<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\Input;

use ChrisHarrison\Personal2021\Output\LocalOutputProvider;
use ChrisHarrison\Personal2021\Output\LocalOutputStream;
use PHPUnit\Framework\TestCase;

final class LocalOutputProviderTest extends TestCase
{
    public function test_it_provides_a_local_input_stream()
    {
        $subject = new LocalOutputProvider('root');
        $this->assertInstanceOf(LocalOutputStream::class, $subject->provide());
    }
}
