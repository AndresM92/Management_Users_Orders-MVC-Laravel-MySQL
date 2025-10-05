<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('usuarios', UserController::class);

    Route::resource('roles', RoleController::class);

    Route::patch('usuarios/{usuario}/toggle', [UserController::class, 'toggleStatus'])->name('usuarios.toggle');

    Route::post('logout',function(){
        Auth::logout();
        return redirect('/login');
    })->name('logout');


});

Route::middleware('guest')->group(function () {

    Route::post('login', [AuthController::class, 'login'])->name('login.post');

    Route::get('login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/registro',[RegisterController::class,'showRegisterForm'])->name('registro');
    Route::post('/registro',[RegisterController::class,'registrar'])->name('registro.store');  
      
});
