<?php

namespace App\Providers;

use App\Item;
use App\User;
use App\Observers\ItemObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Item::observe(ItemObserver::class);
        User::observe(UserObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        Schema::defaultStringLength(191);
        $this->app->bind(
        'App\Gestion\EleveInterface', 
        'App\Gestion\EleveImpl'
         );
        $this->app->bind(
        'App\Gestion\NiveauInterface', 
        'App\Gestion\NiveauImpl'
         );
        $this->app->bind(
        'App\Gestion\AdminInterface', 
        'App\Gestion\AdminImpl'
         );
        $this->app->bind(
        'App\Gestion\GroupeInterface', 
        'App\Gestion\GroupeImp'
         );
        $this->app->bind(
        'App\Gestion\EmployerInterface', 
        'App\Gestion\EmployerImpl'
         );
    }
}
