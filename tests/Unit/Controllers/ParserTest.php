<?php

namespace Unit\Controllers;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    private $parser;

    public function setUp()
    {
        $this->parser = new \Controllers\Parser();
    }

    public function testParseIngredientsCsv()
    {
        $filename = dirname(dirname(__DIR__)).'/fixtures/input.csv';
        $rowCount = count(file($filename));

        $this->parser->parseIngredientsCsv($filename);
        $ingredients = $this->parser->getIngredients();

        $this->assertNotEmpty($ingredients);
        $this->assertEquals(count($ingredients), $rowCount);

        foreach ($ingredients as $name => $ingrident) {
            $this->assertTrue($ingrident instanceof \Models\Ingredient);
            $this->assertEquals($name, $ingrident->name);
        }
    }

    public function testParseIngredientsCsv_ReturnsEmpty()
    {
        $this->parser->parseIngredientsCsv('');
        $this->assertEmpty($this->parser->getIngredients());
    }

    public function testParseIngredientsJson_ReturnsEmpty()
    {
        $this->parser->parseRecipesJson('');
        $this->assertEmpty($this->parser->getRecipes());
    }

    public function testParseRecipesJson()
    {
        $filename = dirname(dirname(__DIR__)).'/fixtures/recipes.json';

        $this->parser->parseRecipesJson($filename);
        $recipes = $this->parser->getRecipes();

        $this->assertNotEmpty($recipes);
        $this->assertEquals($recipes[0]->name, 'grilledcheeseontoast');

        foreach ($recipes[0]->ingredients as $name => $i) {
            $this->assertTrue($i instanceof \Models\Ingredient);
            $this->assertEquals($name, $i->name);
        }
    }
}
