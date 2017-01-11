<h1 align="center">Laravel Phone</h1>
<p align="center">
    <a href="https://travis-ci.org/ellisio/laravel-phone"><img src="https://travis-ci.org/ellisio/laravel-phone.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/ellisio/laravel-phone"><img src="https://poser.pugx.org/ellisio/laravel-phone/d/total.svg" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/ellisio/laravel-phone"><img src="https://poser.pugx.org/ellisio/laravel-phone/v/stable.svg" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/ellisio/laravel-phone"><img src="https://poser.pugx.org/ellisio/laravel-phone/license.svg" alt="License"></a>
</p>

## Introduction

A phone validator for Laravel using the free [Twilio Lookup API](https://www.twilio.com/lookup).

This package gives developers the ability to validate phone numbers and format phone numbers. All data will be pulled from the Twilio Lookup API.

Validation can be configured to check if the number is valid, or if it is valid within a given list of [ISO-3166-1 Alpha 2](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2) country codes.

## Installation

### Step 1

Install via composer:

```
composer require ellisio/laravel-phone
```

### Step 2

Add to your `config/app.php` service provider list:

```php
'providers' => [
    // ...
    EllisIO\Phone\PhoneServiceProvider::class,
    // ...
],
```

### Step 3

Add the following to your `config/app.php` aliases list:

```php
'aliases' => [
    // ...
    'Phone' => 'EllisIO\Phone\Facades\Phone::class',
    // ...
],
```

### Step 4

Add your Twilio credentials to your `.env` file. _If you don't have a Twilio account you can register for one [here](https://www.twilio.com/) for free._

```
TWILIO_ACCOUNT_SID=xxxxxxxx
TWILIO_AUTH_TOKEN=xxxxxxxx
```

### Step 5 (Optional)

If you want to customize the configuration for this package, you can publish the config file to `/config/phone.php` by running the following command:

```shell
php artisan vendor:publish --provider=EllisIO/Phone/PhoneServiceProvider --tag=config
```

If you want to customize the output of the validation messages, you can publish the translations file to `/lang/vendor/laravel-phone` by running the following command:

```shell
php artisan vendor:publish --provider=EllisIO/Phone/PhoneServiceProvider --tag=translations
```

## Usage

### Basic Validation

If you need to verify that the given number is valid and that is all, use the `phone` rule.

```php
return [
    'phone' => 'required|phone',
];
```

### Country Validation

If you need to validate that the given number is valid in a list of countries, use the `phone_country:US,CA` rule. You can list as many [ISO-3166-1 Alpha 2](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2) as you wish delimited by a comma.

```php
return [
    'phone' => 'required|phone_country:US,CA',
];
```

### Formatting Phone Numbers

If you want to format the phone number using `INTERNATIONAL_FORMAT` use the following code:

```php
use EllisIO\Phone\Facades\Phone;

app(Phone::class)->formatNumber('5551234567');
```

### Creating Phone Number Objects

This library includes the ability to generate a `Phone` object. This object contains the following details about a number:

- `countryCode`: ISO-3166 alpha 2 country code.
- `number`: E.164 number.
- `formattedNumber`: National formatted number.

```php
use EllisIO\Phone\Facades\Phone;

$phone = app(Phone::class)->getPhone('5551234567');
$phone->getCountryCode(); // Returns "US"
$phone->getNumber(); // Returns "+15551234567"
$phone->getFormattedNumber(); // Returns "(555) 123-4567"
```

## Support

Need help? Create an [issue](https://github.com/ellisio/laravel-phone/issues).
