<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;

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

// --------------------------------------------------------------------------------------


// log index page ---
Route::get('/', [LogController::class, 'viewLogs'])->name('log');

// log insert ---
Route::post('/', [LogController::class, 'insertLog'])->name('insertLog');

// edit page  and update routes -----------
Route::get('/edit/{log}', [LogController::class, 'editLog'])->name('editLog');
Route::put('/update/{log}', [LogController::class, 'updatelog'])->name('updatelog');

// trash and restore routes ------------------------
Route::delete('/trash/{log}', [LogController::class, 'trashLog'])->name('trashLog');
Route::get('/restore/{log}', [LogController::class, 'restoreLog'])->name('restoreLog');


// export to excel -----------------------
Route::get('/import', [LogController::class, 'importLog'])->name('importLog');
