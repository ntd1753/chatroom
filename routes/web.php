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
    return view('auth.login');
});
Route::get('/auth/google', [\App\Http\Controllers\Auth\LoginController::class,'redirectToProvider']);
Route::get('/auth/google/callback', [\App\Http\Controllers\Auth\LoginController::class,'handleProviderCallback']);

Auth::routes();

Route::get('/home', [RoomController::class, 'index'])->name('room.index');

Route::group(['prefix' => 'chat-room'], function () {
    Route::get('/notify',[RoomController::class,'getMessageNontify'])->name('room.messageNotify');
    Route::post('/create-room', [RoomController::class, 'storeRoom'])->name('room.store');
    Route::post('/search/', [RoomController::class, 'search'])->name('room.search');
    Route::post('/sendmess', [\App\Http\Controllers\chatCotroller::class, 'sendMess'])->name('sendmess');
    Route::post('/join', [RoomController::class, 'join'])->name('room.join');
    Route::get('/room/{id}',[\App\Http\Controllers\chatCotroller::class,"showRoom"])->name('room.show');
    Route::post('/upload-image', [\App\Http\Controllers\chatCotroller::class, 'uploadImage'])->name('room.uploadImage');
});
Route::get('/dashboard',[\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard/approve-user',[\App\Http\Controllers\DashboardController::class, 'approveUser'])->name('approveUser');
Route::get('/info',[RoomController::class, 'roomInfo'])->name('room.info');

