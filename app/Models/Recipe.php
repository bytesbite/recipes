<?php

namespace Models;

class Recipe
{
    private $name;
    private $ingredients = array();

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function addIngredient(\Models\Ingredient $ingredient)
    {
        $this->ingredients[$ingredient->name] = $ingredient;
    }

    public function canBeCooked($ingridents)
    {
        foreach ($ingredients as $i) {
            if (isset($this->ingredients[$i->name])) {

            }
        }

        return false;
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
