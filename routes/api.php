<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\VendedorController;

Route::prefix('app')->middleware('jwt.auth')->group(function(){
    Route::apiResource('/vendas','App\Http\Controllers\VendaController');
    Route::apiResource('/vendedores','App\Http\Controllers\VendedorController');
    Route::post('me','App\Http\Controllers\AuthController@me');
    Route::post('refresh','App\Http\Controllers\AuthController@refresh');
    Route::post('logout','App\Http\Controllers\AuthController@logout');
});

Route::post('login','App\Http\Controllers\AuthController@login');



