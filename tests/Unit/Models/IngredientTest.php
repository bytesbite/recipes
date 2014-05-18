<?php

namespace Unit\Models;

use \Models\Ingredient;

class IngredientTest extends \PHPUnit_Framework_TestCase
{
    public function testCanInstantiate()
    {
        // something about PHP forward-slashe and dates is very confusing... @TODO
        $date = new \ExpressiveDate('25-12-2014');
        $i = new Ingredient('bread', 10, Ingredient::SLICES, $date);

        $this->assertNotNull($i);
        $this->assertEquals($i->name, 'bread');
        $this->assertEquals($i->amount, 10);
        $this->assertEquals($i->unit, Ingredient::SLICES);
        $this->assertEquals($i->useBy, $date);
    }

    public function testHasExpired_true()
    {
        $date = new \ExpressiveDate();
        $i = new Ingredient('bread', 10, Ingredient::SLICES, $date);
        $this->assertTrue($i->hasExpired());
    }

    public function testHasExpired_false()
    {
        $date = new \ExpressiveDate('25-12-2014');
        $i = new Ingredient('bread', 10, Ingredient::SLICES, $date);
        $this->assertFalse($i->hasExpired());
    }

    public function testGetUsebyTimestamp()
    {
        $date = new \ExpressiveDate();
        $i = new Ingredient('bread', 10, Ingredient::SLICES, $date);
        $this->assertEquals($i->getUsebyTimestamp(), $date->getTimestamp());
    }

    public function testIsUsable()
    {
        $date = new \ExpressiveDate('25-12-2014');
        $i = new Ingredient('bread', 10, Ingredient::SLICES, $date);
        $compare = new Ingredient('bread', 4, Ingredient::SLICES);

        $this->assertTrue($i->isUsable($compare));
    }
}
