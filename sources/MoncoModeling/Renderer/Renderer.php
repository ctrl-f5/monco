<?php

namespace Monco\Modeling\Renderer;

class Renderer
{
    public function renderClass(\Monco\Modeling\Model\ClassModel $class, array $properties)
    {
        $renderer = function () use ($class, $properties) {
            \ob_start();
            echo '<?php'.PHP_EOL;
            include($class->getTemplateFile());
            $content = \ob_get_contents();
            \ob_end_clean();
            $beauty = new \PHP_Beautifier();
            $beauty->setInputString($content);
            $beauty->addFilter(
                'NewLines',
                array(
                    'before' => 'T_DOC_COMMENT',
                    'after' => 'T_CLASS'
                )
            );
            $beauty->addFilter(
                'NewLines',
                array(
                    'before' => 'T_DOC_COMMENT',
                    'after' => 'T_CLASS'
                )
            );

            $beauty->process();
            return $beauty->get();
            
            return $content;
        };

        return $renderer();
    }
}
