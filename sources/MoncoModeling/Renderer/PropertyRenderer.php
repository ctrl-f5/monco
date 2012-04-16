<?php

namespace Monco\Modeling\Renderer;

class PropertyRenderer
{
    /**
     * @param \Monco\Modeling\Data\Property $property
     * @return string
     */
    public function getDelcaration($property)
    {
        return 'protected $_'.$property->getNameCamelCased().';';
    }

    /**
     * @param \Monco\Modeling\Data\Property $property
     * @return string
     */
    public function getGetter($property)
    {
        $func = 'public function get'.$property->getNamePascalCased().'()'.PHP_EOL;
        $func .= '    {'.PHP_EOL;
        $func .= '        return $this->_'.$property->getNameCamelCased().';'.PHP_EOL;
        $func .= '    }';

        return $func;
    }

    /**
     * @param \Monco\Modeling\Data\Property $property
     * @return string
     */
    public function getSetter($property)
    {
        $func = 'public function set'.$property->getNamePascalCased().'($'.$property->getNameCamelCased().')'.PHP_EOL;
        $func .= '    {'.PHP_EOL;
        $func .= '        $this->_'.$property->getNameCamelCased().' = $'.$property->getNameCamelCased().';'.PHP_EOL;
        $func .= '        return $this;'.PHP_EOL;
        $func .= '    }';

        return $func;
    }
}
