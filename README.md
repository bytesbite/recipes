## recipes

A recipe finder application. This application is a console application which performs the following tasks.
- load ingridents csv
- load recipe json
- provide recipe suggestion

## components

- models : the models directory provides a Ingredient model and Recipe model
- controllers : this provides Ingirdents, Recipe and Suggestion controller
- Goodby CSV parser is used to parse the ingridents CSV

## todo
- unit tests need a cleanup as they are becoming integration tests, need to mock Ingredient class in \Unit\Models\RecipeTest class.
- add a view layer and either port app to laravel or slim
- input data validation
- need to refactor analyseFridge into suggestor and then wrap integration tests around the Suggestor

## notes
I had planned to make this a web application with the following changes
- consider using a database to store fridge ingredients and receipes
- add background job processing using php-resque to parse CSV and JSON files
- use Laravel or Slim for view management and restful routes

## instructions

run the following commands

```
composer install
php app.php
```
