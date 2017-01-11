<?php

use EllisIO\Phone\Facades\Phone;

if (! function_exists('phone')) {
    /**
     * Returns the Phone implementation for the given driver.
     *
     * @param string|null $driver
     * @return \EllisIO\Phone\Contracts\Driver
     */
    function phone(string $driver = null)
    {
        return app(Phone::class)->driver($driver);
    }
}

if (! function_exists('format_phone')) {
    /**
     * Formats the given phone number.
     *
     * @param string $phone
     * @return string
     */
    function format_phone(string $phone)
    {
        return phone()->formatNumber($phone);
    }
}
