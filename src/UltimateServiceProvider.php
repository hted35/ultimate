<?php

namespace Hted35;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class UltimateServiceProvider extends ServiceProvider{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        self::setNewRoutes();
        view()->addLocation(__DIR__.'/../templates');

    }

    static function setNewRoutes(){
        Route::group([
            'prefix'=>'admin/expanses',
            'as'=>'admin.expanses.',
            'middleware' => ['web', 'admin']
        ], function() {
            Route::get('/', ['\\Hted35\\CountryController', 'index'])->name('index');
            Route::get('/country', ['\\Hted35\\CountryController', 'countryList'] )->name('country');
            Route::get('/country/{id}', ['\\Hted35\\CountryController', 'countryView'] )->name('country.view');
            Route::post('/country/{id}', ['\\Hted35\\CountryController', 'countrySave'] )->name('country.save');
        });

    }
}
