<h1 align="center">Laravel Phone</h1>
<p align="center">
    <a href="https://packagist.org/packages/ellisio/laravel-phone"><img src="https://poser.pugx.org/ellisio/laravel-phone/v/stable.svg" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/ellisio/laravel-phone"><img src="https://poser.pugx.org/ellisio/laravel-phone/license.svg" alt="License"></a>
    <a href="https://packagist.org/packages/ellisio/laravel-phone"><img src="https://poser.pugx.org/ellisio/laravel-phone/d/total.svg" alt="Total Downloads"></a>
    <a href="https://circleci.com/gh/ellisio/laravel-phone"><img src="https://circleci.com/gh/ellisio/laravel-phone.svg?style=shield" alt="Build Status"></a>
    <a href="https://codeclimate.com/github/ellisio/laravel-phone"><img src="https://codeclimate.com/github/ellisio/laravel-phone/badges/gpa.svg" /></a>
    <a href="https://codeclimate.com/github/ellisio/laravel-phone/coverage"><img src="https://codeclimate.com/github/ellisio/laravel-phone/badges/coverage.svg" /></a>
</p>

<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->
- [Introduction](#introduction)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
  - [Phone validation](#phone-validation)
  - [Country validation](#country-validation)
  - [Formatting phone numbers](#formatting-phone-numbers)
  - [Creating phone number objects](#creating-phone-number-objects)
  - [Handling invalid numbers](#handling-invalid-numbers)
- [Support](#support)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->

## Introduction

A phone validator for Laravel 6+ using the free [Twilio Lookup API](https://www.twilio.com/lookup).

This package gives developers the ability to validate phone numbers and format phone numbers. All data will be pulled from the Twilio Lookup API.

Validation can be configured to check if the number is valid, or if it is valid within a given list of [ISO-3166-1 Alpha 2](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2) country codes.

## Installation

Install via composer:

```
composer require ellisio/laravel-phone
```

Add your Twilio credentials to your `.env` file. _If you don't have a Twilio account you can register one [here](https://www.twilio.com/) for free._

```
TWILIO_ACCOUNT_SID=xxxxxxxx
TWILIO_AUTH_TOKEN=xxxxxxxx
```

## Configuration

If you want to customize the configuration for this package, you can publish the config file to `/config/phone.php` by running the following command:

```shell
php artisan vendor:publish --provider=EllisIO/Phone/PhoneServiceProvider --tag=laravel-phone-config
```

If you want to customize the output of the validation messages, you can publish the translations file to `/lang/vendor/laravel-phone` by running the following command:

```shell
php artisan vendor:publish --provider=EllisIO/Phone/PhoneServiceProvider --tag=laravel-phone-translations
```

## Usage

### Phone validation

If you need to verify that the given number is valid and that is all, use the `phone` rule.

```php
return [
    'phone' => 'required|phone',
];
```

### Country validation

If you need to validate that the given number is valid in a list of countries, use the `phone_country:US,CA` rule. You can list as many [ISO-3166-1 Alpha 2](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2) as you wish delimited by a comma.

```php
return [
    'phone' => 'required|phone_country:US,CA',
];
```

### Formatting phone numbers

If you want to format the phone number using `INTERNATIONAL_FORMAT` use the following code:

```php
Phone::formatNumber('5551234567');
```

### Creating phone number objects

This library includes the ability to generate a `Phone` object. This object contains the following details about a number:

- `countryCode`: ISO-3166 alpha 2 country code.
- `number`: E.164 number.
- `formattedNumber`: National formatted number.

```php
$phone = Phone::getPhone('5551234567');
$phone->getNumber(); // Returns "+15551234567"
$phone->getNationalNumber(); // Returns "5551234567"
$phone->getFormattedNumber(); // Returns "(555) 123-4567"
$phone->getCountry(); // Returns "US"
$phone->getCountryCallingCode(); // Returns "1"
```

### Handling invalid numbers

Sometimes you may have bad data, it happens. To handle this, simply check to see if `null` was returned.

```php
if (! $phone = Phone::getPhone('123')) {
    echo "Invalid number provided.";
}
```

## Support

Need help? Create an [issue](https://github.com/ellisio/laravel-phone/issues).
