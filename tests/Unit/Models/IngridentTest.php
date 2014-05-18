<?php

namespace Unit\Models;

use \Models\Ingrident;

class IngridentTest extends \PHPUnit_Framework_TestCase
{
    public function testCanInstantiate()
    {
        // something about PHP forward-slashe and dates is very confusing... @TODO
        $date = new \DateTime('25-12-2014');
        $i = new Ingrident('bread', 10, Ingrident::SLICES, $date);

        $this->assertNotNull($i);
        $this->assertEquals($i->name, 'bread');
        $this->assertEquals($i->amount, 10);
        $this->assertEquals($i->unit, Ingrident::SLICES);
        $this->assertEquals($i->useBy, $date);
    }

}
