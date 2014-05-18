<?php

namespace Unit\Controllers;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    private $parser;

    public function setUp()
    {
        $this->parser = new \Controllers\Parser();
    }

    public function testParseIngridentsCsv()
    {
        $filename = dirname(dirname(__DIR__)).'/fixtures/input.csv';
        $rowCount = count(file($filename));

        $this->parser->parseIngredientsCsv($filename);
        $ingredients = $this->parser->getIngredients();

        $this->assertNotEmpty($ingredients);
        $this->assertEquals(count($ingredients), $rowCount);
    }

    public function testParseIngridentsCsv_ReturnsEmpty()
    {
        $this->parser->parseIngredientsCsv('');
        $this->assertEmpty($this->parser->getIngredients());
    }

}
