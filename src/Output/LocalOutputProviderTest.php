<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\Output;

use PHPUnit\Framework\TestCase;

final class LocalOutputProviderTest extends TestCase
{
    public function test_it_provides_a_local_input_stream()
    {
        $subject = new LocalOutputProvider('root');
        $this->assertInstanceOf(LocalOutputStream::class, $subject->provide());
    }
}
