<?php

namespace EllisIO\Tests\Phone;

use EllisIO\Phone\Phone;
use InvalidArgumentException;

class PhoneTest extends AbstractTestCase
{
    public function testE164Compliancy()
    {
        $this->expectException(InvalidArgumentException::class);
        new Phone('test', 'test', 'test');
    }

    public function testISO3166Alpha2Compliancy()
    {
        $this->expectException(InvalidArgumentException::class);
        new Phone('+14153902337', '(415) 390-2337', 'test');
    }

    public function testGetNumber()
    {
        $phone = $this->getPhone();

        $this->assertSame('+14153902337', $phone->getNumber());
    }

    public function testGetNationalNumber()
    {
        $phone = $this->getPhone();

        $this->assertSame('4153902337', $phone->getNationalNumber());
    }

    public function testGetFormattedNumber()
    {
        $phone = $this->getPhone();

        $this->assertSame('(415) 390-2337', $phone->getFormattedNumber());
    }

    public function testGetCountry()
    {
        $phone = $this->getPhone();

        $this->assertSame('US', $phone->getCountry());
    }

    public function testGetCountryCallingCode()
    {
        $phone = $this->getPhone();

        $this->assertSame(1, $phone->getCountryCallingCode());
    }

    public function getPhone()
    {
        return new Phone('+14153902337', '(415) 390-2337', 'US');
    }
}
