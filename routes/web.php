<?php

declare(strict_types=1);

use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* Route for Registo */
Route::group(['middleware' => 'auth', 'verified'], function () {
    Route::get('/re_company', App\Livewire\Registro\ReCompany::class)
        ->name('re_company')->middleware(['rolemenu:re_company']);

    Route::get('/re_sucursal', App\Livewire\Registro\ReBranch::class)
        ->name('re_sucursal')->middleware(['rolemenu:re_sucursal']);

    Route::get('/re_department', App\Livewire\Registro\ReDepartment::class)
        ->name('re_department')->middleware(['rolemenu:re_department']);
});
/* Route for Personal */
Route::group(['middleware' => 'auth', 'verified'], function () {
    Route::get('/re_especialist', App\Livewire\Personal\ReEspecialista::class)
        ->name('re_especialist')->middleware(['rolemenu:re_especialist']);
});

/* Route for Gestión */
Route::group(['middleware' => 'auth', 'verified'], function () {
    Route::get('/re_obrasocial', App\Livewire\Gestion\ReObraSocail::class)
        ->name('re_obrasocial')->middleware(['rolemenu:re_obrasocial']);
});

/* Route for Configuración */
Route::group(['middleware' => 'auth', 'verified'], function () {
    Route::get('/re_confrole', App\Livewire\Configuracion\ReRoles::class)
        ->name('re_confrole')->middleware(['rolemenu:re_confrole']);
    Route::get('/re_confper', App\Livewire\Configuracion\ReActions::class)
        ->name('re_confper')->middleware(['rolemenu:re_confper']);
    Route::get('/re_acceso', App\Livewire\Configuracion\ReAcceso::class)
        ->name('re_acceso')->middleware(['rolemenu:re_acceso']);
    Route::get('/re_horario', App\Livewire\Configuracion\ReHorario::class)
        ->name('re_horario')->middleware(['rolemenu:re_horario']);

});
/* Route for Servicios */
Route::group(['middleware' => 'auth', 'verified'], function () {
    Route::get('/re_paciente', App\Livewire\Servicios\RePaciente::class)
        ->name('re_paciente')->middleware(['rolemenu:re_paciente']);

});
/* Route for Profiles */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
/**Pdf */
Route::get('/brancpdf/{id},{class}', [PDFController::class, 'pdfById'])
    ->name('brancpdf');
require __DIR__.'/auth.php';
