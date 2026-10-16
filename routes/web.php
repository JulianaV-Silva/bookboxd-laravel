<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LivroController;
use App\Models\Livro;


// PÁGINA INICIAL

// Exibe a página inicial com os 6 livros mais recentes
Route::get('/', function () {
    $livros = Livro::latest()->take(6)->get();

    return view('welcome', compact('livros'));
});

// AUTENTICAÇÃO

// Exibe o formulário de login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Processa o login
Route::post('/login', [AuthController::class, 'login']);

// Exibe o formulário de cadastro
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Processa o cadastro do usuário
Route::post('/register', [AuthController::class, 'register']);

// Realiza o logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// LIVROS

// Lista todos os livros cadastrados
Route::get('/livros', [LivroController::class, 'index'])->name('livros.index');

// Exibe o formulário para cadastrar um novo livro
// Necessário estar autenticado
Route::get('/livros/create', [LivroController::class, 'create'])->middleware('auth')->name('livros.create');

// Salva um novo livro no banco
Route::post('/livros', [LivroController::class, 'store'])->middleware('auth')->name('livros.store');

// Exibe o formulário de edição de um livro
Route::get('/livros/{id}/edit', [LivroController::class, 'edit'])->middleware('auth')->name('livros.edit');

// Atualiza os dados de um livro
Route::put('/livros/{id}', [LivroController::class, 'update'])->middleware('auth')->name('livros.update');

// Exclui um livro
Route::delete('/livros/{id}', [LivroController::class, 'destroy'])->middleware('auth')->name('livros.destroy');

// LIVROS DO USUÁRIO
// Exibe apenas os livros cadastrados pelo usuário logado
Route::get('/meus-livros', [LivroController::class, 'meusLivros'])->middleware('auth')->name('livros.meus-livros');

// DETALHES DO LIVRO

// Exibe todas as informações de um livro específico
Route::get('/livros/{id}', [LivroController::class, 'show'])->name('livros.show');