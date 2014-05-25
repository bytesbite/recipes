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

    /**
     * add ingredient instance to this recipe
     * @param ModelsIngredient $ingredient
     */
    public function addIngredient(\Models\Ingredient $ingredient)
    {
        $this->ingredients[$ingredient->name] = $ingredient;
    }

    // magic methods
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
