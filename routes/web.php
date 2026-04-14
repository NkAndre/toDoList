<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;

// 1. ROTAS ABERTAS (Quem não está logado vê isso)
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('welcome'); // Sua view de login
})->name('login');


Route::get('/dashboard', [ListController::class, 'dashboard'])->name('dashboard');



Route::post('/login/auth', [ListController::class, 'login'])->name('login.auth');


// 2. ROTAS PROTEGIDAS (Middleware impede o acesso pela URL se não estiver logado)
Route::middleware(['auth'])->group(function () {
    
    Route::post('/logout', [ListController::class, 'logout'])->name('logout');
    
    Route::get('/home', [ListController::class, 'index'])->name('home');
    Route::get('/status', [ListController::class, 'indexStatus'])->name('status.index');

    // CRUD de Tarefas (Protegidas)
    Route::post('/tarefa/adicionar', [ListController::class, 'store'])->name('tarefa.store');
    Route::delete('/tarefa/{id}', [ListController::class, 'destroy'])->name('tarefa.destroy');
    Route::put('/tarefa/{id}', [ListController::class, 'update'])->name('tarefa.update');
});