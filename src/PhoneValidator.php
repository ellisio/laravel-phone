<?php

namespace EllisIO\Phone;

use InvalidArgumentException;
use EllisIO\Phone\Facades\Phone;

class PhoneValidator
{
    /**
     * Validates the given phone to ensure it is a phone.
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @param string $attribute
     * @param string $value
     * @param array $params
     * @return bool
     */
    public function validatePhone(string $attribute, string $value, array $params): bool
    {
        return ! is_null(Phone::driver()->getPhone($value));
    }

    /**
     * Validates the given phone to ensure it is a phone, as well as ensure
     * that it belongs to one of the the given countries set in the params.
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @param string $attribute
     * @param string $value
     * @param array $params
     * @return bool
     */
    public function validatePhoneCountry(string $attribute, string $value, array $params): bool
    {
        if (empty($params)) {
            throw new InvalidArgumentException('Validation rule phone_country requires at least 1 parameter.');
        }

        $phone = Phone::driver()->getPhone($value);

        if (! $phone) {
            return false;
        }

        return in_array($phone->getCountry(), $params);
    }
}
