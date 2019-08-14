<?php

namespace EllisIO\Phone;

use EllisIO\Phone\Contracts\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;

class PhoneServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $this->setupConfig();
        $this->setupTranslations();

        $this->extendValidator();
    }

    /**
     * Setup the config.
     */
    protected function setupConfig(): void
    {
        $source = realpath(__DIR__.'/../config/phone.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([$source => config_path('phone.php')], 'laravel-phone-config');
        }

        $this->mergeConfigFrom($source, 'phone');
    }

    /**
     * Setup the translations.
     */
    protected function setupTranslations(): void
    {
        $source = realpath(__DIR__.'/../lang');

        $this->loadTranslationsFrom($source, 'phone');

        if ($this->app->runningInConsole()) {
            $this->publishes([$source => resource_path('lang/vendor/phone')], 'laravel-phone-translations');
        }
    }

    /**
     * Extends the validator.
     */
    protected function extendValidator(): void
    {
        $lang = $this->app->translator->get('phone::validation');

        $this->app->validator->extend('phone', PhoneValidator::class.'@validatePhone', $lang['phone']);
        $this->app->validator->extend('phone_country', PhoneValidator::class.'@validatePhoneCountry', $lang['phone_country']);
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->registerPhone();
    }

    /**
     * Register the phone instance.
     */
    protected function registerPhone(): void
    {
        $this->app->singleton(Factory::class, function () {
            return new PhoneManager($this->app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [Factory::class];
    }
}
