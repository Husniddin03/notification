<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/', [FileController::class, 'index']);

Route::resource('files', FileController::class);
Route::post('/files/check', [FileController::class, 'check'])->name('files.check');
Route::get('/files/result', [FileController::class, 'result'])->name('files.result');
