<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('produto', [ProdutoController::class, 'index'])->name('prod');
Route::get('produtoEdit/{id}', [ProdutoController::class, 'edit']);
Route::get('produtoShow/{id}', [ProdutoController::class, 'show']);
Route::delete('produtoDelete/{id}', [ProdutoController::class, 'deleteProduto']);

Route::post('produtoC', [ProdutoController::class, 'cadastro'])->name('cadastro');
Route::post('produtoUpdate', [ProdutoController::class, 'update'])->name('update');





