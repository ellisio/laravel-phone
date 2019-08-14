<?php

namespace EllisIO\Tests\Phone;

use EllisIO\Phone\Contracts\Factory;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;

class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testPhoneManagerIsInjectable()
    {
        $this->assertIsInjectable(Factory::class);
    }
}
