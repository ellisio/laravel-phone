<?php

namespace EllisIO\Phone\Drivers;

use EllisIO\Phone\Contracts\Driver;
use EllisIO\Phone\Phone;
use Twilio\Exceptions\RestException;
use Twilio\Rest\Client;

class Twilio implements Driver
{
    /**
     * The Twilio Rest client.
     *
     * @var \Twilio\Rest\Client
     */
    protected $twilio;

    /**
     * TwilioDriver constructor.
     *
     * @param \Twilio\Rest\Client $twilio
     */
    public function __construct(Client $twilio)
    {
        $this->twilio = $twilio;
    }

    /**
     * Returns the details about the phone number.
     *
     * @param string $phone
     * @return \EllisIO\Phone\Phone|null
     */
    public function getPhone(string $phone): ?Phone
    {
        try {
            $lookup = $this->twilio->lookups
                ->phoneNumbers($phone)
                ->fetch();

            return new Phone($lookup->phoneNumber, $lookup->nationalFormat, $lookup->countryCode);
        } catch (RestException $e) {
            return null;
        }
    }

    /**
     * Returns the formatted phone number for the give phone.
     *
     * @param string $phone
     * @return string
     */
    public function formatNumber(string $phone): string
    {
        return optional($this->getPhone($phone), function ($phone) {
            return $phone->getFormattedNumber();
        });
    }
}
