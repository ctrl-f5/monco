<?php

return array('class' => array(
    'properties' => array(
        'id' => array(
            'type' => 'int',
            'options' => array(
                'setter' => 'scalarsetter',
                'getter' => 'scalargetter',
                'dbfield' => 'id',
            )
        ),
        'name' => array(
            'type' => 'string',
            'options' => array(
                'setter' => 'scalarsetter',
                'getter' => 'scalargetter',
                'dbfield' => 'name',
            )
        )
    )
));
