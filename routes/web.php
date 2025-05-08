<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProyectoController;
use Illuminate\Support\Facades\Route;

// ========================================
// RUTAS DE AUTENTICACIÓN
// ========================================

// Mostrar login en la raíz del sitio
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Login y logout
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// ========================================
// RUTAS DEL DASHBOARD
// ========================================

// Redirigir al dashboard después del login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProyectoController::class, 'index'])->name('dashboard');
    // Modificar la ruta de dashboard2 para aceptar un proyecto
    Route::get('/dashboard2/{proyecto}', [ProyectoController::class, 'showDashboard2'])->name('dashboard2');
    // Ruta para almacenar un nuevo proyecto
    Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
});

// ========================================
// RUTAS DE PÁGINAS ESTÁTICAS
// ========================================

// Páginas de misión, visión y valores
Route::get('/mision', [PageController::class, 'mision'])->name('mision');
Route::get('/vision', [PageController::class, 'vision'])->name('vision');
Route::get('/valores', [PageController::class, 'valores'])->name('valores');

// Páginas de análisis y estrategias
Route::get('/analisis-interno', [PageController::class, 'analisis_interno'])->name('analisis_interno');
Route::get('/objetivos', [PageController::class, 'objetivos'])->name('objetivos');
Route::get('/cadena-de-valor', function () {
    return view('cadena_de_valor');
})->name('cadena_de_valor');
Route::get('/matriz-participacion', function () {
    return view('matriz_participacion');
})->name('matriz_participacion');
Route::get('/matriz-came', function () {
    return view('matriz_came');
})->name('matriz_came');
Route::get('/pest', function () {
    return view('pest');
})->name('pest');
Route::get('/estrategia', function () {
    return view('estrategia');
})->name('estrategia');
Route::get('/las-5-fuerzas', function () {
    return view('las_5_fuerzas');
})->name('las_5_fuerzas');

// ========================================
// RUTAS DE PERFIL DE USUARIO
// ========================================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========================================
// RUTAS PARA PROYECTOS (MISIÓN, VISIÓN, UNIDADES ESTRATÉGICAS)
// ========================================
Route::middleware(['auth'])->group(function () {
    // Rutas para mostrar información
    Route::get('/proyectos/{proyecto}/mision', [ProyectoController::class, 'showMision'])->name('proyectos.showMision');
    Route::get('/proyectos/{proyecto}/vision', [ProyectoController::class, 'showVision'])->name('proyectos.showVision');
    Route::get('/proyectos/{proyecto}/unidades-estrategicas', [ProyectoController::class, 'showUnidadesEstrategicas'])->name('proyectos.showUnidadesEstrategicas');

    // Rutas para actualizar información (usando PATCH o PUT)
    Route::patch('/proyectos/{proyecto}/mision', [ProyectoController::class, 'updateMision'])->name('proyectos.updateMision');
    Route::patch('/proyectos/{proyecto}/vision', [ProyectoController::class, 'updateVision'])->name('proyectos.updateVision');
    Route::patch('/proyectos/{proyecto}/unidades-estrategicas', [ProyectoController::class, 'updateUnidadesEstrategicas'])->name('proyectos.updateUnidadesEstrategicas');
});

// ========================================
// RUTAS ADICIONALES
// ========================================

// Redirigir cualquier intento de acceder a /home hacia /dashboard
Route::get('/home', function () {
    return redirect('/dashboard');
})->name('home');

// ========================================
// RUTAS GENERADAS AUTOMÁTICAMENTE
// ========================================

require __DIR__.'/auth.php';