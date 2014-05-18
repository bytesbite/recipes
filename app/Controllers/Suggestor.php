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

    public function suggestRecipe()
    {
        if (empty($this->recipes) || empty($this->ingredients)) {
            return "Order Takeout";
        }

        $results = array();
        foreach ($this->recipes as $r) {
            $r->analyseFridge($this->ingredients);

            if ($r->canBeCooked) {
                $results[$r->name] = $r->earliestExpiryDate;
            }
        }

        asort($results);
        return key($results);
    }
}
