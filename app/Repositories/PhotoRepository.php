<?php

namespace App\Repositories;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Collection;

class PhotoRepository
{
    public function getLatestPhotos(int $limit): Collection
    {
        return Photo::latest()->take($limit)->get();
    }

    public function createPhotos(array $data): void
    {
        foreach ($data as $originalName => $item) {
            Photo::create([
                'path' => $item['path'],
                'original_name' => $originalName,
                'translated_name' => $item['translated'],
            ]);
        }
    }

    public function getPhotosWithOffset(int $offset, int $amount): Collection
    {
        return Photo::skip($offset * $amount)->take($amount)->get();
    }
}
