<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// RUTAS PROTEGIDAS POR ROLES
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard específico por rol
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('role:developer|ceo|director_marca|director_creativo')->name('admin.dashboard');

    // Rutas para Developer (Acceso total)
    Route::prefix('developer')->middleware('role:developer')->group(function () {
        Route::get('/dashboard', function () {
            return view('developer.dashboard');
        })->name('developer.dashboard');
        
        Route::get('/users', function () {
            return view('developer.users.index');
        })->name('developer.users');
    });

    // Rutas para CEO
    Route::prefix('ceo')->middleware('role:ceo')->group(function () {
        Route::get('/dashboard', function () {
            return view('ceo.dashboard');
        })->name('ceo.dashboard');
        
        Route::get('/pagos', function () {
            return view('ceo.pagos.index');
        })->name('ceo.pagos');
        
        Route::get('/sueldos', function () {
            return view('ceo.sueldos.index');
        })->name('ceo.sueldos');
        
        Route::get('/empleados', function () {
            return view('ceo.empleados.index');
        })->name('ceo.empleados');
    });

    // Rutas para Director de Marca
    Route::prefix('director-marca')->middleware('role:director_marca')->group(function () {
        Route::get('/dashboard', function () {
            return view('director-marca.dashboard');
        })->name('director-marca.dashboard');
        
        Route::get('/briefs', function () {
            return view('director-marca.briefs.index');
        })->name('director-marca.briefs');
        
        Route::get('/cm', function () {
            return view('director-marca.cm.index');
        })->name('director-marca.cm');
        
        Route::get('/calendarios', function () {
            return view('director-marca.calendarios.index');
        })->name('director-marca.calendarios');
    });

    // Rutas para Director Creativo
    Route::prefix('director-creativo')->middleware('role:director_creativo')->group(function () {
        Route::get('/dashboard', function () {
            return view('director-creativo.dashboard');
        })->name('director-creativo.dashboard');
        
        Route::get('/designers', function () {
            return view('director-creativo.designers.index');
        })->name('director-creativo.designers');
        
        Route::get('/logos', function () {
            return view('director-creativo.logos.index');
        })->name('director-creativo.logos');
        
        Route::get('/artes', function () {
            return view('director-creativo.artes.index');
        })->name('director-creativo.artes');
    });

    // Rutas para CM
    Route::prefix('cm')->middleware('role:cm')->group(function () {
        Route::get('/dashboard', function () {
            return view('cm.dashboard');
        })->name('cm.dashboard');
        
        Route::get('/calendarios', function () {
            return view('cm.calendarios.index');
        })->name('cm.calendarios');
        
        Route::get('/tareas', function () {
            return view('cm.tareas.index');
        })->name('cm.tareas');
    });

    // Rutas para Diseñadores
    Route::prefix('designer')->middleware('role:designer')->group(function () {
        Route::get('/dashboard', function () {
            return view('designer.dashboard');
        })->name('designer.dashboard');
        
        Route::get('/tareas', function () {
            return view('designer.tareas.index');
        })->name('designer.tareas');
        
        Route::get('/logos', function () {
            return view('designer.logos.index');
        })->name('designer.logos');
        
        Route::get('/artes', function () {
            return view('designer.artes.index');
        })->name('designer.artes');
    });

    // Rutas para Clientes
    Route::prefix('cliente')->middleware('role:cliente')->group(function () {
        Route::get('/dashboard', function () {
            return view('cliente.dashboard');
        })->name('cliente.dashboard');
        
        Route::get('/mis-servicios', function () {
            return view('cliente.servicios.index');
        })->name('cliente.servicios');
        
        Route::get('/briefs', function () {
            return view('cliente.briefs.index');
        })->name('cliente.briefs');
        
        Route::get('/pagos', function () {
            return view('cliente.pagos.index');
        })->name('cliente.pagos');
    });
});

// Rutas de perfil (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';