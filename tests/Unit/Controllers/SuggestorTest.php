<?php

namespace Unit\Controllers;

class SuggestorTest extends \PHPUnit_Framework_TestCase
{
    public function testOrderTakeout()
    {
        $s = new \Controllers\Suggestor();
        $this->assertEquals($s->suggestRecipe(), 'Order Takeout');
    }
}
