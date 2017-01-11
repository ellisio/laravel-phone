<?php

namespace EllisIO\Phone\Contracts;

interface Driver
{
    /**
     * Returns the details about the phone number.
     *
     * @param string $phone
     * @return \EllisIO\Phone\Phone
     * @throws \EllisIO\Phone\Exceptions\InvalidPhoneException
     */
    public function getPhone(string $phone);

    /**
     * Returns the formatted phone number for the give phone.
     *
     * @param string $phone
     * @return string
     * @throws \EllisIO\Phone\Exceptions\InvalidPhoneException
     */
    public function formatNumber(string $phone);
}
