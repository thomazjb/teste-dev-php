<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FornecedorController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('fornecedores', FornecedorController::class);
Route::get('fornecedores/buscar/{cnpj}', [FornecedorController::class, 'buscarCnpj']);
