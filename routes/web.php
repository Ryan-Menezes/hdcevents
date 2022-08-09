<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;

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

Route::get('/', [EventController::class, 'index'])->name('homepage');

Route::group(['prefix' => 'eventos'], function() {
    Route::get('/novo', [EventController::class, 'create'])->name('events.create')->middleware('auth');
    Route::post('/novo/salvar', [EventController::class, 'store'])->name('events.store')->middleware('auth');
    Route::get('/{id}', [EventController::class, 'show'])->name('events.show');
    Route::post('/{id}/participar', [EventController::class, 'join'])->name('events.join')->middleware('auth');
    Route::delete('/{id}/sair', [EventController::class, 'leave'])->name('events.leave')->middleware('auth');
    Route::get('/{id}/editar', [EventController::class, 'edit'])->name('events.edit')->middleware('auth');
    Route::put('/{id}/atualizar', [EventController::class, 'update'])->name('events.update')->middleware('auth');
    Route::delete('/{id}/deletar', [EventController::class, 'destroy'])->name('events.delete')->middleware('auth');
});

Route::get('/dashboard', [EventController::class, 'dashboard'])->name('dashboard')->middleware('auth');
