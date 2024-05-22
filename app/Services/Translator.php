<?php

namespace App\Services;

use App\Services\Translator\API;

class Translator
{
    protected ?string $target;
    protected ?string $source;
    protected API $api;

    public function __construct(?string $target = null, ?string $source = null)
    {
        $this->api = new API();
        $this->target = $target;
        $this->source = $source;
    }

    public function translate(string $text): string
    {
        $translatedRaw = $this->api->translate($this->source, $this->target, $text);

        return $this->api::parse('translate', $translatedRaw);
    }

    /**
     * @param string|null $source
     * @return Translator
     */
    public function setSource(?string $source): self
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @param string|null $target
     * @return Translator
     */
    public function setTarget(?string $target): self
    {
        $this->target = $target;

        return $this;
    }
}
