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
            $this->_setTemplateWithFile($template);
        }
        if (is_array($template)) {
            if (!array_key_exists('file', $template)) {
                throw new \Monco\Exception('template needs a key \'file\'');
            }
            if (!array_key_exists('class', $template)) {
                $template['class'] = '\\Monco\\Modeling\\Template\\Template';
            }
            $this->_setTemplateWithClass($template['class'], $template['file']);
        }
        return $this;
    }

    protected function _setTemplateWithFile($file)
    {
        $tmpl = new \Monco\Modeling\Template\Template();
        $tmpl->setTemplateFile($file);
        $this->_template = $tmpl;
    }

    protected function _setTemplateWithClass($class, $file)
    {
        if (class_exists($class)) {
            $instance = new $class();
            if ($instance instanceof \Monco\Modeling\Template\Template) {
                $this->_template = $instance;
                $this->_template->setTemplateFile($file);
            } else {
                throw new \Monco\Exception('Template class must inherit \\Monco\\Modeling\\Template\\Template: '.$class);
            }
        } else {
            throw new \Monco\Exception('Template class not found: '.$class);
        }
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
