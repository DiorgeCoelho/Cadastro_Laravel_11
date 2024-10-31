<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('produto', [ProdutoController::class, 'index'])->name('prod');
Route::get('produtoEdit/{id}', [ProdutoController::class, 'edit']);
Route::get('produtoShow/{id}', [ProdutoController::class, 'show']);
Route::get('produtoDelete/{id}', [ProdutoController::class, 'deleteProduto']);

Route::post('produtoC', [ProdutoController::class, 'cadastro'])->name('cadastro');
Route::post('produtoUpdate', [ProdutoController::class, 'update'])->name('update');

Route::get('/gerar-pdf', [ProdutoController::class, 'gerarPdf'])->name('gerar.pdf');
Route::get('/visualizar', [ProdutoController::class, 'visualizar'])->name('conta.gera-pdf');

Route::get('/gerar-pdf-conta', [ProdutoController::class, 'ReProdutos'])->name('conta.gerar-pdf');




