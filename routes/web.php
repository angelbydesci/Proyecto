<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ValorController; // Añadir esta línea
use App\Http\Controllers\ObjetivoController; // Añadir esta línea
use App\Http\Controllers\CadenaDeValorController;
use App\Http\Controllers\FODAController;
use App\Http\Controllers\AutodiagnosticoBCGController;
use App\Http\Controllers\PorterController; // Añadir esta línea
use App\Http\Controllers\PestController; // Añadir esta línea
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

    // Rutas para Valores anidadas bajo un proyecto
    Route::get('/proyectos/{proyecto}/valores', [ValorController::class, 'index'])->name('proyectos.valores.index');
    Route::post('/proyectos/{proyecto}/valores', [ValorController::class, 'store'])->name('proyectos.valores.store');
    Route::delete('/valores/{valor}', [ValorController::class, 'destroy'])->name('valores.destroy'); // Ruta para eliminar un valor

    // Rutas para Objetivos (si también son específicos del proyecto)
    Route::get('/proyectos/{proyecto}/objetivos', [ProyectoController::class, 'showObjetivos'])->name('proyectos.showObjetivos');
    // Rutas para almacenar Objetivos Principales y Específicos
    Route::post('/proyectos/{proyecto}/objetivos-principales', [ObjetivoController::class, 'storePrincipal'])->name('objetivos.storePrincipal');
    Route::post('/objetivos-principales/{objetivoPrincipal}/objetivos-especificos', [ObjetivoController::class, 'storeEspecifico'])->name('objetivos.storeEspecifico');

    // Rutas nombradas que faltan para las secciones del dashboard2
    Route::get('/proyectos/{proyecto}/cadena-de-valor', [ProyectoController::class, 'showCadenaDeValor'])->name('proyectos.showCadenaDeValor');
    Route::get('/proyectos/{proyecto}/matriz-participacion', [ProyectoController::class, 'showMatrizParticipacion'])->name('proyectos.showMatrizParticipacion');
    Route::get('/proyectos/{proyecto}/autodiagnostico-bcg', [ProyectoController::class, 'showAutodiagnosticoBCG'])->name('proyectos.showAutodiagnosticoBCG');
    Route::get('/proyectos/{proyecto}/las-5-fuerzas', [ProyectoController::class, 'showLas5Fuerzas'])->name('proyectos.showLas5Fuerzas');
    Route::get('/proyectos/{proyecto}/autodiagnostico-porter', [PorterController::class, 'showAutodiagnosticoPorter'])->name('proyectos.showAutodiagnosticoPorter'); // Corregido: Usar PorterController
    Route::post('/proyectos/{proyecto}/autodiagnostico-porter', [PorterController::class, 'store'])->name('autodiagnostico_porter.store'); // Nueva ruta para guardar
    Route::get('/proyectos/{proyecto}/pest', [ProyectoController::class, 'showPest'])->name('proyectos.showPest');
    Route::post('/proyectos/{proyecto}/pest', [PestController::class, 'store'])->name('pest.store'); // Nueva ruta para guardar PEST
    Route::get('/proyectos/{proyecto}/estrategia', [ProyectoController::class, 'showEstrategia'])->name('proyectos.showEstrategia');
    Route::get('/proyectos/{proyecto}/matriz-came', [ProyectoController::class, 'showMatrizCame'])->name('proyectos.showMatrizCame');
    Route::get('/proyectos/{proyecto}/autodiagnostico-cadena-de-valor', [ProyectoController::class, 'showAutodiagnosticoCadenaDeValor'])->name('proyectos.showAutodiagnosticoCadenaDeValor');

    // Rutas para CadenaDeValorController
    Route::post('/proyectos/{proyecto}/autodiagnostico-cadena-de-valor', [CadenaDeValorController::class, 'storeOrUpdate'])->name('cadenadevalor.storeOrUpdate');
    Route::resource('foda', FODAController::class)->except(['index', 'create', 'show', 'edit', 'update', 'destroy']); // Provisional, ajustar según necesidad
    Route::post('/foda/{proyecto}', [FODAController::class, 'store'])->name('foda.store');

    // Ruta para GUARDAR los datos del formulario BCG
    Route::post('/proyectos/{proyecto}/autodiagnostico-bcg/save', [AutodiagnosticoBCGController::class, 'saveBcgData'])->name('autodiagnostico.bcg.save');
});

// ========================================
// RUTAS DE PÁGINAS ESTÁTICAS (O SEMI-ESTÁTICAS)
// ========================================

// Estas rutas parecen ser genéricas o apuntar a un PageController.
// Si 'mision', 'vision', 'valores', 'objetivos' etc., deben ser específicas del proyecto,
// sus rutas deben definirse dentro del grupo de middleware de autenticación y usar ProyectoController o un controlador dedicado.

// Ejemplo de cómo podrían ser si fueran genéricas (revisar si es el caso o si deben ser específicas del proyecto)
// Route::get('/mision', [PageController::class, 'mision'])->name('mision');
// Route::get('/vision', [PageController::class, 'vision'])->name('vision');
// La ruta genérica para 'valores' se elimina para dar prioridad a la específica del proyecto.
// Route::get('/valores', [PageController::class, 'valores'])->name('valores'); 
// Route::get('/objetivos', [PageController::class, 'objetivos'])->name('objetivos');
// ... otras rutas de PageController ...

// ========================================
// RUTAS PARA PROYECTOS (MISIÓN, VISIÓN, UNIDADES ESTRATÉGICAS)
// ========================================
Route::middleware(['auth'])->group(function () {
    // Rutas para mostrar información
    Route::get('/proyectos/{proyecto}/mision', [ProyectoController::class, 'showMision'])->name('proyectos.showMision');
    Route::get('/proyectos/{proyecto}/vision', [ProyectoController::class, 'showVision'])->name('proyectos.showVision');
    Route::get('/proyectos/{proyecto}/unidades-estrategicas', [ProyectoController::class, 'showUnidadesEstrategicas'])->name('proyectos.showUnidadesEstrategicas');
    Route::get('/proyectos/{proyecto}/analisis-interno', [ProyectoController::class, 'showAnalisisInterno'])->name('proyectos.showAnalisisInterno');

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

// Rutas para objetivos principales
Route::put('/objetivos/principal/{objetivoPrincipal}', [ObjetivoController::class, 'updatePrincipal'])->name('objetivos.updatePrincipal');
Route::delete('/objetivos/principal/{objetivoPrincipal}', [ObjetivoController::class, 'destroyPrincipal'])->name('objetivos.destroyPrincipal');

// Rutas para objetivos específicos
Route::put('/objetivos/especifico/{objetivoEspecifico}', [ObjetivoController::class, 'updateEspecifico'])->name('objetivos.updateEspecifico');
Route::delete('/objetivos/especifico/{objetivoEspecifico}', [ObjetivoController::class, 'destroyEspecifico'])->name('objetivos.destroyEspecifico');