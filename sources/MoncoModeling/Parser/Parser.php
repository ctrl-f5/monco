<?php

namespace Monco\Modeling\Parser;

class Parser
{
    private $_modelRepo;

    public function __construct(Repo $repo)
    {
        $this->_modelRepo = $repo;
    }

    public function getModel($id)
    {
        if ($this->_modelRepo->hasKey($id)) {
            return $this->_modelRepo->get($id);
        } else {
            //TODO: find, parse and return the model
        }
        //TODO: throw exception
    }

    public function parseModel($data)
    {
        $default = array(
            'id' => null,
            'abstract' => null,
            'extends' => null,
            'namespace' => null,
            'subNamespace' => null,
            'dir' => null,
            'subDir' => null,
            'tmpl' => null,
        );

        $data = array_merge($default, $data);

        if ($data['id'] == null) {
            throw new \Exception('id is a required field');
        }
        //check if model with id exists in repo
        if (!$this->_modelRepo->hasKey($data['id'])) {

            //TODO: set all properties except 'extends'

            //put the model in the repo
            $this->_modelRepo->set($data['id'], $classModel);

            //fetch the extends model and set it to the classModel in the repo
            if ($data['extends'] !== null) {
                //TODO: catch exception
                $model = $this->getModel($data['extends']);
                //TODO: set extends $model in $classModel
            }
        }
        return $this->_modelRepo->get($data['id']);
    }
}
