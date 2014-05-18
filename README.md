## recipes

A recipe finder application. This application is a console application which performs the following tasks.
- load ingridents csv
- load recipe json
- provide recipe suggestion

## components

- models : the models directory provides a Ingredient model and Recipe model
- controllers : this provides Ingirdents, Recipe and Suggestion controller
- Goodby CSV parser is used to parse the ingridents CSV
- expressive-date is used for easy date comparions, i could have just used timestamps :)

## todo
- unit tests need a cleanup as they are becoming integration tests, need to mock Ingredient class in \Unit\Models\RecipeTest class.
- add a view layer and either port app to laravel or slim
- input data validation
- need to refactor analyseFridge into suggestor and then wrap integration tests around the Suggestor

## instructions

run the following commands

```
composer install
php app.php
```
