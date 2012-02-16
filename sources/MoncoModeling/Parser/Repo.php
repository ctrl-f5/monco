<?php

namespace Monco\Modeling\Parser;

class Repo
{
    private $_repo;

    public function set($key, $object)
    {
        $this->_repo[$key] = $object;
    }

    public function get($key)
    {
        if ($this->hasKey($key)) {
            return $this->_repo[$key];
        }
        return null;
    }

    public function hasKey($key)
    {
        return array_key_exists($key, $this->_repo);
    }
}
