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

    /**
     * AnalyseFridge will examine the contents of the fridge and find a recipe that can be cooked
     */
    public function analyseFridge()
    {
        // @todo: need to figure out what the right way is to do this
        $self = $this;
        array_walk($this->recipes, function($r) use ($self) {
            $self->analyseRecipe($r, $self->ingredients);
        });
    }

    /**
     * AnalyseRecipe, refactoed into its own method, will examine a given recipe and the check
     * if the fridge has the ingridents to allow it to be used.
     *
     * This allows us to unit test this logic easily
     *
     * @param \Models\Recipe $r
     */
    public function analyseRecipe(\Models\Recipe $r, $ingredients)
    {
        $r->earliestExpiryDate = 0;
        $r->canBeCooked = true;

        foreach ($r->ingredients as $name => $i) {
            // if it's not in the fridge, we can't cook it
            if (!isset($ingredients[$name])) {
                $r->canBeCooked = false;
                $r->earliestExpiryDate = 0;
                return;
            }

            // else
            $fridgeIngredient = $ingredients[$name];
            if ($fridgeIngredient->isUsable($i) &&
                ($r->earliestExpiryDate == 0 || $fridgeIngredient->useBy < $r->earliestExpiryDate))
            {
                $r->earliestExpiryDate = $fridgeIngredient->useBy;
            }
        }
    }

    public function suggestRecipe()
    {
        if (empty($this->recipes) || empty($this->ingredients)) {
            return "Order Takeout";
        }

        $results = array();
        foreach ($this->recipes as $r) {
            if ($r->canBeCooked) {
                $results[$r->name] = $r->earliestExpiryDate;
            }
        }

        asort($results);
        return key($results);
    }
}
