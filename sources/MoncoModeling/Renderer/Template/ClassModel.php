<?php

namespace Monco\Modeling\Renderer\Template;

class ClassModel
{
    /**
     * @var \Monco\Modeling\Model\ClassModel
     */
    protected $_classModel;

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
     * @param \Monco\Modeling\Model\ClassModel $classModel
     * @return ClassModel
     */
    public function setClassModel($classModel)
    {
        $this->_classModel = $classModel;
        return $this;
    }

    /**
     * @return \Monco\Modeling\Model\ClassModel
     */
    public function getClassModel()
    {
        return $this->_classModel;
    }

    public function getNamespaceDeclaration()
    {
        return "namespace ".$this->getClassModel()->getFullNamespace();
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
            $result[] = '$this->'.$prefix.$p->getNameCamelCased().';';
        }
        return implode(PHP_EOL, $result);
    }
}
