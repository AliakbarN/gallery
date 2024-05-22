<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PhotoController extends Controller
{

    protected array $defaultHeaders = [
        'Content-Type' => 'application/json'
    ];

    public function all(): ResponseFactory|Application|Response|\Illuminate\Foundation\Application
    {
        $photos = Photo::all();

        return response($photos->toJson(), headers: $this->defaultHeaders);
    }

    public function getPhoto(int $id): ResponseFactory|Application|Response|\Illuminate\Foundation\Application
    {
        $photo = Photo::find($id);

        if ($photo === null) {
            return response('Not found', status: 404);
        }

        return response($photo->toJson(), headers: $this->defaultHeaders);
    }
}
