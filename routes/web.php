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


Route::post('/logout', [ListController::class, 'logout'])->name('logout');

Route::get('/home', [ListController::class, 'index'])->name('home');


Route::get('/status', [ListController::class, 'indexStatus'])->name('status.index');


Route::post('/tarefa/adicionar', [ListController::class, 'store'])->name('tarefa.store');

Route::delete('/tarefa/{id}', [ListController::class, 'destroy'])->name('tarefa.destroy');