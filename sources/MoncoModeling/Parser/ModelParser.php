<?php

namespace Monco\Modeling\Parser;

class ModelParser
{
    public function createModel($id)
    {
        $data = $this->getModelData($id);
        $model = new ClassModel();
    }

    public function getModelData($id)
    {
        $modelSearcher = new ModelSearcher();
        $modelSearcher->getDataForId($id);
    }
}