<?php

namespace Controllers;

use League\Csv\Reader;

class Parser
{
    private $ingredients = array();

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
            $date = str_replace('/', '-', $row->date);
            $this->ingredients[] = new \Models\Ingrident($row->item, $row->amount, $row->unit, new \ExpressiveDate($date));
        }
    }

    public function parseRecipesJson()
    {

    }
}