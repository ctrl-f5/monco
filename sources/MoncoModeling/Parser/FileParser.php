<?php

namespace Monco\Modeling\Parser;

class FileParser
{
    public function parse($data)
    {
        $default = array(
            'tmpl' => null,
        );

        $data = array_merge($default, $data);

        if ($data['tmpl'] == null) {
            throw new \Exception('tmpl is a required field');
        }

        $classModel = new \Monco\Modeling\File\File();
        $classModel->setTemplate($data['tmpl']);

        return $classModel;
    }
}
