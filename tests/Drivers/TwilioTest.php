<?php

namespace EllisIO\Tests\Phone\Drivers;

use EllisIO\Phone\Phone;
use EllisIO\Tests\Phone\AbstractTestCase;
use EllisIO\Phone\Facades\Phone as PhoneFacade;

class TwilioTest extends AbstractTestCase
{
    public function testGetPhone()
    {
        $driver = $this->getDriver();
        $phone = $this->getPhone();

        $driverNumber = $driver->getPhone('4153902337');

        $this->assertInstanceOf(Phone::class, $driverNumber);
        $this->assertSame($phone->getNumber(), $driverNumber->getNumber());
    }

    public function testFormatNumber()
    {
        $driver = $this->getDriver();
        $phone = $this->getPhone();

        $this->assertSame($phone->getFormattedNumber(), $driver->formatNumber('4153902337'));
    }

    protected function getPhone()
    {
        return new Phone('+14153902337', '(415) 390-2337', 'US');
    }

    protected function getDriver()
    {
        return PhoneFacade::driver('twilio');
    }
}
