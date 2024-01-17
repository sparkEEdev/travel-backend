<?php

namespace App\Concerns;

class FormatMoney
{
    public static function toDatabase(int|float $value): int
    {
        return $value * 100;
    }

    public static function toReadable(int $value): string
    {
        return number_format($value / 100, 2);
    }
}
