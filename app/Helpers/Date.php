<?php

namespace App\Helpers;

use Carbon\Carbon;

class Date
{
    public static function addOneDay(string $date, string $inputFormat = 'Y-m-d', string $outputFormat = 'Y-m-d'): string
    {
        $parsedDate = Carbon::createFromFormat($inputFormat, $date);

        $parsedDate->addDay();

        return $parsedDate->format($outputFormat);
    }
}
