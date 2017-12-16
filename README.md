# Laravel 5.5 Dynamic Sort
## Overview
Simply sort your Models by using querystring parameters.

## Install
`composer require marmarait/laraveldynamicsort`

### Optionally you can also add the jQuery Plugin provided to do the frontend part.
`php artisan vendor:publish --provider=MarmaraIT\\LaravelDynamicSort\\DynamicallySortableProvider`

Somewhere in the <head> part of your layout add 

`@include('laraveldynamicsort::short_sort')`

* If you are using gulp simply add "dynamicallySortable.js" to your gulpfile.js
* If you are using laravel-mix add "resources/assets/js/dynamicallySortable.js" to your webpack.mix

## Usage

Backend:

* add the Trait "DynamicallySortable" to your model
* use the scope "ordered" on the model to sort it by querystring:
* add sort=COLUMNAME&dir=[[asc/desc]] to your query string to sort the active model

To use the jquery-plugin give the table header elements the attribute data-sort="COLUMNAME" and call the plugin $('.selector').dynamicallySortable()

## Defaults
Set the defaultDir property on your model to define the default order direction (asc/desc)  
Set the defaultSort property to set the default sorting column 