<?php

declare(strict_types=1);

namespace ChrisHarrison\Personal2021\Input;

use PHPUnit\Framework\TestCase;

final class LocalInputProviderTest extends TestCase
{
    public function test_it_provides_a_local_input_stream()
    {
        $subject = new LocalInputProvider('root');
        $this->assertInstanceOf(LocalInputStream::class, $subject->provide());
    }
}
