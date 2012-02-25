<?php

namespace Monco\Modeling\Data;

class Property
{
    /**
     * @var string
     */
    private $_id;

    /**
     * @var string
     */
    private $_type;

    /**
     * @var array
     */
    private $_options;

    /**
     * @var string
     */
    private $_name;

    /**
     * @var string
     */
    private $_accessor;

    public function __construct($data = array())
    {
        $this->parseData($data);
    }

    /**
     * @param array $data
     * @return Property
     */
    public function parseData($data)
    {
        if (!empty($data)) {
            $default = array(
                'id' => null,
                'type' => null,
                'accessor' => 'public',
                'options' => null
            );

            $data = array_merge($default, $data);

            if (!array_key_exists('name', $data)) {
                $data['name'] = $data['id'];
            }

            $this
                ->setId($data['id'])
                ->setType($data['type'])
                ->setOptions($data['options'])
                ->setName($data['name'])
                ->setAccessor($data['accessor']);

        }

        return $this;
    }

    public function setId($id)
    {
        $this->_id = (string)$id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setType($type)
    {
        $this->_type = (string)$type;
        return $this;
    }

    public function getType()
    {
        return $this->_type;
    }

    public function setOptions($options)
    {
        $this->_options = (array)$options;
        return $this;
    }

    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * @param $name
     * @return Property
     */
    public function setName($name)
    {
        $this->_name = (string)$name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param $accessor
     * @return Property
     */
    public function setAccessor($accessor)
    {
        $this->_accessor = (string)$accessor;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccessor()
    {
        return $this->_accessor;
    }


    /**
     * @return string
     */
    public function getNameCamelCased()
    {
        return lcfirst($this->_name);
    }

    /**
     * @return string
     */
    public function getNamePascalCased()
    {
        return ucfirst($this->_name);
    }

    /**
     * Returns the properties getter declaration signature
     */
    public function getGetterDeclaration()
    {
        return $this->getAccessor().' function get'.$this->getNamePascalCased().'()';
    }

    /**
     * Returns the properties setter declaration signature
     */
    public function getSetterDeclaration()
    {
        return $this->getAccessor().' function set'.$this->getNamePascalCased().'('.
            $this->getvariableDeclaration().')';
    }

    /**
     * Returns the properties variable declaration
     */
    public function getVariableDeclaration()
    {
        return '$'.$this->getNameCamelCased();
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getOption($key)
    {
        if ($this->hasOption($key)) {
            return $this->_options[$key];
        }
        return null;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasOption($key)
    {
        return array_key_exists($key, $this->_options);
    }


    /**
     * @param array $data
     * @param string|false $key false to merge options root array
     * @throws \Exception
     * @return Property
     */
    public function mergeOptions($data, $key)
    {
        if (is_array($data)) {
            if ($key !== false) {
                if ($this->hasOption($key)) {
                    $this->_options[$key] = array_merge(
                        $this->_options,
                        $data
                    );
                } else {
                    throw new \Exception("key '$key' not found when merging options");
                }
            } else {
                $this->_options = array_merge(
                    $this->_options,
                    $data
                );
            }
        } else {
            throw new \Exception("$data must be of type array");
        }
        return $this;
    }
}
