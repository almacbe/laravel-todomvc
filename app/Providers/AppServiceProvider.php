<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Todo\Domain\TodoRepository;
use Todo\Infrastructure\Persistence\Eloquent\TaskRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TodoRepository::class,
            TaskRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
