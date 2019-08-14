<?php

namespace EllisIO\Phone\Contracts;

use EllisIO\Phone\Phone;

/**
 * @codeCoverageIgnore
 */
interface Driver
{
    /**
     * Returns the details about the phone number.
     *
     * @param string $phone
     * @return \EllisIO\Phone\Phone
     */
    public function getPhone(string $phone): ?Phone;

    /**
     * Returns the formatted phone number for the give phone.
     *
     * @param string $phone
     * @return string
     */
    public function formatNumber(string $phone): string;
}
