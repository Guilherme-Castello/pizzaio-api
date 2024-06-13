<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
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
$endpoint = '/pizzas';

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Creates a pizza
Route::post($endpoint, [PizzaController::class, 'create_pizza']);

// Deletes a pizza
Route::delete($endpoint, [PizzaController::class,'delete_pizza']);

//Show a pizza by id
Route::get($endpoint.'/{id}', [PizzaController::class,'show_pizza_by_id']);

// Lists all pizzas
Route::get($endpoint, [PizzaController::class,'list_pizzas']);

// Updates a pizza
Route::put($endpoint.'/{id}', [PizzaController::class,'update_pizza']);


 