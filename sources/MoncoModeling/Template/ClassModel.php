<?php

namespace Monco\Modeling\Template;

class ClassModel extends Template
{
    /**
     * @var \Monco\Modeling\File\ClassModel
     */
    protected $_classModel;

    /**
     * @var \Monco\Modeling\Renderer\PropertyRenderer
     */
    protected $_propertyRenderer;

    /**
     * @param string $templateFile
     * @return TemplateModel
     */
    public function setTemplateFile($templateFile)
    {
        $this->_templateFile = $templateFile;
        return $this;
    }

    /**
     * @return string
     */
    public function getTemplateFile()
    {
        return $this->_templateFile;
    }

    /**
     * @param \Monco\Modeling\File\ClassModel $classModel
     * @return ClassModel
     */
    public function setClassModel($classModel)
    {
        $this->_classModel = $classModel;
        return $this;
    }

    /**
     * @return \Monco\Modeling\File\ClassModel
     */
    public function getClassModel()
    {
        return $this->_classModel;
    }

    public function getPropertyRenderer()
    {
        if (!$this->_propertyRenderer) {
            $this->_propertyRenderer = new \Monco\Modeling\Renderer\PropertyRenderer();
        }
        return $this->_propertyRenderer;
    }

    public function setPropertyRenderer($renderer)
    {
        $this->_propertyRenderer = $renderer;
    }

    public function getNamespaceDeclaration()
    {
        return "namespace ".trim($this->getClassModel()->getFullNamespace(), '\\');
    }

    /**
     * @param array|\Monco\Modeling\Data\Property[] $properties
     * @param string $prefix
     * @return string
     */
    public function renderPropertyDeclarations($properties, $prefix = '')
    {
        $result = array();
        foreach ($properties as $p) {
            $result[] = $this->getPropertyRenderer()->getDelcaration($p).PHP_EOL;
        }
        //indent once
        return implode(PHP_EOL.'    ', $result);
    }

    /**
     * @param array|\Monco\Modeling\Data\Property[] $properties
     * @param string $prefix
     * @return string
     */
    public function renderGettersAndSetters($properties, $prefix = '')
    {
        $result = array();
        foreach ($properties as $p) {
            $result[] = $this->getPropertyRenderer()->getGetter($p).PHP_EOL;
            $result[] = $this->getPropertyRenderer()->getSetter($p).PHP_EOL;
        }
        //indent once
        return implode(PHP_EOL.'    ', $result);
    }
}
