<?php

namespace Monco\Modeling\Parser;

class PropertyParser
{
    public function parseProperties($data)
    {
        $default = array(
            'id' => null,
            'name' => null,
            'type' => null,
            'options' => null,
        );

        $result = array();
        foreach ($data as $d) {
            $d = array_merge($default, $d);

            if ($d['id'] == null) {
                throw new \Exception('id is a required field');
            }

            //set all properties except 'extends'
            $property = new \Monco\Modeling\Data\Property();
            $property->setId($d['id'])
                ->setName($d['name'])
                ->setType($d['type'])
                ->setOptions($d['options']);

            $result[] = $property;
        }

        return $result;
    }
}
