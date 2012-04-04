<?php

namespace Monco\Modeling\File;

class File
{
    /**
     * @var string
     */
    protected $_directory;

    /**
     * @var \Monco\Modeling\Template\Template
     */
    protected $_template;

    /**
     * @var ClassModel
     */
    protected $_parent;

    /**
     * @param string $directory
     * @return File
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

    /**
     * @return string
     */
    public function getFullDirectory()
    {
        $dir = $this->getDirectory();
        if (strpos($dir, DIRECTORY_SEPARATOR) === 0) {
            return $dir;
        } elseif ($this->hasParent()) {
            $dir = $this->getParent()->getFullDirectory().$dir;
        }
        return $dir;
    }

    /**
     * @param string $template
     * @return File
     */
    public function setTemplate($template)
    {
        if (is_string($template)) {
            $parts = explode(':', $template);
            if (count($parts) == 2) {
                switch ($parts[0]) {
                    case 'file':
                        $tmpl = new \Monco\Modeling\Template\Template();
                        $tmpl->setTemplateFile($parts[1]);
                        $this->_template = $tmpl;
                        break;
                    case 'class':
                        if (class_exists($parts[1]) && $parts[1] instanceof \Monco\Modeling\Template\Template) {
                            $class = $parts[1];
                            $this->_template = new $class();
                        }
                        break;
                }
            }
        }
        return $this;
    }

    /**
     * @return \Monco\Modeling\Template\Template
     */
    public function getTemplate()
    {
        if (!$this->_template && $this->hasParent()) {
            return $this->getParent()->getTemplate();
        }
        return $this->_template;
    }

    /**
     * @param File $parent
     * @return File
     */
    public function setParent($parent)
    {
        $this->_parent = $parent;
        return $this;
    }

    /**
     * @return File
     */
    public function getParent()
    {
        return $this->_parent;
    }

    public function hasParent()
    {
        return $this->_parent instanceof File;
    }
}
