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
        //self::setNewRoutes();
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        self::setNewRoutes();
    }

    static function setNewRoutes(){
        Route::group([
            'prefix'=>'admin/expanses',
            'as'=>'admin.expanses.',
            'middleware' => ['web', 'admin']
        ], function() {
            Route::get('/', ['\\Hted35\\Country', 'index'])->name('index');
            Route::get('/country', ['\\Hted35\\Country', 'countryList'] )->name('country');
            Route::get('/country/{id}', ['\\Hted35\\Country', 'countryView'] )->name('country.view');
            Route::post('/country/{id}', ['\\Hted35\\Country', 'countrySave'] )->name('country.save');
        });
    }
}
