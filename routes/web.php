<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Redirecionamento Inicial
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Rotas de Autenticação (Login e Logout)
Route::get('/login', function () {
    return view('welcome');
})->name('login');

Route::post('/login/auth', [ListController::class, 'login'])->name('login.auth');

// Esta é a rota que estava faltando o nome correto!
Route::post('/logout', [ListController::class, 'logout'])->name('logout');

// 3. Rotas Protegidas (Home e Status)
Route::get('/home', [ListController::class, 'index'])->name('home');

// Rota de Status corrigida para usar o método indexStatus do Controller
Route::get('/status', [ListController::class, 'indexStatus'])->name('status.index');

// 4. Manipulação de Tarefas
Route::post('/tarefa/adicionar', [ListController::class, 'store'])->name('tarefa.store');

Route::delete('/tarefa/{id}', [ListController::class, 'destroy'])->name('tarefa.destroy');