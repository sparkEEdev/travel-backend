<?php

namespace Tests\Unit;

use App\Concerns\FormatMoney;
use PHPUnit\Framework\TestCase;

class FormatMoneyTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_database_format_multiplies_by_hundred(): void
    {
        $this->assertEquals(1000, FormatMoney::toDatabase(10));
        $this->assertEquals(1000, FormatMoney::toDatabase(10.00));
        $this->assertEquals(1000, FormatMoney::toDatabase(10.0));
        $this->assertEquals(1000, FormatMoney::toDatabase('10'));
        $this->assertEquals(1000, FormatMoney::toDatabase('10.00'));
        $this->assertEquals(1000, FormatMoney::toDatabase('10.0'));
        $this->assertNotEquals(1000, FormatMoney::toDatabase(10.01));
        $this->assertNotEquals(1000, FormatMoney::toDatabase('10.01'));
        $this->assertEquals(1001, FormatMoney::toDatabase('10.01'));
        $this->assertEquals(1010, FormatMoney::toDatabase('10.10'));
    }

    public function test_readable_format_subtracts_by_hundred(): void
    {
        $this->assertEquals(10, FormatMoney::toReadable(1000));
        $this->assertEquals(10, FormatMoney::toReadable('1000'));
        $this->assertEquals(10, FormatMoney::toReadable('1000'));
        $this->assertEquals(10, FormatMoney::toReadable('1000'));
        $this->assertNotEquals(10, FormatMoney::toReadable(1001));
        $this->assertNotEquals(10, FormatMoney::toReadable('1001'));
    }
}
