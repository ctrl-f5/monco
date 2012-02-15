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
                ->setName($data['name']);

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
     * @return string
     */
    public function getNameCamelCased()
    {
        return $this->_name;
    }

    /**
     * @return string
     */
    public function getNamePascalCased()
    {
        return $this->_name;
    }
}
