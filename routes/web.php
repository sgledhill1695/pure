<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DogController::class, 'index']);

Route::get('/create', [DogController::class, 'create']);

Route::get('create/recipes', [DogController::class, 'recipes']);

Route::post('/', [DogController::class, 'store']);

