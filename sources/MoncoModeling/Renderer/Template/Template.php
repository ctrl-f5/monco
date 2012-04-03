<?php

namespace Monco\Modeling\Renderer\Template;

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

    public function renderClass()
    {
        \ob_start();
        echo '<?php'.PHP_EOL;
        include($this->getTemplateFile());
        $content = \ob_get_contents();
        \ob_end_clean();
        if (\class_exists('PHP_Beautifier')) {
            $beauty = new \PHP_Beautifier();
            $beauty->setInputString($content);
            $beauty->addFilter(
                'NewLines',
                array(
                    'after' => 'T_DOC_COMMENT'
                )
            );
            $beauty->process();
            $content = $beauty->get();
        }

        return $content;
    }
}
