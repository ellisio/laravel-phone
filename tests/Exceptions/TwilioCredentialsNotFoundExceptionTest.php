<?php

namespace EllisIO\Tests\Phone\Exceptions;

use EllisIO\Tests\Phone\AbstractTestCase;
use EllisIO\Phone\Exceptions\TwilioCredentialsNotFoundException;

class TwilioCredentialsNotFoundExceptionTest extends AbstractTestCase
{
    public function testInstanceOf()
    {
        $e = new TwilioCredentialsNotFoundException;
        $this->assertInstanceOf(TwilioCredentialsNotFoundException::class, $e);
    }
}
