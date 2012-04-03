<?php

return array(
    'properties' => array(
        array(
            'id' => 'id',
            'type' => 'int',
            'options' => array(
                'dbfield' => 'id',
            )
        ),
        array(
            'id' => 'default:',
            'name' => 'name',
            'type' => 'string',
            'options' => array(
                'dbfield' => 'name',
            )
        ),
        array(
            'id' => 'user',
            'type' => 'id:monco.model.user',
            'options' => array(
                'dbfield' => 'name',
            )
        )
    )
);
