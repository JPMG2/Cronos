<?php

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
        ->name('re_company');

    Route::get('/re_sucursal', App\Livewire\Registro\ReBranch::class)
        ->name('re_sucursal');

    Route::get('/re_department', App\Livewire\Registro\ReDepartment::class)
        ->name('re_department');
});
/* Route for Personal */
Route::group(['middleware' => 'auth', 'verified'], function () {
    Route::get('/re_especialist', App\Livewire\Personal\ReEspecialista::class)
        ->name('re_especialist');
});

/* Route for Gestión */
Route::group(['middleware' => 'auth', 'verified'], function () {
    Route::get('/re_obrasocial', App\Livewire\Gestion\ReObraSocail::class)
        ->name('re_obrasocial');
});

/* Route for Configuración */
Route::group(['middleware' => 'auth', 'verified'], function () {
    Route::get('/re_confrole', App\Livewire\Configuracion\Roles::class)
        ->name('re_confrole');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
/**Pdf */
Route::get('/brancpdf/{id},{class}', [PDFController::class, 'pdfById'])
    ->name('brancpdf');
require __DIR__.'/auth.php';
