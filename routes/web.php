<?php

use App\Http\Controllers\Auth\PerfilController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\PedidoController;
use App\Models\Mascota;

Route::get('/', [WebController::class, 'index'])->name('web.index');
Route::get('/producto/{id}', [WebController::class, 'show'])->name('web.show');

Route::get('/carrito', [CarritoController::class, 'show_items'])->name('carrito.mostrar');
Route::post('/carrito/agregar', [CarritoController::class, 'add'])->name('carrito.agregar');
Route::get('/carrito/sumar', [CarritoController::class, 'sum'])->name('carrito.sumar');
Route::get('/carrito/restar', [CarritoController::class, 'rest'])->name('carrito.restar');
Route::get('/carrito/eliminar/{id}', [CarritoController::class, 'delete'])->name('carrito.eliminar');
Route::get('/carrito/vaciar', [CarritoController::class, 'empty_car'])->name('carrito.vaciar');


Route::middleware(['auth'])->group(function () {

    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('usuarios', UserController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('mascotas', MascotasController::class);

    //Route::get('mascotas/{user}/enviar-historial', [MascotasController::class, 'send_historial'])->name('mascotas.send_historial_clinico');

    Route::get('mascotas/pdf/ver/{id}', [MascotasController::class, 'verEnLinea'])->name('pdf.ver');
    Route::get('mascotas/{user}/pdf/enviar', [MascotasController::class, 'send_historial'])->name('mascotas.send_historial_clinico');

    Route::post('/pedido/realizar', [PedidoController::class, 'realizar'])->name('pedido.realizar');
    Route::get('/perfil/pedidos', [PedidoController::class, 'index'])->name('perfil.pedidos');
    Route::patch('/pedidos/{id}/estado', [PedidoController::class, 'changeState'])->name('pedidos.changeStateSend');



    Route::resource('roles', RoleController::class);

    Route::patch('usuarios/{usuario}/toggle', [UserController::class, 'toggleStatus'])->name('usuarios.toggle');

    Route::post('logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');

    Route::get('/perfil', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil', [PerfilController::class, 'update'])->name('perfil.update');
});

Route::middleware('guest')->group(function () {

    Route::get('login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);

    Route::post('login', [AuthController::class, 'login'])->name('login.post');

    Route::get('login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/registro', [RegisterController::class, 'showRegisterForm'])->name('registro');
    Route::post('/registro', [RegisterController::class, 'registrar'])->name('registro.store');

    Route::get('password/reset', [ResetPasswordController::class, 'showRequestForm'])->name('password.request');
    Route::post('password/email', [ResetPasswordController::class, 'sendResetLinkPass'])->name('password.send_link');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
});
