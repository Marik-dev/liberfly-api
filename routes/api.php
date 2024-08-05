<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegistroController;
use App\Http\Controllers\UserController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);


/**
 * diferente do Laravel 10, que preciso criar um middleware personalizado,
 * estou utilizando o middleware fornecido pela própria biblioteca jwt aqui.
 * A configuração é simples no arquivo bootstrap/app.php linha 19
 * 
 * além disso, importante lembrar de alterar o auth.php para 'api' e marcar o driver como jwt
 */
Route::middleware('jwt.auth')->group(function () {
    Route::get('registros', [RegistroController::class, 'index']);
    Route::get('registros/{id}', [RegistroController::class, 'show']);
});