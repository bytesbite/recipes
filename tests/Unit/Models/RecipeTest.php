<?php

namespace Unit\Models;

class RecipeTest extends \PHPUnit_Framework_TestCase
{
    private $recipes;

    public function setUp()
    {
        $this->recipes = json_decode(file_get_contents(dirname(dirname(__DIR__)).'/fixtures/recipes.json'));
    }

    public function testInstantiate()
    {
        $r = new \Models\Recipe($this->recipes[0]->name, $this->recipes[0]->ingredients);
        $this->assertEquals($r->name, $this->recipes[0]->name);
        $this->assertEquals($r->ingredients, $this->recipes[0]->ingredients);
    }
}
