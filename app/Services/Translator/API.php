<?php

namespace App\Services\Translator;

use GuzzleHttp\Client;

class API
{
    use CanParseResponse;


    protected static string $baseUrl = 'https://deep-translate1.p.rapidapi.com/language/{endpoint}/v2';
    protected static array $defaultHeaders = [
        'x-rapidapi-key'  => 'bd9a4727c7msh2826d9e9c6cbc82p112b63jsn7ab39c23bdb6',
        'x-rapidapi-host' => 'deep-translate1.p.rapidapi.com',
        'Content-Type'    => 'application/json',
    ];
    protected array $endpoints = [
        'translate',
    ];

    protected Client $httpClient;


    public function __construct()
    {
        $this->httpClient = new Client();
    }

    public function translate(string $source, string $target, string $text): string
    {
        $url = $this->generateUrl('translate');
        $data = $this->formData(['q' => $text, 'source' => $source, 'target' => $target]);

        $response = $this->httpClient->post($url, [
            'body' => $data,
            'headers' => self::$defaultHeaders,
        ]);

        return $response->getBody();
    }

    protected function generateUrl(string $endpoint): ?string
    {
        if (!in_array($endpoint, $this->endpoints)) {
            return null;
        }

        return str_replace('{endpoint}', $endpoint, self::$baseUrl);
    }

    protected function formData(array $data): string
    {
        return json_encode($data);
    }
}
