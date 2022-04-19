<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\AnimalKindController;
use \App\Http\Controllers\Api\AnimalController;

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

Route::get('/animal_kinds', [AnimalKindController::class, 'index']);

Route::get('/animals', [AnimalController::class, 'index']);
Route::post('/animals', [AnimalController::class, 'create']);

Route::post('/animals/age', [AnimalController::class, 'age']);
Route::get('/animals/{name}', [AnimalController::class, 'animalInfo']);
