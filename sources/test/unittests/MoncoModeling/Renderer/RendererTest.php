<?php

namespace Test\Monco\Modeling\Renderer;

class RendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Monco\Modeling\Renderer\Renderer
     */
    protected $_renderer;

    public function setUp()
    {
        $this->_renderer = new \Monco\Modeling\Renderer\Renderer();
    }

    public function tearDown()
    {
        $this->_renderer = null;
    }

    public function testCanRenderClass()
    {
        $data = array(
            'id' => 'model.entity',
            'name' => 'Entity',
            //'abstract' => null,
            //'extends' => null,
            'namespace' => 'Container',
            'subNamespace' => 'Box',
            'dir' => 'container',
            'subDir' => 'box',
            'tmpl' => '/home/nicky/workspace/monco/lab/sources/templates/domain.model.php',
        );

        $parser = new \Monco\Modeling\Parser\ModelParser(
            new \Monco\Modeling\Parser\Repo()
        );
        $model = $parser->parseModel($data);

        $data = array(
            'id' => 'userName',
            'type' => 'string'
        );
        $properties[] = new \Monco\Modeling\Data\Property();
        $properties[0]->parseData($data);

        $data = array(
            'id' => 'password',
            'type' => 'string'
        );
        $properties[] = new \Monco\Modeling\Data\Property();
        $properties[1]->parseData($data);

        $this->assertTrue(is_string($this->_renderer->renderClass($model, $properties)));
    }
}
