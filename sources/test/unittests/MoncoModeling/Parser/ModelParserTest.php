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
            //'abstract' => null,
            //'extends' => null,
            'namespace' => 'Container',
            'subNamespace' => 'Box',
            'dir' => 'container',
            'subDir' => 'box',
            'tmpl' => '/my/file.php',
        );

        $model = $this->_parser->parseModel($data);

        $this->assertInstanceOf('\\Monco\\Modeling\\Model\\ClassModel', $model);
    }
}