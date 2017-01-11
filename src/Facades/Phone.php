<?php

namespace EllisIO\Phone\Facades;

use Illuminate\Support\Facades\Facade;

class Phone extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'phone';
    }
}
