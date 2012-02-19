<?php

class RenderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var $_classModel \Monco\Modeling\Model\ClassModel
     */
    protected $_classModel;

    /**
     * @var $_parser \Monco\Modeling\Parser\ModelParser
     */
    protected $_parser;

    public function setUp()
    {

        $this->_parser = new \Monco\Modeling\Parser\ModelParser(
            new \Monco\Modeling\Parser\Repo()
        );
        $this->_classModel = $this->_parser->parseModel(array(
            'id' => 'model.entity',
            'name' => 'Entity',
            //'abstract' => null,
            //'extends' => null,
            'namespace' => 'Container',
            'subNamespace' => 'Box',
            'dir' => 'container',
            'subDir' => 'box',
            'tmpl' => __DIR__.'../../../templates/domain.model.php',
        ));
    }

    public function tearDown()
    {
        $this->_classModel = null;
        $this->_parser = null;
    }

    public function testCanRenderClass()
    {

    }
}