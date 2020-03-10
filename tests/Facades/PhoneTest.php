<?php

namespace EllisIO\Tests\Phone\Facades;

use EllisIO\Phone\Contracts\Factory;
use EllisIO\Phone\Facades\Phone as Facade;
use EllisIO\Phone\PhoneManager;
use EllisIO\Tests\Phone\AbstractTestCase;
use GrahamCampbell\TestBenchCore\FacadeTrait;

class PhoneTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return Factory::class;
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Facade::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return PhoneManager::class;
    }
}
