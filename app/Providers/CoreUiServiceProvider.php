<?php

namespace App\Providers;

use App\Helpers\CoreUi\Cui;
use Illuminate\Support\ServiceProvider;

class CoreUiServiceProvider extends ServiceProvider
{
    public function register()
    {
        app()->singleton('cui', function(){
            return new \App\Helpers\CoreUi\Cui();
        });
    }

    public function boot()
    {
        //
    }
}
