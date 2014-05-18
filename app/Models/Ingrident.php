<?php

namespace Models;

class Ingrident
{
    const OF = 'of';
    const GRAMS = 'grams';
    const ML = 'ml';
    const SLICES = 'slices';

    private $name;
    private $amount;
    private $unit;
    private $useBy;

    public function __construct($name, $amount, $unit, \ExpressiveDate $useBy)
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->unit = $unit;
        $this->useBy = $useBy;
    }

    /**
     * true if ingrident useBy date is in the future, false otherwise
     * @return boolean
     */
    public function hasExpired()
    {
        $today = new \ExpressiveDate();
        return
            $this->useBy->getDifferenceInYears($today) == 0 &&
            $this->useBy->getDifferenceInMonths($today) == 0 &&
            $this->useBy->getDifferenceInDays($today) == 0;
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
