<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\CountryProvider;
use App\Services\RestCountriesProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         $this->app->bind(
        CountryProvider::class,
        RestCountriesProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
