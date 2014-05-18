<?php

namespace Models;

class Recipe
{
    private $name;
    private $ingredients = array();

    public function __construct($name, Array $ingredients)
    {
        $this->name = $name;
        $this->ingredients = $ingredients;
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