<?php

namespace Monco\Config;

class Config
{
    /**
     * @var Adapter
     */
    private $_adapter;

    public function __construct(Adapter $adapter)
    {
        $this->_adapter = $adapter;
    }

    public function setAdapter(Adapter $adapter)
    {
        $this->_adapter = $adapter;
        return $this;
    }

    public function getAdapter()
    {
        return $this->_adapter;
    }

    public function has($key)
    {
        return $this->_adapter->has($key);
    }

    public function get($key)
    {
        return $this->_adapter->get($key);
    }

    public function set($key, $value)
    {
        return $this->_adapter->set($key, $value);
    }

    public function merge(Config $config, $overwrite = false)
    {
        $config->getAdapter()->load($config->getAdapter(), $overwrite);
    }
}
