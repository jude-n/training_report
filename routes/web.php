<?php

use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [TrainingController::class, 'index'])->name('training.home');
Route::post('/upload', [TrainingController::class, 'upload'])->name('training.upload');
Route::get('/training/display', [TrainingController::class, 'display'])->name('training.display');

