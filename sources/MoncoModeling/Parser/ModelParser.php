<?php

namespace Monco\Modeling\Parser;

class ModelParser
{
    private $_modelRepo;

    private $_modelDirectories;

    public function __construct(Repo $repo = null)
    {
        if ($repo) $this->_modelRepo = $repo;

        $this->_modelDirectories = explode(PATH_SEPARATOR, get_include_path());
    }

    public function setModelRepository(Repo $repo)
    {
        $this->_modelRepo = $repo;
        return $this;
    }

    public function getModelRepository()
    {
        return $this->_modelRepo;
    }

    public function getModelDirectories()
    {
        return $this->_modelDirectories;
    }

    public function setModelDirectories(array $directories)
    {
        $this->_modelDirectories = $directories;
        return $this;
    }

    public function addModelDirectory($dir)
    {
        $this->_modelDirectories[] = $dir;
    }

    public function getModel($id)
    {
        if ($this->_modelRepo->hasKey($id)) {
            return $this->_modelRepo->get($id);
        } else {
            //TODO: find, parse and return the model
        }
        throw new \Exception("model with id: $id was not found");
    }

    public function parseModel($data)
    {
        $default = array(
            'id' => null,
            'name' => null,
            'abstract' => null,
            'extends' => null,
            'namespace' => null,
            'dir' => null,
            'tmpl' => null,
        );

        $data = array_merge($default, $data);

        if ($data['id'] == null) {
            throw new \Exception('id is a required field');
        }
        if ($data['name'] == null) {
            throw new \Exception('name is a required field');
        }

        //check if model with id exists in repo
        if (!$this->_modelRepo->hasKey($data['id'])) {

            //set all properties except 'extends'
            $classModel = new \Monco\Modeling\File\ClassModel();
            $classModel->setId($data['id'])
                ->setClassName($data['name'])
                ->setNamespace($data['namespace'])
                ->setDirectory($data['dir'])
                ->setTemplate($data['tmpl']);

            //put the model in the repo
            $this->_modelRepo->set($data['id'], $classModel);

            //fetch the extends model and set it to the classModel in the repo
            if ($data['extends'] !== null) {
                try {
                    $model = $this->getModel($data['extends']);
                    $classModel->setParent($model);
                } catch (\Exception $e) {
                    throw $e; //TODO: should it do something? when and why?
                }
            }
        }

        return $this->_modelRepo->get($data['id']);
    }
}
