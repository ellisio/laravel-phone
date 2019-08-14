<?php

namespace EllisIO\Phone\Facades;

use EllisIO\Phone\Contracts\Factory;
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
        return Factory::class;
    }
}
