<?php

namespace Monco\Factory;

class Factory
{
    /**
     * @var \Monco\Config\Config configuration options
     */
    private $_config;

    /**
     * @param \Monco\Config\Config $config
     */
    public function loadConfig(\Monco\Config\Config $config)
    {
        $this->_config = $config;
    }

    /**
     * @return \Monco\Config\Config
     */
    public function getConfig()
    {
        return $this->_config;
    }
}
