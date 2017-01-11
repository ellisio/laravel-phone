<?php

namespace EllisIO\Phone;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;
use EllisIO\Phone\Contracts\Factory as FactoryContract;

class PhoneServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
        $this->setupTranslations();

        $this->extendValidator();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/phone.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([$source => config_path('phone.php')], 'config');
        }

        $this->mergeConfigFrom($source, 'phone');
    }

    /**
     * Setup the translations.
     *
     * @return void
     */
    protected function setupTranslations()
    {
        $source = realpath(__DIR__.'/../lang');

        $this->loadTranslationsFrom($source, 'phone');

        if ($this->app->runningInConsole()) {
            $this->publishes([$source => resource_path('lang/vendor/phone')], 'translations');
        }
    }

    /**
     * Extends the validator.
     *
     * @return void
     */
    protected function extendValidator()
    {
        $lang = $this->app->translator->get('phone::validation');

        $this->app->validator->extend('phone', PhoneValidator::class.'@validatePhone', $lang['phone']);
        $this->app->validator->extend('phone_country', PhoneValidator::class.'@validatePhoneCountry', $lang['phone_country']);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPhone();
    }

    /**
     * Register the phone instance.
     *
     * @return void
     */
    protected function registerPhone()
    {
        $this->app->singleton('phone', function (Container $app) {
            return new PhoneFactory($app->config->get('phone'));
        });

        $this->app->alias('phone', PhoneFactory::class);
        $this->app->alias('phone', FactoryContract::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['phone'];
    }
}
