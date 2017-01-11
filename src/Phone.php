<?php

namespace EllisIO\Phone;

use EllisIO\Phone\Exceptions\InvalidCountryCodeException;
use EllisIO\Phone\Exceptions\InvalidPhoneException;

class Phone
{
    /**
     * The ISO-3166-1 alpha-2 country code.
     *
     * @var string
     */
    protected $countryCode;

    /**
     * The E.164 number.
     *
     * @var string
     */
    protected $number;

    /**
     * The formatted number.
     *
     * @var string
     */
    protected $formattedNumber;

    /**
     * Phone constructor.
     *
     * @param string $countryCode
     * @param string $number
     * @param string $formattedNumber
     */
    public function __construct(string $countryCode, string $number, string $formattedNumber)
    {
        $this->setCountryCode($countryCode);
        $this->setNumber($number);

        $this->formattedNumber = $formattedNumber;
    }

    /**
     * Checks to ensure the country code is ISO-3166 alpha-2 compliant before setting it.
     *
     * @param string $countryCode
     * @throws \EllisIO\Phone\Exceptions\InvalidCountryCodeException
     */
    public function setCountryCode(string $countryCode)
    {
        if (strlen($countryCode) !== 2) {
            throw new InvalidCountryCodeException('Country code must be ISO-3166 alpha-2 compliant.');
        }

        $this->countryCode = $countryCode;
    }

    /**
     * Returns the ISO-3166 alpha-2 country code.
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Checks to ensure the country code is E.164 compliant before setting it.
     *
     * @param string $number
     * @throws \EllisIO\Phone\Exceptions\InvalidPhoneException
     */
    public function setNumber(string $number)
    {
        if (! preg_match('/^\+?[1-9]\d{1,14}$/i', $number)) {
            throw new InvalidPhoneException('Phone number must be E.164 compliant.');
        }

        $this->number = $number;
    }

    /**
     * Returns the E.164 number.
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Returns the national formatted number.
     *
     * @return string
     */
    public function getFormattedNumber()
    {
        return $this->formattedNumber;
    }
}
