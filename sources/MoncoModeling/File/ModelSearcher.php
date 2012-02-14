<?php

namespace Monco\Modeling\File;

class Searcher
{
    public function getDataForId($id)
    {
        $file = $this->getFileForId($id);
        if (file_exists($file))
            return include($file);
        return false;
    }

    public function getFileForId($id)
    {
        switch ($id) {
            case 'domain.model.concrete':
                return '/home/nicky/workspace/monco/lab/sources/test/concrete.domain.model.classmodel.php';
            case 'domain.model.abstract':
                return '/home/nicky/workspace/monco/lab/sources/test/abstract.model.domain.classmodel.php';
        }
        return false;
    }
}
