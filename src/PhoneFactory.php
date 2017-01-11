<?php

namespace EllisIO\Phone;

use InvalidArgumentException;
use Twilio\Rest\Client as TwilioClient;
use EllisIO\Phone\Drivers\Twilio as TwilioDriver;
use EllisIO\Phone\Contracts\Factory as FactoryContract;

class PhoneFactory implements FactoryContract
{
    /**
     * The configuration object.
     *
     * @var array
     */
    public $config;

    /**
     * The array of resolved drivers.
     *
     * @var array
     */
    protected $drivers = [];

    /**
     * Create a new PhoneFactory instance.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Get a phone driver instance by name.
     *
     * @param string|null $name
     * @return mixed
     */
    public function driver(string $name = null)
    {
        $name = $name ?: $this->getDefaultDriver();

        return $this->drivers[$name] = $this->get($name);
    }

    /**
     * Attempt to get the driver from the local cache.
     *
     * @param string $name
     * @return mixed
     */
    protected function get($name)
    {
        return isset($this->drivers[$name]) ? $this->drivers[$name] : $this->resolve($name);
    }

    /**
     * Resolve the given driver.
     *
     * @param string $name
     * @return \EllisIO\Phone\Contracts\Driver
     */
    protected function resolve($name)
    {
        $config = $this->getConfig($name);

        if (is_null($config)) {
            throw new InvalidArgumentException("Phone driver [{$name}] is not defined.");
        }

        $driverMethod = 'create'.ucfirst($name).'Driver';

        if (method_exists($this, $driverMethod)) {
            return $this->{$driverMethod}($config);
        } else {
            throw new InvalidArgumentException("Driver [{$config['driver']}] is not defined.");
        }
    }

    /**
     * Returns the TwilioDriver implementation.
     *
     * @param array $config
     * @return \EllisIO\Phone\Drivers\Twilio
     */
    protected function createTwilioDriver(array $config)
    {
        $twilio = new TwilioClient($config['account_sid'], $config['auth_token']);

        return new TwilioDriver($twilio);
    }

    /**
     * Get the phone driver configuration.
     *
     * @param string $name
     * @return array
     */
    protected function getConfig($name)
    {
        return $this->config['drivers'][$name];
    }

    /**
     * Get the default phone driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->config['default'];
    }

    /**
     * Sets the default phone driver name.
     *
     * @param string $name
     */
    public function setDefaultDriver($name)
    {
        $this->config['default'] = $name;
    }

    /**
     * Dynamically call the default driver instance.
     *
     * @param string $method
     * @param array $params
     * @return mixed
     */
    public function __call(string $method, array $params)
    {
        return $this->driver()->{$method}(...$params);
    }
}
