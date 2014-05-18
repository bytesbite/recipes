<?php

namespace Unit\Models;

class RecipeTest extends \PHPUnit_Framework_TestCase
{
    public function testInstantiate()
    {
        $r = new \Models\Recipe();
        $this->assertNotNull($r);
    }
}