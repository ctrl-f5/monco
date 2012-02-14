<?php

namespace Test\Monco\Config;

use \Monco;

/**
 * @group Monco_Config
 */
class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function setUp() {}

    public function tearDown() {}

    public function testConstruction()
    {
        $model = new \Monco\Config\Config();
        $this->assertInstanceOf('\\Monco\\Config\\Config', $model);
    }
}
