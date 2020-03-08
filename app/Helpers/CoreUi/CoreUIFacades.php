<?php


namespace App\Helpers\CoreUi;


use Illuminate\Support\Facades\Facade;

class CoreUIFacades extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cui';
    }

}
