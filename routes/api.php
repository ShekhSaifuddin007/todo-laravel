<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('todos', 'Api\TodoController');
Route::patch('check-all', 'Api\TodoController@updateAll');
Route::delete('delete-all-checked', 'Api\TodoController@deleteAll');

