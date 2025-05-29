<?php

namespace App\Providers;

use App\Interfaces\AuthInterface;
use App\Interfaces\UserInterface;
use App\Repositories\AuthRepository;
use App\Repositories\UserRepository;
use App\Services\AuthServices;
use App\Services\UserServices;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthInterface::class, AuthRepository::class,AuthServices::class);
        $this->app->bind(UserInterface::class, UserRepository::class,UserServices::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
