<?php

namespace EllisIO\Tests\Phone;

use EllisIO\Phone\PhoneFactory;
use EllisIO\Phone\Contracts\Driver;

class FactoryTest extends AbstractTestCase
{
    public function testDriver()
    {
        $factory = $this->getFactory();

        $this->assertInstanceOf(Driver::class, $factory->driver());
    }

    public function testGetDefaultDriver()
    {
        $factory = $this->getFactory();
        $config = $this->app->config->get('phone');

        $this->assertSame($config['default'], $factory->getDefaultDriver());
    }

    public function testSetDefaultDriver()
    {
        $factory = $this->getFactory();
        $factory->setDefaultDriver('test');

        $this->assertSame('test', $factory->getDefaultDriver());
    }

    protected function getFactory()
    {
        return new PhoneFactory($this->app->config->get('phone'));
    }
}
