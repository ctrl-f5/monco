<?php

namespace Monco\Modeling\File;

class ClassModel extends File
{
    const CLASS_TYPE_INTERFACE  = 'interface';
    const CLASS_TYPE_ABSTRACT   = 'abstract';
    const CLASS_TYPE_CONCRETE   = 'concrete';

    /**
     * @var int
     */
    private $_id;

    /**
     * @var string
     */
    private $_className;

    /**
     * @var string
     */
    private $_ClassType;

    /**
     * @var string
     */
    private $_namespace;

    /**
     * @var \Monco\Modeling\Template\ClassModel
     */
    protected $_template;

    /**
     * @param string|\Monco\Modeling\Template\ClassModel $template
     * @return ClassModel
     */
    public function setTemplate($template)
    {
        parent::setTemplate($template);
        if ($this->_template instanceof \Monco\Modeling\Template\ClassModel) {
            /** @var $this->_template \Monco\Modeling\Template\ClassModel */
            $this->_template->setClassModel($this);
        }
        return $this;
    }

    /**
     * @param string $ClassType
     * @return ClassModel
     */
    public function setClassType($ClassType)
    {
        $this->_ClassType = $ClassType;
        return $this;
    }

    /**
     * @return string
     */
    public function getClassType()
    {
        return $this->_ClassType;
    }

    /**
     * @param string $className
     * @return ClassModel
     */
    public function setClassName($className)
    {
        $this->_className = $className;
        return $this;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->_className;
    }

    /**
     * @param int $id
     * @return ClassModel
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param string $namespace
     * @return ClassModel
     */
    public function setNamespace($namespace)
    {
        $this->_namespace = $namespace;
        return $this;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->_namespace;
    }

    public function getFullNamespace()
    {
        $ns = $this->getNamespace();
        if (strpos($ns, '\\') === 0) {
            return $ns;
        } elseif ($this->getParent()) {
            $ns = $this->getParent()->getFullNamespace().'\\'.$ns;
        }
        return $ns;
    }
}