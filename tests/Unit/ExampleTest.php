<?php

namespace Tests\Unit;

use App\Support\Terbilang;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Terbilang converts numbers to Indonesian words.
     */
    public function test_terbilang_converts_numbers(): void
    {
        $this->assertSame('Seratus', Terbilang::make(100));
        $this->assertSame('Seribu', Terbilang::make(1000));
        $this->assertSame('Satu Juta', Terbilang::make(1000000));
    }
}
