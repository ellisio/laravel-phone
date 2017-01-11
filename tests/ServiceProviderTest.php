<?php

namespace EllisIO\Tests\Phone;

use EllisIO\Phone\PhoneFactory;
use EllisIO\Phone\Contracts\Factory as FactoryContact;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;

class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testPhoneFactoryIsInjectable()
    {
        $this->assertIsInjectable(PhoneFactory::class);
        $this->assertIsInjectable(FactoryContact::class);
    }
}
