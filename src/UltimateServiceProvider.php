<?php

namespace Hted35;

use Illuminate\Support\ServiceProvider;

class UltimateServiceProvider extends ServiceProvider{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->setRoutes();
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }

    private function setRoutes(){
        Route::middleware('admin')->group(function () {
            //Plugins
            Route::name('expanses.')->prefix('expanses')->controller('\\Hted35\\Country')->group(function(){
                Route::get('/','index')->name('index');
                Route::get('/country','countryList')->name('country');
                Route::get('/country/{id}','countryView')->name('country.view');
                Route::post('/country/{id}','countrySave')->name('country.save');
            });
        });
    }
}
