<?php

namespace Models;

class Ingredient
{
    const OF = 'of';
    const GRAMS = 'grams';
    const ML = 'ml';
    const SLICES = 'slices';

    private $name;
    private $amount;
    private $unit;
    private $useBy;

    public function __construct($name, $amount, $unit, $useBy = null)
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->unit = $unit;

        if (!is_null($useBy) && preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})/', $useBy)) {
            $this->useBy = strtotime(str_replace('/', '-', $useBy));
        }

        if (!$this->isAValidIngrident()) {
            throw new InvalidIngredientException();
        }
    }

    /**
     * true if ingrident useBy date is in the future, false otherwise
     * @return boolean
     */
    public function hasExpired()
    {
        return $this->useBy <= time();
    }

    public function isUsable($ingrident)
    {
        return $this->name == $ingrident->name &&
            $this->amount >= $ingrident->amount &&
            $this->unit == $ingrident->unit &&
            !$this->hasExpired();
    }

    private function isAValidIngrident()
    {
        $rules = array(
            'name' => '/^(.*)$/',
            'amount' => '/^(\d+)$/',
            'unit' => '/^(of|ml|slices|grams)$/i',
        );

        foreach ($rules as $key => $rule) {
            if (!preg_match($rules[$key], $this->$key)) {
                return false;
            }
        }

        return true;
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

class InvalidIngredientException extends \Exception {}