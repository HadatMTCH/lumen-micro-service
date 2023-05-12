<?php

namespace App\Providers;

use App\Http\Services\City\CityService;
use App\Http\Services\City\CityServiceInterface;
use App\Http\Services\Country\CountryService;
use App\Http\Services\Country\CountryServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CountryServiceInterface::class,CountryService::class);
        $this->app->bind(CityServiceInterface::class,CityService::class);
    }
}
