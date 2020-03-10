<?php

namespace EllisIO\Phone;

use EllisIO\Phone\Drivers\Twilio;
use Illuminate\Support\Manager;
use Twilio\Rest\Client as TwilioClient;

class PhoneManager extends Manager implements Contracts\Factory
{
    /**
     * Returns the TwilioDriver implementation.
     *
     * @param array $config
     * @return \EllisIO\Phone\Drivers\Twilio
     */
    protected function createTwilioDriver(): Twilio
    {
        $config = $this->container['config']->get('phone.drivers.twilio');

        $twilio = new TwilioClient($config['account_sid'], $config['auth_token']);

        return new Twilio($twilio);
    }

    /**
     * Get the default driver name.
     *
     * @throws \InvalidArgumentException
     */
    public function getDefaultDriver()
    {
        return $this->container['config']->get('phone.default');
    }
}
