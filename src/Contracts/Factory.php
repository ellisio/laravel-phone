<?php

namespace EllisIO\Phone\Contracts;

/**
 * @codeCoverageIgnore
 */
interface Factory
{
    /**
     * Get a phone driver instance by name.
     *
     * @param string|null $name
     * @return \EllisIO\Phone\Contracts\Driver
     */
    public function driver($name = null);
}
