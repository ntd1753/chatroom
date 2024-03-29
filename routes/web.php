<?php

use App\Http\Controllers\RoomController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'chat-room'], function () {
    Route::get('/', [RoomController::class, 'index'])->name('room.index');
    Route::post('/create-room', [RoomController::class, 'storeRoom'])->name('room.store');
    Route::post('/search/', [RoomController::class, 'search'])->name('room.search');
    Route::post('/sendmess', [RoomController::class, 'sendMess'])->name('sendmess');
    Route::post('/join', [RoomController::class, 'join'])->name('room.join');
});

Route::get('/info',[RoomController::class, 'roomInfo'])->name('room.info');
Route::get('chat-room/room/{id}',[RoomController::class,"showRoom"]);





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
