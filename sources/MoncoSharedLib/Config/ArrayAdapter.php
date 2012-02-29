<?php
namespace Monco\Config;

class ArrayAdapter extends Adapter
{
    protected $_storage = array();

    /**
     * @param $config
     * @throws Exception
     */
    public function load($data, $overwrite = false)
    {
        if (!is_array($data)) {
            throw new Exception('$config must be of type array');
        }

        $this->_storage = $data;
        return $this;
    }

    public function reset()
    {
        $this->_storage = array();
        return $this;
    }

    protected function _mergeStorage($data, $overwrite = false)
    {
        if (is_array($this->_storage)) {
            $this->_storage = ($overwrite) ? array_merge($this->_storage, $data) : array_merge($data, $this->_storage);
        } else {
            $this->_storage = $data;
        }
        return $this;
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->_storage);
    }

    /**
     * @param $key
     * @return mixed
     * @throws Exception
     */
    public function get($key)
    {
        if ($this->has($key)) {
            return $this->_storage[$key];
        }
        throw new Exception("\$key '$key' was not found");
    }

    /**
     * @param $key
     * @param $value
     * @return ArrayAdapter
     */
    public function set($key, $value)
    {
        $this->_storage[$key] = $value;
        return $this;
    }
}
