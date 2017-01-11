<?php

namespace EllisIO\Phone;

use EllisIO\Phone\Facades\Phone;
use EllisIO\Phone\Exceptions\InvalidPhoneException;
use InvalidArgumentException;

class PhoneValidator
{
    /**
     * Validates the given phone to ensure it is a phone.
     *
     * @param string $attribute
     * @param string $value
     * @param array $params
     * @return bool
     */
    public function validatePhone(string $attribute, string $value, array $params)
    {
        try {
            Phone::driver()->getPhone($value);

            return true;
        } catch (InvalidPhoneException $e) {
            return false;
        }
    }

    /**
     * Validates the given phone to ensure it is a phone, as well as ensure
     * that it belongs to one of the the given countries set in the params.
     *
     * @param string $attribute
     * @param string $value
     * @param array $params
     * @return bool
     */
    public function validatePhoneCountry(string $attribute, string $value, array $params)
    {
        if (count($params) < 1) {
            throw new InvalidArgumentException('Validation rule phone_country requires at least 1 parameters.');
        }

        try {
            $phone = Phone::driver()->getPhone($value);

            return in_array($phone->getCountryCode(), $params);
        } catch (InvalidPhoneException $e) {
            return false;
        }
    }
}
