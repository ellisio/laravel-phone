<?php

namespace EllisIO\Tests\Phone;

use InvalidArgumentException;
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

    public function testUndefinedConfig()
    {
        try {
            $factory = $this->getFactory();
            $factory->driver('test');
        } catch (InvalidArgumentException $e) {
            $this->assertStringStartsWith('Config driver', $e->getMessage());
        }
    }

    public function testUndefinedDriver()
    {
        try {
            $config = $this->app->config->get('phone');
            $config['drivers']['test'] = [];

            $factory = new PhoneFactory($config);
            $factory->driver('test');
        } catch (InvalidArgumentException $e) {
            $this->assertStringStartsWith('Method', $e->getMessage());
        }
    }

    public function testMagicCall()
    {
        $factory = $this->getFactory();
        $phone1 = $factory->formatNumber('+14153902337');
        $phone2 = $factory->driver()->formatNumber('+14153902337');

        $this->assertSame($phone1, $phone2);
    }

    protected function getFactory()
    {
        return new PhoneFactory($this->app->config->get('phone'));
    }
}
