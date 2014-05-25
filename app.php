<?php

require './vendor/autoload.php';

// parse input params, reject if filename's are missing, or paths are incorrect

// parse files
$parser = new \Controllers\Parser();
try {
    $parser->parseIngredientsCsv(__DIR__.'/tests/fixtures/input.csv');
} catch (\Models\InvalidIngredientException $e) {
    echo "bad data in ingredients csv data\n";
    return;
}

try {
    $parser->parseRecipesJson(__DIR__.'/tests/fixtures/recipes.json');
} catch (\Controllers\BadJsonException $e) {
    echo "json input is malformated\n";
    return;
} catch (\Models\InvalidIngredientException $e) {
    echo "bad ingredients data in recipes json\n";
    return;
}

$ingredients = $parser->getIngredients();
$recipes = $parser->getRecipes();

$suggestor = new \Controllers\Suggestor($ingredients, $recipes);
$suggestor->analyseFridge();
echo $suggestor->suggestRecipe()."\n";
