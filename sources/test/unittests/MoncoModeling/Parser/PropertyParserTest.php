<?php

namespace Test\Monco\Modeling\Parser;

class PropertyParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Monco\Modeling\Parser\PropertyParser
     */
    protected $_parser;

    public function setUp()
    {
        $this->_parser = new \Monco\Modeling\Parser\PropertyParser();
    }

    public function tearDown()
    {
        $this->_parser = null;
    }

    public function testCanParseProperties()
    {
        $data = array(
            array(
                'id' => 'id',
                'type' => 'int',
                'options' => array(
                    'dbfield' => 'id',
                )
            ),
            array(
                'id' => 'default:',
                'name' => 'name',
                'type' => 'string',
                'options' => array(
                    'dbfield' => 'name',
                )
            ),
            array(
                'id' => 'user',
                'type' => 'id:monco.model.user',
                'options' => array(
                    'dbfield' => 'name',
                )
            )
        );

        $props = $this->_parser->parseProperties($data);

        $this->assertEquals(3, count($props));
    }
}