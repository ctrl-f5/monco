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

    public function testCanParseData()
    {
        $data = array(
            'id' => 'name',
            'type' => 'string',
            'options' => array(
                'dbfield' => 'name',
            )
        );

        $this->_model->parseData($data);

        $this->assertEquals($data['id'], $this->_model->getId());
        $this->assertEquals($data['type'], $this->_model->getType());
        $this->assertEquals($data['options'], $this->_model->getOptions());
        $this->assertEquals($data['id'], $this->_model->getName());

        $data = array(
            'id' => 'theID',
            'name' => 'testName',
            'type' => 'id:MyTeference'
        );

        $this->_model->parseData($data);

        $this->assertEquals($data['id'], $this->_model->getId());
        $this->assertEquals($data['type'], $this->_model->getType());
        $this->assertEquals(array(), $this->_model->getOptions());
        $this->assertEquals($data['name'], $this->_model->getName());
    }
}
