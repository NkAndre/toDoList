<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\listController;
use App\Http\Controllers\Api\CadastroController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//rota de API no metodo Get
Route::get('/tarefas', [ListController::class, 'indexApi']);

//rota de API no metodo POST
Route::post('/tarefas', [ListController::class, 'storeApi']);

//rota de API no metodo put
Route::put('/tarefas/{id}', [ListController::class, 'updateApi']);

//rota de API no metodo delete
Route::delete('/tarefas/{id}', [ListController::class, 'destroyApi']);


