<?php

namespace EllisIO\Tests\Phone\Exceptions;

use EllisIO\Phone\Exceptions\InvalidPhoneException;

class InvalidPhoneExceptionTest extends AbstractTestCase
{
    public function testInstanceOf()
    {
        $e = new InvalidPhoneException;
        $this->assertInstanceOf(InvalidPhoneException::class, $e);
    }
}
