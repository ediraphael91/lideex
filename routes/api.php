<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí defines las rutas de tu API.
| Estas rutas son cargadas por el RouteServiceProvider y todas
| estarán bajo el prefijo "api" automáticamente.
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Rutas para la API de Cursos
Route::prefix('cursos')->group(function () {
    Route::get('/', [CursoController::class, 'index']);     // Listar todos los cursos
    Route::post('/', [CursoController::class, 'store']);    // Crear un curso
    Route::get('/{id}', [CursoController::class, 'show']);  // Mostrar curso específico
    Route::put('/{id}', [CursoController::class, 'update']); // Actualizar curso
    Route::delete('/{id}', [CursoController::class, 'destroy']); // Eliminar curso
});


