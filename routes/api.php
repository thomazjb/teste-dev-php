<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FornecedorController;

Route::apiResource('fornecedores', FornecedorController::class)->middleware('auth.basic');
Route::get('fornecedores/buscar/{cnpj}', [FornecedorController::class, 'buscarCnpj'])->middleware('auth.basic');

require __DIR__.'/auth.php';