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

    /**
     * Construct an ingrident class.
     *
     * @param String  $name    name of ingredient
     * @param Integer $amount  amount of this we have in the fridge
     * @param String  $unit    the unit this ingredient is measured in
     * @param String  $useBy   the date this ingredient expires, must be dd/mm/yyyy
     *
     * @throws InvalidIngredientException if isAValidIngrident returns false
     */
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

    /**
     * Compare a recipe ingredient and one in the fridge and see if they match
     *
     * @todo rename this method, isUsable is a bad name
     *
     * @param  \Models\Ingredient  $ingrident
     * @return boolean  true if ingredient in fridge matches ignredient in recipe and hasn't expired,
     *                       false otherwise
     */
    public function isUsable($ingrident)
    {
        return $this->name == $ingrident->name &&
            $this->amount >= $ingrident->amount &&
            $this->unit == $ingrident->unit &&
            !$this->hasExpired();
    }

    /**
     * @return boolean true if name, amount and unit are not empty and
     *                      name is one or more words and
     *                      amount is a number
     *                      unit is one of "of" or "ml" or "slices" or "grams"
     */
    public function isAValidIngrident()
    {
        $rules = array(
            'name' => '/(\w+)/',
            'amount' => '/^(\d+)$/',
            'unit' => '/^(of|ml|slices|grams)$/i',
        );

        foreach ($rules as $key => $rule) {
            if (!empty($this->$key) && !preg_match($rules[$key], $this->$key)) {
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

class InvalidDateFormatException extends \Exception {}
