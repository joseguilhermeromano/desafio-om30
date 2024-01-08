<?php

use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\EnderecoController;
use Illuminate\Support\Facades\Route;

Route::get('/pacientes', [PacienteController::class, 'index']);
Route::post('/paciente', [PacienteController::class, 'store']);
Route::get('/cep/{cep}', [EnderecoController::class, 'index']);

Route::get('/', function () {
    return response()->json([
        'success' => true
    ]);
});
