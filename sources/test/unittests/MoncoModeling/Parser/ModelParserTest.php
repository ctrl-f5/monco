<?php

namespace Test\Monco\Modeling\Parser;

class ModelParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Monco\Modeling\Parser\ModelParser
     */
    protected $_parser;

    public function setUp()
    {
        $this->_parser = new \Monco\Modeling\Parser\ModelParser(
            new \Monco\Modeling\Parser\Repo()
        );
    }

    public function tearDown()
    {
        $this->_parser = null;
    }

    public function testCanParseModel()
    {
        $data = array(
            'id' => 'model.entity',
            'name' => 'Entity',
            'namespace' => 'Container',
            'dir' => 'container',
            'tmpl' => '/my/file.php',
        );

        /** @var $model \Monco\Modeling\Model\ClassModel */
        $model = $this->_parser->parseModel($data);

        $this->assertInstanceOf('\\Monco\\Modeling\\Model\\ClassModel', $model);
        $this->assertSame($data['id'], $model->getId());
        $this->assertSame($data['name'], $model->getClassName());
        $this->assertSame($data['namespace'], $model->getNamespace());
        $this->assertSame($data['dir'], $model->getDirectory());
        $this->assertSame($data['tmpl'], $model->getTemplateFile());
        $this->assertSame(NULL, $model->getParent());
    }

    public function testCanParseModelWithParent()
    {
        $parentData = array(
            'id' => 'model.parent',
            'name' => 'Parent',
            'namespace' => 'Root',
            'dir' => 'root',
            'tmpl' => '/my/rootfile.php'
        );

        /** @var $parent \Monco\Modeling\Model\ClassModel */
        $parent = $this->_parser->parseModel($parentData);

        $this->assertInstanceOf('\\Monco\\Modeling\\Model\\ClassModel', $parent);
        $this->assertSame($parentData['id'], $parent->getId());
        $this->assertSame($parentData['name'], $parent->getClassName());
        $this->assertSame($parentData['namespace'], $parent->getNamespace());
        $this->assertSame($parentData['dir'], $parent->getDirectory());
        $this->assertSame($parentData['tmpl'], $parent->getTemplateFile());
        $this->assertSame(NULL, $parent->getParent());

        $modelData = array(
            'id' => 'model.branch',
            'name' => 'Branch',
            'extends' => 'model.parent',
            'namespace' => 'Branch',
            'dir' => 'branch',
            'tmpl' => '/my/branchfile.php',
        );

        /** @var $model \Monco\Modeling\Model\ClassModel */
        $model = $this->_parser->parseModel($modelData);

        $this->assertInstanceOf('\\Monco\\Modeling\\Model\\ClassModel', $model);
        $this->assertSame($modelData['id'], $model->getId());
        $this->assertSame($modelData['name'], $model->getClassName());
        $this->assertSame($modelData['namespace'], $model->getNamespace());
        $this->assertSame($modelData['dir'], $model->getDirectory());
        $this->assertSame($modelData['tmpl'], $model->getTemplateFile());

        $this->assertInstanceOf('\\Monco\\Modeling\\Model\\ClassModel', $model->getParent());
        $this->assertSame(NULL, $parent->getParent());
        $this->assertSame($parent, $model->getParent());
    }
}