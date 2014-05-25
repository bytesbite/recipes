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
        $r = new \Models\Recipe($this->recipes[0]->name);
        $this->assertEquals($r->name, $this->recipes[0]->name);
        $this->assertEmpty($r->ingredients);
        $this->assertTrue($r->canBeCooked);
        $this->assertEquals($r->earliestExpiryDate, 0);
    }

    public function testAddIngredient()
    {
        $r = new \Models\Recipe($this->recipes[0]->name);

        foreach ($this->recipes[0]->ingredients as $i) {
            $r->addIngredient(new \Models\Ingredient($i->item, $i->amount, $i->unit));
        }

        $this->assertEquals(count($r->ingredients), count($this->recipes[0]->ingredients));
    }

    /**
     * @todo expecting a generic exception is hacky, need to find out what PHP throws
     * @expectedException \Exception
     */
    public function testAddIngredient_EnforcesType()
    {
        $r = new \Models\Recipe('foo');
        $r->addIngredient(new \stdClass());
    }
}
