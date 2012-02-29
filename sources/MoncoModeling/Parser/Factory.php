<?php

namespace Monco\Modeling\Parser;

class Factory extends \Monco\Factory\Factory
{
    public static function getModelParser()
    {
        return new ModelParser(self::getNewModelRepository());
    }

    public function getNewModelRepository()
    {
        return new Repo();
    }
}
