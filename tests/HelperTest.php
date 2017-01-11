<?php

namespace EllisIO\Tests\Phone;

use EllisIO\Phone\Contracts\Driver;

class HelperTest extends AbstractTestCase
{
    public function testPhoneHelper()
    {
        $phone = phone();

        $this->assertInstanceOf(Driver::class, $phone);
    }

    public function testFormatPhoneHelper()
    {
        $phone = format_phone('4153902337');

        $this->assertSame('(415) 390-2337', $phone);
    }
}
