<?php

namespace App\Services\FileManager\Traits;

use App\Services\FileManager\DTO\FileName;
use App\Services\Translator;
use DateTime;
use Illuminate\Support\Str;

trait CanGenerateFileName
{
    protected Translator $translator;

    protected function generateFileName(string $originName): string
    {
        $fileName = new FileName($originName);
        $translatedName = $this->translator->translate($fileName->getBaseName());

        return $this->formName($translatedName, $fileName->getExtension());
    }

    protected function generateFileID(): string
    {
        $dateTime = new DateTime();
        $uniqueID = Str::random(8);

        return ($uniqueID . '__' . $dateTime->format('Y_m_d_His'));
    }

    protected function formName(string $translatedName, string $extension): string
    {
        $normalized = str_replace(' ', '_', trim($translatedName));
        return (strtolower($normalized) . '_' . $this->generateFileID() . $extension);
    }

    protected function getTranslatedNameFromPath(string $path): string
    {
        $pos = strrpos($path, '/');

        return substr($path, $pos + 1);
    }

    protected function setTranslator(): void
    {
        $translator = new Translator();

        $translator
            ->setTarget('en')
            ->setSource('ru');

        $this->translator = $translator;
    }
}
