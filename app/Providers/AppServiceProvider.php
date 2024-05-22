<?php

namespace App\Providers;

use App\Services\FileManager;
use App\Services\Searcher;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $baseFilesPath = env('PHOTOS_BASE_PATH', '/uploads');

        $this->app->singleton(FileManager::class, function (Application $app) use ($baseFilesPath)
        {
            return new FileManager($baseFilesPath);
        });

        $this->app->singleton(Searcher::class, function (Application $app)
        {
            return new Searcher();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
