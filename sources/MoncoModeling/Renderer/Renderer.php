<?php

namespace Monco\Modeling\Renderer;

class Renderer
{
    public function render($data)
    {
        if (is_string($data)) {
            if (file_exists($data)) {
                $file = new \Monco\Modeling\File\File();
                $file->setTemplateFile($data);
                $data = $file;
            }
        }
        if ($data instanceof \Monco\Modeling\File\File) {
            return $this->renderFile($data);
        }
        if ($data instanceof \Monco\Modeling\Template\Template) {
            return $this->renderTemplate($data);
        }
    }

    public function renderTemplate(\Monco\Modeling\Template\Template $template = null, $data = array())
    {
        \ob_start();
        include($template->getTemplateFile());
        $content = \ob_get_contents();
        \ob_end_clean();
        //$content = $this->beautifyPhpString($content);

        return $content;
    }

    public function renderFile(\Monco\Modeling\File\File $file = null)
    {

    }

    public function beautifyPhpString($string)
    {
        if (\class_exists('PHP_Beautifier')) {
            $beauty = new \PHP_Beautifier();
            $beauty->setInputString($string);
            $beauty->addFilter(
                'NewLines',
                array(
                    'after' => 'T_DOC_COMMENT'
                )
            );
            $beauty->process();
            $string = $beauty->get();
        }
        return $string;
    }
}
