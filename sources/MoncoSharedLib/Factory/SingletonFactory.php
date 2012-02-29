<?php

namespace Monco\Factory;

class SingletonFactory extends Factory
{
    /**
     * @var SingletonFactory
     */
    private static $_instance;

    protected function __construct() {}

    public static function getInstance()
    {
        if (!(self::$_instance instanceof Factory)) {
            $class = get_called_class();
            $config = static::_fetchConfig($class);
            self::$_instance = new $class;
            self::$_instance->loadConfig($config);
        }
        return self::$_instance;
    }

    /**
     * Fetches the config when instantiating the class
     * the options given to the config are determined by
     * static::_getDefaultOptions()
     *
     * @static
     * @param string $className of the factory beeing intatiated
     * @return \Monco\Config\Config
     */
    protected static function _fetchConfig($className)
    {
        return new \Monco\Config\Config(
            static::_getDefaultConfigOptions()
        );
    }

    /**
     * Generates the options used when instatiating
     * the Config of a new Factory instance
     *
     * @static
     * @return \Monco\Config\Adapter
     */
    protected static function _getDefaultConfigOptions()
    {
        return new \Monco\Config\ArrayAdapter(
            array()
        );
    }
}
