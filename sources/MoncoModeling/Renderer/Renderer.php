<?php

namespace Monco\Modeling\Renderer;

class Renderer
{
    /**
     * @param \Monco\Modeling\Template\Template $template
     * @return string
     */
    public function render($template)
    {
        if ($template instanceof \Monco\Modeling\Template\Template) {
            return $this->renderTemplate($template);
        }
    }

    public function renderTemplate(\Monco\Modeling\Template\Template $template = null)
    {
        \ob_start();
        include($template->getTemplateFile());
        $content = \ob_get_contents();
        \ob_end_clean();
        $content = $this->beautifyPhpString($content);

        return $content;
    }

    public function beautifyPhpString($string)
    {
        if (!trim($string)) return $string;
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
