<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Mostrar los todos los To Do
Route::get('todos', 'TodoController@index');

//Mostrar todo solo un To Do
Route::get('todo/{id}', 'TodoController@show');


//Crear todo
Route::post('todo', 'TodoController@store');

//Agregar imagen
Route::post('image/store', 'ImageController@store');

//Modificar todo
Route::put('todo', 'TodoController@store');

//Modificar estado
Route::put('todo/{id}', 'TodoController@update');

//Borrar Todo
Route::delete('todo/{id}', 'TodoController@destroy');
