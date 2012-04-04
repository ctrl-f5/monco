<?php

namespace Test\Monco\Modeling\File;

class ClassModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Monco\Modeling\File\ClassModel
     */
    protected $_model;

    public function setUp()
    {
        $this->_model = new \Monco\Modeling\File\ClassModel();
    }

    public function tearDown()
    {
        $this->_model = null;
    }

    public function testModelWithoutParent()
    {
        $data = array(
            'id' => 'model.entity',
            'name' => 'Entity',
            'namespace' => 'Container',
            'dir' => 'container',
            'tmpl' => 'file:/my/file.php',
        );

        //fluent interfaces
        $this->assertInstanceOf('\\Monco\\Modeling\\File\\ClassModel', $this->_model->setId($data['id']));
        $this->assertInstanceOf('\\Monco\\Modeling\\File\\ClassModel', $this->_model->setClassName($data['name']));
        $this->assertInstanceOf('\\Monco\\Modeling\\File\\ClassModel', $this->_model->setNamespace($data['namespace']));
        $this->assertInstanceOf('\\Monco\\Modeling\\File\\ClassModel', $this->_model->setDirectory($data['dir']));
        $this->assertInstanceOf('\\Monco\\Modeling\\File\\ClassModel', $this->_model->setTemplate($data['tmpl']));

        $this->assertEquals($data['id'], $this->_model->getId());
        $this->assertEquals($data['name'], $this->_model->getClassName());
        $this->assertEquals($data['namespace'], $this->_model->getNamespace());
        $this->assertEquals($data['dir'], $this->_model->getDirectory());
        $this->assertEquals(str_replace('file:', '', $data['tmpl']), $this->_model->getTemplate()->getTemplateFile());
    }

    public function testCanGetFullDirectoryWithParent()
    {
        $parentData = array(
            'dir' => 'parent'.DIRECTORY_SEPARATOR,
        );

        $parent = new \Monco\Modeling\File\ClassModel();
        $parent->setDirectory($parentData['dir']);
        $this->_model->setParent($parent);

        /**
         * When overriding
         */
        $data = array(
            'dir' => DIRECTORY_SEPARATOR.'child',
        );
        $this->_model->setDirectory($data['dir']);

        $this->assertSame($data['dir'], $this->_model->getFullDirectory());

        /**
         * When combining
         */
        $data = array(
            'dir' => 'child'.DIRECTORY_SEPARATOR,
        );
        $this->_model->setDirectory($data['dir']);

        $this->assertSame($parentData['dir'].$data['dir'], $this->_model->getFullDirectory());
    }

    public function testCanGetFullDirectoryWithMultipleParents()
    {
        $parentData = array(
            'dir' => 'parent'.DIRECTORY_SEPARATOR,
        );

        $parent = new \Monco\Modeling\File\ClassModel();
        $parent->setDirectory($parentData['dir']);
        $this->_model->setParent($parent);

        $parentData2 = array(
            'dir' => 'parent2'.DIRECTORY_SEPARATOR,
        );

        $parent2 = new \Monco\Modeling\File\ClassModel();
        $parent2->setDirectory($parentData2['dir']);
        $parent->setParent($parent2);

        /**
         * When overriding
         */
        $data = array(
            'dir' => DIRECTORY_SEPARATOR.'child',
        );
        $this->_model->setDirectory($data['dir']);

        $this->assertSame($data['dir'], $this->_model->getFullDirectory());

        /**
         * When combining
         */
        $data = array(
            'dir' => 'child'.DIRECTORY_SEPARATOR,
        );
        $this->_model->setDirectory($data['dir']);

        $this->assertSame($parentData2['dir'].$parentData['dir'].$data['dir'], $this->_model->getFullDirectory());

        /**
         * When combining only first parent
         */
        $parent->setDirectory(DIRECTORY_SEPARATOR.$parent->getDirectory());
        $this->_model->setDirectory($data['dir']);

        $this->assertSame(DIRECTORY_SEPARATOR.$parentData['dir'].$data['dir'], $this->_model->getFullDirectory());
    }

    public function testCanGetFullNamespaceWithParent()
    {
        $parentData = array(
            'namespace' => '\\Parent',
        );

        $parent = new \Monco\Modeling\File\ClassModel();
        $parent->setNamespace($parentData['namespace']);
        $this->_model->setParent($parent);

        /**
         * When overriding
         */
        $data = array(
            'namespace' => '\\Child',
        );
        $this->_model->setNamespace($data['namespace']);

        $this->assertSame($data['namespace'], $this->_model->getFullNamespace());

        /**
         * When combining
         */
        $data = array(
            'namespace' => 'Child',
        );
        $this->_model->setNamespace($data['namespace']);

        $this->assertSame($parentData['namespace'].'\\'.$data['namespace'], $this->_model->getFullNamespace());
    }

    public function testCanGetFullNamespaceWithMultipleParents()
    {
        $parentData = array(
            'namespace' => 'Branch',
        );

        $parent = new \Monco\Modeling\File\ClassModel();
        $parent->setNamespace($parentData['namespace']);
        $this->_model->setParent($parent);

        $parentData2 = array(
            'namespace' => 'Root',
        );

        $parent2 = new \Monco\Modeling\File\ClassModel();
        $parent2->setNamespace($parentData2['namespace']);
        $parent->setParent($parent2);

        /**
         * When overriding
         */
        $data = array(
            'namespace' => '\\Leaf',
        );
        $this->_model->setNamespace($data['namespace']);

        $this->assertSame($data['namespace'], $this->_model->getFullNamespace());

        /**
         * When combining
         */
        $data = array(
            'namespace' => 'Leaf',
        );
        $this->_model->setNamespace($data['namespace']);

        $this->assertSame($parentData2['namespace'].'\\'.$parentData['namespace'].'\\'.$data['namespace'], $this->_model->getFullNamespace());

        /**
         * When combining only first parent
         */
        $parent->setNamespace('\\'.$parent->getNamespace());
        $this->_model->setNamespace($data['namespace']);

        $this->assertSame('\\'.$parentData['namespace'].'\\'.$data['namespace'], $this->_model->getFullNamespace());
    }
}