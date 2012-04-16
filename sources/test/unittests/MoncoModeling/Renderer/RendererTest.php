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

    public function testCanRenderFile()
    {
        $dir = __DIR__.DIRECTORY_SEPARATOR;
        $data = array(
            'id' => 'model.entity',
            'name' => 'Entity',
            'namespace' => 'Container',
            'subNamespace' => 'Box',
            'dir' => 'container',
            'subDir' => 'box',
            'tmpl' => 'file:'.$dir."_files".DIRECTORY_SEPARATOR.'empty.template',
        );

        $parser = new \Monco\Modeling\Parser\ModelParser(
            new \Monco\Modeling\Parser\Repo()
        );
        /** @var $model \Monco\Modeling\File\ClassModel */
        $model = $parser->parseModel($data);

        $this->assertTrue(is_string($this->_renderer->renderTemplate($model->getTemplate())));
    }

    public function testCanRenderFileWithProperties()
    {
        $dir = __DIR__.DIRECTORY_SEPARATOR;
        $data = array(
            'id' => 'model.entity',
            'name' => 'Entity',
            'namespace' => 'Container',
            'subNamespace' => 'Box',
            'dir' => 'container',
            'subDir' => 'box',
            'tmpl' => 'file:'.$dir."_files".DIRECTORY_SEPARATOR.'username.password.template.php',
        );

        $parser = new \Monco\Modeling\Parser\ModelParser(
            new \Monco\Modeling\Parser\Repo()
        );
        /** @var $model \Monco\Modeling\File\ClassModel */
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

        $result = $this->_renderer->renderTemplate($model->getTemplate(), $properties);
        $this->assertTrue(is_string($result));
        $this->assertSame('userNamepassword', $result);
    }
}
