<?php

namespace Controllers;

use League\Csv\Reader;

class Parser
{
    private $ingredients = array();
    private $recipes = array();

    public function getRecipes()
    {
        return $this->recipes;
    }

    public function getIngredients()
    {
        return $this->ingredients;
    }

    public function parseIngredientsCsv($file)
    {
        if (!file_exists($file)) {
            return;
        }

        $csv = new Reader($file);
        $data = $csv->fetchAssoc(array('item', 'amount', 'unit', 'date'));

        foreach ($data as $d) {
            $row = (object)$d;
            $this->ingredients[$row->item] = new \Models\Ingredient($row->item, $row->amount, $row->unit, $row->date);
        }
    }

    public function parseRecipesJson($file)
    {
        if (!file_exists($file)) {
            return;
        }

        $json = json_decode(file_get_contents($file));
        if ($json === FALSE or $json === NULL) {
            throw new BadJsonException();
        }

        foreach($json as $r) {
            $recipe = new \Models\Recipe($r->name);
            array_walk($r->ingredients, function($i) use($recipe) {
                $row = (object)$i;
                $recipe->addIngredient(new \Models\Ingredient($row->item, $row->amount, $row->unit, null));
            });
            $this->recipes[] = $recipe;
        }
    }
}

class BadJsonException extends \Exception {}

