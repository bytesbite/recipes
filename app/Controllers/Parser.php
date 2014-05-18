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
        $this->ingredients = $this->constructIngridents($data);
    }

    protected function constructIngridents($data)
    {
        $ingridents = array();

        foreach ($data as $d) {
            $row = (object)$d;
            $date = (isset($row->date)) ? new \ExpressiveDate(str_replace('/', '-', $row->date)) : null;

            $ingredients[$row->item] = new \Models\Ingrident($row->item, $row->amount, $row->unit, $date);
        }

        return $ingredients;
    }

    public function parseRecipesJson($file)
    {
        if (!file_exists($file)) {
            return;
        }

        $json = json_decode(file_get_contents($file));
        foreach($json as $r) {
            $this->recipes[] = new \Models\Recipe($r->name, $this->constructIngridents($r->ingredients));
        }
    }
}
