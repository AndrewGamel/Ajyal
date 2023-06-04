<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

use function PHPSTORM_META\type;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       Validator::extend('filter',function($attribute,$value,$params){
        return ! in_array($value,$params);
       } , 'The value is prohibited!');




    }
}