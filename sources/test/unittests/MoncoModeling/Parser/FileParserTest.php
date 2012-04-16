<?php

namespace Test\Monco\Modeling\Parser;

class FileParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Monco\Modeling\Parser\FileParser
     */
    protected $_parser;

    public function setUp()
    {
        $this->_parser = new \Monco\Modeling\Parser\FileParser();
    }

    public function tearDown()
    {
        $this->_parser = null;
    }

    public function testCanParseFile()
    {
        $data = array(
            'tmpl' => 'file:/my/file.php',
        );

        /** @var $model \Monco\Modeling\File\File */
        $model = $this->_parser->parse($data);

        $this->assertInstanceOf('\\Monco\\Modeling\\File\\File', $model);
        $this->assertSame(str_replace('file:', '', $data['tmpl']), $model->getTemplate()->getTemplateFile());
        $this->assertSame(NULL, $model->getParent());
    }

    public function testCanParseModelWithParent()
    {
        $this->markTestIncomplete();
    }
}