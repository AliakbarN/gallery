<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PhotoController;

Route::prefix('/photos')->group(function ()
{
    Route::get('/all', [PhotoController::class, 'all'])
        ->name('api.photos.all');

    Route::get('/{id}', [PhotoController::class, 'getPhoto'])
        ->name('api.photos.getPhoto');
});
