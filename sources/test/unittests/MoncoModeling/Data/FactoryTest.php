<?php

namespace Test\Monco\Modeling\Data;

use \Monco;

/**
 * @group Monco_Modeling
 */
class FactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Monco\Modeling\Data\Factory
     */
    protected $_factory;

    public function setUp()
    {
        $this->_factory = \Monco\Modeling\Data\Factory::getInstance();
    }

    public function tearDown()
    {
        $this->_factory = null;
    }

    public function testCanGetDefaultValue()
    {
        $this->assertEquals(
            '\\Monco\\Modeling\\Data\\Property',
            $this->_factory->getPropertyClass()
        );
    }
}
