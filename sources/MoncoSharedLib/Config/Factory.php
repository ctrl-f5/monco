<?php

namespace Monco\Config;

class Factory extends \Monco\Factory\Factory
{
    public function createFromArray(array $options)
    {
        return self::createConfigFromAdapter(
            new ArrayAdapter($options)
        );
    }

    public function createFromAdapter(Adapter $adapter)
    {
        return new Config($adapter);
    }
}
