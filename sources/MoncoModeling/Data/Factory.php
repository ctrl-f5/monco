<?php

namespace Monco\Modeling\Data;

class Factory extends \Monco\Factory\SingletonFactory
{
    protected static function _getDefaultConfigOptions()
    {
        $defaultOptions = array(
            'monco.modeling.property.class' => '\\Monco\\Modeling\\Data\\Property'
        );

        return parent::_getDefaultConfigOptions()
            ->load($defaultOptions, true);
    }

    public function getPropertyClass()
    {
        return $this->getConfig()->get('monco.modeling.property.class');
    }

    public function createProperty($propertyData = array())
    {
        $class = $this->getPropertyClass();
        return new $class();
    }
}
