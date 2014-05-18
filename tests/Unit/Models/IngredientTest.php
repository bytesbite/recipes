<?php

namespace Unit\Models;

use \Models\Ingredient;

class IngredientTest extends \PHPUnit_Framework_TestCase
{
    public function testCanInstantiate()
    {
        $i = new Ingredient('bread', 10, Ingredient::SLICES, '25/12/2014');

        $this->assertNotNull($i);
        $this->assertEquals($i->name, 'bread');
        $this->assertEquals($i->amount, 10);
        $this->assertEquals($i->unit, Ingredient::SLICES);
        $this->assertEquals($i->useBy, strtotime('25-12-2014'));
    }

    /**
     * @expectedException \Models\InvalidIngredientException
     */
    public function testConstructorThrowsException()
    {
        new Ingredient('#^%$@&%', 10, null, null);
        new Ingredient('bread', 10, null, null);
        new Ingredient('bread', 10, 'kilos', null);
    }

    public function testHasExpired_true()
    {
        $i = new Ingredient('bread', 10, Ingredient::SLICES, '25/12/2013');
        $this->assertTrue($i->hasExpired());
    }

    public function testHasExpired_false()
    {
        $i = new Ingredient('bread', 10, Ingredient::SLICES, '25/12/2014');
        $this->assertFalse($i->hasExpired());
    }

    public function testIsUsable()
    {
        $i = new Ingredient('bread', 10, Ingredient::SLICES, '25/12/2014');
        $compare = new Ingredient('bread', 4, Ingredient::SLICES);

        $this->assertTrue($i->isUsable($compare));
    }
}
