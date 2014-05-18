<?php

namespace Controllers;

use \Models\Recipe;
use \Models\Ingredient;

class Suggestor
{
    private $recipes = array();
    private $ingredients = array();

    public function __construct($ingredients = array(), $recipes = array())
    {
        $this->ingredients = $ingredients;
        $this->recipes = $recipes;
    }

    public function run()
    {
        if (empty($this->recipes) || empty($this->ingredients)) {
            return "Order Takeout";
        }

        $result = array();
        foreach ($this->recipes as $r) {

        }
        return $result;
    }
}
