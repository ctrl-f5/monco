<?php

namespace Monco\Modeling\Model;

class ClassModel
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
    private $_directory;

    /**
     * @var string
     */
    private $_namespace;

    /**
     * @var string
     */
    private $_templateFile;

    /**
     * @var ClassModel
     */
    private $_parent;

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
     * @param string $directory
     * @return ClassModel
     */
    public function setDirectory($directory)
    {
        $this->_directory = $directory;
        return $this;
    }

    /**
     * @return string
     */
    public function getDirectory()
    {
        return $this->_directory;
    }

    public function getFullDirectory()
    {
        $dir = $this->getDirectory();
        if (strpos($dir, DIRECTORY_SEPARATOR) === 0) {
            return $dir;
        } elseif ($this->getParent()) {
            $dir = $this->getParent()->getFullDirectory().$dir;
        }
        return $dir;
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

    /**
     * @param string $templateFile
     * @return ClassModel
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
        if (!$this->_templateFile && $this->hasParent()) {
            return $this->getParent()->getTemplateFile();
        }
        return $this->_templateFile;
    }

    /**
     * @param ClassModel $parent
     * @return ClassModel
     */
    public function setParent($parent)
    {
        $this->_parent = $parent;
        return $this;
    }

    /**
     * @return ClassModel
     */
    public function getParent()
    {
        return $this->_parent;
    }

    public function hasParent()
    {
        return $this->_parent instanceof ClassModel;
    }
}