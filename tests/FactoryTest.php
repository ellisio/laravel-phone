<?php

namespace EllisIO\Tests\Phone;

use InvalidArgumentException;
use EllisIO\Phone\PhoneManager;
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

    public function testUndefinedConfig()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Driver [test] not supported.');

        $factory = $this->getFactory();
        $factory->driver('test');
    }

    public function testUndefinedDriver()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Driver [test] not supported.');

        $this->app->config->set('phone.drivers.test', []);
        $factory = new PhoneManager($this->app);
        $factory->driver('test');
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
        return new PhoneManager($this->app);
    }
}
