<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// resource recibe nos parámetros(URI del recurso, Controlador que gestionará las peticiones)
Route::apiResource('t_calificaciones','TCalificacionController');	// Todos los métodos menos Edit que mostraría un formulario de edición.
