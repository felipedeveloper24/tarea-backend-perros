<?php

use App\Http\Controllers\InteraccionController;
use App\Http\Controllers\PerroController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("/perros")->controller(PerroController::class)->group(function(){
    Route::get("/all","ShowAll");//Muestra todos los perros que están registrados
    Route::post("/create","store");//Crea un perro
    Route::put("/update","update");//Actualiza un perro
    Route::delete("/delete","delete");//Elimina un perro
});

Route::prefix("/interacciones")->controller(InteraccionController::class) -> group(function(){
    Route::get("/show","showInteraccion"); //Muestra las interacciones de un perro con un id como request
    Route::post("/create","store");//Crea una interaccion entre perros
});
