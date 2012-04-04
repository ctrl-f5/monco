<?php

namespace Monco\Modeling\Template;

class Template
{
    /**
     * @var string
     */
    protected $_templateFile;

    protected $_defaultOptions = array();

    protected $_requiredOptions = array();

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

    public function isCompatibleWithOptions($options)
    {
        if (count(array_diff(
            array_keys($this->_requiredOptions),
            array_keys($options)
        ))) {
            return false;
        }
        return true;
    }
}
