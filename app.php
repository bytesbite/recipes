<?php

require './vendor/autoload.php';

// parse input params, reject if filename's are missing, or paths are incorrect

// parse files
$parser = new \Controllers\Parser();
$parser->parseIngredientsCsv(__DIR__.'/tests/fixtures/input.csv');
$parser->parseRecipesJson(__DIR__.'/tests/fixtures/recipes.json');

$ingredients = $parser->getIngredients();
$recipes = $parser->getRecipes();

$suggestor = new \Controllers\Suggestor($ingredients, $recipes);
echo $suggestor->suggestRecipe()."\n";
