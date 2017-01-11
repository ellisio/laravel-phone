<?php

namespace EllisIO\Tests\Phone;

use EllisIO\Phone\Phone;

class PhoneTest extends AbstractTestCase
{
    public function testGetCountryCode()
    {
        $phone = $this->getPhone();

        $this->assertSame('US', $phone->getCountryCode());
    }

    public function testGetNumber()
    {
        $phone = $this->getPhone();

        $this->assertSame('+14153902337', $phone->getNumber());
    }

    public function testGetFormattedNumber()
    {
        $phone = $this->getPhone();

        $this->assertSame('(415) 390-2337', $phone->getFormattedNumber());
    }

    public function getPhone()
    {
        return new Phone('US', '+14153902337', '(415) 390-2337');
    }
}
