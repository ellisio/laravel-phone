<?php

namespace EllisIO\Phone;

use InvalidArgumentException;

class Phone
{
    /**
     * The E.164 number.
     *
     * @var string
     */
    protected $number;

    /**
     * The national number.
     *
     * @var string
     */
    protected $nationalNumber;

    /**
     * The formatted number.
     *
     * @var string
     */
    protected $formattedNumber;

    /**
     * The ISO-3166-1 alpha-2 country.
     *
     * @var string
     */
    protected $country;

    /**
     * The country calling code.
     *
     * @var int
     */
    protected $countryCallingCode;

    /**
     * Phone constructor.
     *
     * @param string $number
     * @param string $formattedNumber
     * @param string $country
     */
    public function __construct(string $number, string $formattedNumber, string $country)
    {
        if (! preg_match('/^\+?[1-9]\d{1,14}$/i', $number)) {
            throw new InvalidArgumentException('$number must be E.164 compliant.');
        }

        if (strlen($country) !== 2) {
            throw new InvalidArgumentException('$country must be ISO-3166 alpha-2 compliant.');
        }

        $this->number = $number;
        $this->nationalNumber = preg_replace('/\D/', '', $formattedNumber);
        $this->formattedNumber = $formattedNumber;
        $this->country = $country;
        $this->countryCallingCode = (int) str_replace(
            ['+', $this->nationalNumber], '', $this->number
        );
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
     * Returns the national number.
     *
     * @return string
     */
    public function getNationalNumber()
    {
        return $this->nationalNumber;
    }

    /**
     * Returns the formatted number.
     *
     * @return string
     */
    public function getFormattedNumber()
    {
        return $this->formattedNumber;
    }

    /**
     * Returns the ISO-3166 alpha-2 country.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Returns the country calling code.
     *
     * @return int
     */
    public function getCountryCallingCode()
    {
        return $this->countryCallingCode;
    }
}
