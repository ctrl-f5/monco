<?php

namespace Test\Monco\Modeling\Template;

class TemplateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Monco\Modeling\Template\Template
     */
    protected $_template;

    public function setUp()
    {
        $this->_template = new \Monco\Modeling\Template\Template();
    }

    public function tearDown()
    {
        $this->_template = null;
    }

    public function testCanRenderTemplate()
    {
    }
}
