<?php

use EllisIO\Phone\Exceptions\InvalidCountryCodeException;

class InvalidCountryCodeExceptionTest extends AbstractTestCase
{
    public function testInstanceOf()
    {
        $e = new InvalidCountryCodeException;
        $this->assertInstanceOf(InvalidCountryCodeException::class, $e);
    }
}
