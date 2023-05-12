<?php

namespace App\Providers;

use App\Http\Repository\City\CityRepository;
use App\Http\Repository\City\CityRepositoryInterface;
use App\Http\Repository\Country\CountryRepository;
use App\Http\Repository\Country\CountryRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CountryRepositoryInterface::class,CountryRepository::class);
        $this->app->bind(CityRepositoryInterface::class,CityRepository::class);
    }
}
