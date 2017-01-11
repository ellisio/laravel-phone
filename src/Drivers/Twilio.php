<?php

namespace EllisIO\Phone\Drivers;

use Twilio\Rest\Client;
use EllisIO\Phone\Phone;
use EllisIO\Phone\Contracts\Driver;
use Twilio\Exceptions\RestException;
use EllisIO\Phone\Exceptions\InvalidPhoneException;

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
     * @return \EllisIO\Phone\Phone
     * @throws \EllisIO\Phone\Exceptions\InvalidPhoneException
     */
    public function getPhone(string $phone)
    {
        try {
            $lookup = $this->twilio->lookups
                ->phoneNumbers($phone)
                ->fetch();

            return new Phone(
                $lookup->countryCode, $lookup->phoneNumber, $lookup->nationalFormat
            );
        } catch (RestException $e) {
            throw new InvalidPhoneException("Phone [{$phone}] is invalid.");
        }
    }

    /**
     * Returns the formatted phone number for the give phone.
     *
     * @param string $phone
     * @return string
     * @throws \EllisIO\Phone\Exceptions\InvalidPhoneException
     */
    public function formatNumber(string $phone)
    {
        return $this->getPhone($phone)->getFormattedNumber();
    }
}
