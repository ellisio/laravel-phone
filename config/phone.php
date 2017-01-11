<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Phone Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default phone driver that gets used while using
    | this phone library. This driver is used when another is not explicitly
    | specified when executing a given driver function.
    |
    | Supported: "twilio"
    |
    */
    'default' => 'twilio',

    /*
    |--------------------------------------------------------------------------
    | Phone Drivers
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the phone "drivers" for your application.
    |
    */
    'drivers' => [
        'twilio' => [
            'account_sid' => env('TWILIO_ACCOUNT_SID'),
            'auth_token' => env('TWILIO_AUTH_TOKEN'),
        ],
    ],
];
