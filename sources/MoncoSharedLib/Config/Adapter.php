<?php
namespace Monco\Config;

abstract class Adapter
{
    protected $_storage;

    abstract public function load($data, $overwrite = false);
    abstract public function reset();
    abstract public function has($key);
    abstract public function get($key);
    abstract public function set($key, $value);
}
