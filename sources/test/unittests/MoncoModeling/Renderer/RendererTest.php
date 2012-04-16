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
            'tmpl' => $dir."_files".DIRECTORY_SEPARATOR.'empty.template',
        );

        $parser = new \Monco\Modeling\Parser\ModelParser();
        /** @var $model \Monco\Modeling\File\ClassModel */
        $model = $parser->parse($data);

        $this->assertTrue(is_string($this->_renderer->render($model->getTemplate())));
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
            'tmpl' => $dir."_files".DIRECTORY_SEPARATOR.'username.password.template.php',
        );

        $parser = new \Monco\Modeling\Parser\ModelParser();
        /** @var $model \Monco\Modeling\File\ClassModel */
        $model = $parser->parse($data);

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

        $model->getTemplate()->setData($properties);
        $result = $this->_renderer->render($model->getTemplate());
        $this->assertTrue(is_string($result));
        $this->assertSame('userNamepassword', $result);
    }

    public function testCanRenderFileWithCustomClass()
    {
        $dir = __DIR__.DIRECTORY_SEPARATOR;
        $data = array(
            'id' => 'model.entity',
            'name' => 'Entity',
            'tmpl' => array(
                'class' => '\\Monco\\Modeling\\Template\\ClassModel',
                'file' => $dir."_files".DIRECTORY_SEPARATOR.'template.class.template.php'
            )
        );

        $parser = new \Monco\Modeling\Parser\ModelParser();
        /** @var $model \Monco\Modeling\File\ClassModel */
        $model = $parser->parse($data);
        $this->assertInstanceOf($data['tmpl']['class'], $model->getTemplate());
        $this->assertSame($data['tmpl']['file'], $model->getTemplate()->getTemplateFile());
        $this->assertEquals($model, $model->getTemplate()->getClassModel());

        $result = $this->_renderer->render($model->getTemplate());
        $this->assertTrue(is_string($result));
        $this->assertSame($data['tmpl']['class'], $result);
    }

    public function testCanRenderClassModel()
    {
        $classModel = new \Monco\Modeling\File\ClassModel();
        $classModel->setClassName('MyClass')
            ->setClassType('MyType')
            ->setNamespace('\\MyNamespace\\MySubNamespace\\')
            ->setTemplate(array(
                'class' => '\\Monco\\Modeling\Template\ClassModel',
                'file' => __DIR__.'/_files/classModel.template.php'
            ));

        $result = $this->_renderer->render($classModel->getTemplate());
        $this->assertTrue(is_string($result));
    }

    public function testCanRenderClassModelWithProperties()
    {
        $classModel = new \Monco\Modeling\File\ClassModel();
        $classModel->setClassName('MyClass')
            ->setClassType('MyType')
            ->setNamespace('\\MyNamespace\\MySubNamespace\\')
            ->setTemplate(array(
            'class' => '\\Monco\\Modeling\Template\ClassModel',
            'file' => __DIR__.'/_files/classModel.properties.template.php'
        ));

        $properties = array(
            new \Monco\Modeling\Data\Property(array(
                'name' => 'userName',
                'type' => 'string'
            )),
            new \Monco\Modeling\Data\Property(array(
                'name' => 'password',
                'type' => 'string'
            )),
            new \Monco\Modeling\Data\Property(array(
                'name' => 'email',
                'type' => 'string'
            ))
        );

        $classModel->getTemplate()->setData($properties);

        $result = $this->_renderer->render($classModel->getTemplate());
        $this->assertTrue(is_string($result));
        //assert 1 namespace declaration in the file
        $this->assertSame(1, count(explode('namespace MyNamespace\\MySubNamespace;', $result))-1);
        //assert 1 class MyClass in the file
        $this->assertSame(1, count(explode('class MyClass', $result))-1);
        //assert 6 public functions in the file
        $this->assertSame(6, count(explode('public function', $result))-1);
        //assert 3 protected properties in the file
        $this->assertSame(3, count(explode('protected $_', $result))-1);
        //assert 3 fluent interface returns in the file
        $this->assertSame(3, count(explode('return $this;', $result))-1);
    }
}
