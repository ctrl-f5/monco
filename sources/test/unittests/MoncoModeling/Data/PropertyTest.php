<?php

namespace Test\Monco\Modeling\Data;

use \Monco;

/**
 * @group Monco_Modeling
 */
class PropertyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Monco\Modeling\Data\Property
     */
    protected $_model;

    public function setUp()
    {
        $this->_model = new \Monco\Modeling\Data\Property();
    }

    public function tearDown()
    {
        $this->_model = null;
    }

    public function testCanParseDataWithMinimumAmountKeys()
    {
        $data = array(
            'id' => 'name',
            'type' => 'string'
        );

        $this->_model->parseData($data);

        $this->assertEquals($data['id'], $this->_model->getId());
        $this->assertEquals($data['type'], $this->_model->getType());
        $this->assertEquals(array(), $this->_model->getOptions());
        $this->assertEquals($data['id'], $this->_model->getName());
    }

    public function testCanParseDataWithNameKey()
    {
        $data = array(
            'id' => 'theID',
            'name' => 'testName',
            'type' => 'id:MyTeference'
        );

        $this->_model->parseData($data);

        $this->assertEquals($data['id'], $this->_model->getId());
        $this->assertEquals($data['type'], $this->_model->getType());
        $this->assertEquals($data['name'], $this->_model->getName());
    }

    public function testCanParseDataWithOptions()
    {
        $data = array(
            'id' => 'theID',
            'type' => 'id:MyTeference',
            'options' => array(
                'dbField' => 'myfield'
            )
        );

        $this->_model->parseData($data);

        $this->assertEquals($data['id'], $this->_model->getId());
        $this->assertEquals($data['type'], $this->_model->getType());
        $this->assertEquals($data['id'], $this->_model->getName());
        $this->assertEquals($data['options'], $this->_model->getOptions());
    }

    public function testCanGetCamelCasedName()
    {
        $this->_model->setName('testName');
        $this->assertEquals('testName', $this->_model->getNameCamelCased());

        $this->_model->setName('TestName');
        $this->assertEquals('testName', $this->_model->getNameCamelCased());
    }

    public function testCanGetPascalCasedName()
    {
        $this->_model->setName('testName');
        $this->assertEquals('TestName', $this->_model->getNamePascalCased());

        $this->_model->setName('TestName');
        $this->assertEquals('TestName', $this->_model->getNamePascalCased());
    }
}
