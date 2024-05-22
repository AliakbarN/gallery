<?php

namespace App\Services\FileManager\DTO;

class FileName
{
    protected string $origin;
    protected string $baseName;
    protected string $extension;

    public function __construct(string $origin)
    {
        $this->origin = $origin;

        $this->parse();
    }

    protected function parse(): void
    {
        $fileName = $this->origin;

        $pos = strrpos($fileName, '.');

        $extension = substr($fileName, $pos);
        $baseName = str_replace($extension, '', $fileName);

        $this->extension = strtolower($extension);
        $this->baseName = $baseName;
    }

    /**
     * @param string $origin
     * @return FileName
     */
    public function setOrigin(string $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrigin(): string
    {
        return $this->origin;
    }

    /**
     * @return string
     */
    public function getBaseName(): string
    {
        return $this->baseName;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }
}
