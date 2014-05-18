# recipes

A recipe finder application. This application is a console application which performs the following tasks.
- load ingridents csv
- load recipe json
- provide recipe suggestion

# application components

- models : the models directory provides a Ingredient model and Recipe model
- controllers : this provides Ingirdents, Recipe and Suggestion controller
- Goodby CSV parser is used to parse the ingridents CSV

# instructions

run the following commands

```
composer install
php app.php
```