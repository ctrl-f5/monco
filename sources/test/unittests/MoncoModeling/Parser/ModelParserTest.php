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

        /** @var $model \Monco\Modeling\File\ClassModel */
        $model = $this->_parser->parse($data);

        $this->assertInstanceOf('\\Monco\\Modeling\\File\\ClassModel', $model);
        $this->assertSame($data['id'], $model->getId());
        $this->assertSame($data['name'], $model->getClassName());
        $this->assertSame($data['namespace'], $model->getNamespace());
        $this->assertSame($data['dir'], $model->getDirectory());
        $this->assertSame(str_replace('', '', $data['tmpl']), $model->getTemplate()->getTemplateFile());
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

        /** @var $parent \Monco\Modeling\File\ClassModel */
        $parent = $this->_parser->parse($parentData);

        $this->assertInstanceOf('\\Monco\\Modeling\\File\\ClassModel', $parent);
        $this->assertSame($parentData['id'], $parent->getId());
        $this->assertSame($parentData['name'], $parent->getClassName());
        $this->assertSame($parentData['namespace'], $parent->getNamespace());
        $this->assertSame($parentData['dir'], $parent->getDirectory());
        $this->assertSame(str_replace('', '', $parentData['tmpl']), $parent->getTemplate()->getTemplateFile());
        $this->assertSame(NULL, $parent->getParent());

        $modelData = array(
            'id' => 'model.branch',
            'name' => 'Branch',
            'extends' => 'model.parent',
            'namespace' => 'Branch',
            'dir' => 'branch',
            'tmpl' => '/my/branchfile.php',
        );

        /** @var $model \Monco\Modeling\File\ClassModel */
        $model = $this->_parser->parse($modelData);

        $this->assertInstanceOf('\\Monco\\Modeling\\File\\ClassModel', $model);
        $this->assertSame($modelData['id'], $model->getId());
        $this->assertSame($modelData['name'], $model->getClassName());
        $this->assertSame($modelData['namespace'], $model->getNamespace());
        $this->assertSame($modelData['dir'], $model->getDirectory());
        $this->assertSame(str_replace('', '', $modelData['tmpl']), $model->getTemplate()->getTemplateFile());

        $this->assertInstanceOf('\\Monco\\Modeling\\File\\ClassModel', $model->getParent());
        $this->assertSame(NULL, $parent->getParent());
        $this->assertSame($parent, $model->getParent());
    }
}