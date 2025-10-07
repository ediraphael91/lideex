<?php

namespace App\Providers;

use App\Repositories\EloquentCursoRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\CursoRepositoryInterface;
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void

    {
        //$this->app->bind() le dice a Laravel:
        //“Cuando alguien pida CursoRepositoryInterface,
        // dale un EloquentCursoRepository”.
        $this->app->bind(
            CursoRepositoryInterface::class,
            EloquentCursoRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
