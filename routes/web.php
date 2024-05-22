<?php

use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/photos');

Route::get('/test', function ()
{

});

Route::resource('photos', PhotoController::class)
    ->except(['edit', 'update']);

Route::post('/photos/search', [PhotoController::class, 'index'])
    ->name('photos.index.search');

Route::prefix('photos')->group(function ()
{
    Route::get('/fetch/{offset}', [PhotoController::class, 'fetch'])
        ->name('photos.fetch');

    Route::get('/search', [PhotoController::class, 'search'])
        ->name('photos.search.index');

    Route::get('/download/{photo}', [PhotoController::class, 'download'])
        ->name('photos.download');
});
