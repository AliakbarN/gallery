<?php

namespace App\Services;

use App\Services\FileManager\Traits\CanGenerateFileName;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileManager
{
    use CanGenerateFileName;


    protected string $basePath;

    public function __construct(string $basePath)
    {
        $this->setValidateBasePath($basePath);

        $this->setTranslator();
    }

    public function save(array|UploadedFile $photo): array
    {
        if (!is_array($photo)) {
            $file = [$photo];
        }

        $paths = [];

        foreach ($photo as $item)
        {
            $filePath = $this->saveFile($item);
            $paths[$item->getClientOriginalName()] = ['path' => $filePath, 'translated' => $this->getTranslatedNameFromPath($filePath)];
        }

        return $paths;
    }

    public function delete(string|array $path): void
    {
        if (!is_array($path)) {
            $path = [$path];
        }

        foreach ($path as $item)
        {
            Storage::delete($item);
        }
    }

    public function get(string $path): ?string
    {
        return Storage::get($path);
    }

    public function mimeType(string $path): string|false
    {
        return Storage::mimeType($path);
    }

    protected function saveFile(UploadedFile $file): string
    {
        return $file->storeAs($this->generatePath($file->getClientOriginalName()));
    }

    protected function generatePath(string $fileName): string
    {
        $updatedFileName = $this->generateFileName($fileName);

        return $this->basePath . $updatedFileName;
    }

    protected function setValidateBasePath(string $path): void
    {
        if ($path[strlen($path) - 1] !== '/') {
            $path .= '/';
        }

        $this->basePath = $path;
    }

    /**
     * @param string $basePath
     */
    public function setBasePath(string $basePath): void
    {
        $this->setValidateBasePath($basePath);
    }
}
