<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::group([
    'prefix' => 'admin',
    'middleware' => [ 'auth','admin'],
],function(){
    Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
});

Route::group([
    'prefix' => 'agent',
    'middleware' => [ 'auth','agent'],
],function(){
    Route::get('dashboard',[AgentController::class,'index'])->name('agent.dashboard');
});
Route::group([
    'prefix' => 'user',
    'middleware' => [ 'auth','user'],
],function(){
    Route::get('dashboard',[UserController::class,'index'])->name('user.dashboard');
});
