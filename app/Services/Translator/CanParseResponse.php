<?php

namespace App\Services\Translator;

use App\Helpers\ArrayNavigator;

trait CanParseResponse
{
    protected static array $responsesParsePath = [
        'translate' => 'data.translations.translatedText',
    ];

    public static function parse(string $endpoint, string $response): mixed
    {
        $response = json_decode($response, true);
        $path = self::$responsesParsePath[$endpoint];

        return ArrayNavigator::get($response, $path);
    }
}
