<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NoteController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Página principal de bienvenida
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Autenticación de usuarios
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Rutas para usuarios no autenticados (invitados)
Route::middleware('guest')->group(function () {
    // Rutas para iniciar sesión
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Rutas para registrar usuarios
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

// Rutas protegidas para usuarios autenticados
Route::middleware('auth')->group(function () {
    // Rutas para gestionar notas
    Route::get('/notes', [NoteController::class, 'index']);      // Listar notas
    Route::post('/notes', [NoteController::class, 'store']);     // Crear nueva nota
    Route::get('/notes/{note}', [NoteController::class, 'show']); // Mostrar nota específica
    Route::put('/notes/{note}', [NoteController::class, 'update']); // Actualizar nota
    Route::delete('/notes/{note}', [NoteController::class, 'destroy']); // Eliminar nota

    // Ruta para cerrar sesión
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
