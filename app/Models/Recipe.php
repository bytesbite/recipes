<?php

namespace Models;

class Recipe
{
    private $name;
    private $ingredients = array();
    private $canBeCooked = true;
    private $earliestExpiryDate = 0;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function addIngredient(\Models\Ingredient $ingredient)
    {
        $this->ingredients[$ingredient->name] = $ingredient;
    }

    public function analyseFridge($ingredients)
    {
        $this->earliestExpiryDate = 0;
        $this->canBeCooked = true;

        foreach ($this->ingredients as $name => $i) {
            // if it's not in the fridge, we can't cook it
            if (!isset($ingredients[$name])) {
                $this->canBeCooked = false;
                $this->earliestExpiryDate = 0;
                return;
            }

            // else
            $fridgeIngredient = $ingredients[$name];
            if ($fridgeIngredient->isUsable($i) &&
                ($this->earliestExpiryDate == 0 || $fridgeIngredient->getUsebyTimestamp() < $this->earliestExpiryDate))
            {
                $this->earliestExpiryDate = $fridgeIngredient->getUsebyTimestamp();
            }
        }
    }

    public function __get($property)
    {
        return (property_exists($this, $property)) ? $this->$property : null;
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property))
            $this->$property = $value;
    }
}
