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
        };

        return $renderer();
    }
}
