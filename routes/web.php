<?php

use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\SeccionTrabajadores;
use App\Http\Livewire\SeccionPerros;
use App\Http\Livewire\SeccionEntBusqueda;
use App\Http\Livewire\SeccionEntDiarios;
use App\Http\Livewire\SeccionEntObediencia;
use App\Http\Livewire\Informes;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/trabajadores', 
SeccionTrabajadores::class)->name('trabajadores');

Route::middleware(['auth:sanctum', 'verified'])->get('/perros', 
SeccionPerros::class)->name('perros');

Route::middleware(['auth:sanctum', 'verified'])->get('/entrenamientos', function () {
    return view('entrenamientos');
})->name('entrenamientos');

Route::middleware(['auth:sanctum', 'verified'])->get('/entrenamientos/diarios', 
SeccionEntDiarios::class)->name('diarios');
Route::middleware(['auth:sanctum', 'verified'])->get('/entrenamientos/obediencia', 
SeccionEntObediencia::class)->name('obediencia');
Route::middleware(['auth:sanctum', 'verified'])->get('/entrenamientos/busqueda', 
SeccionEntBusqueda::class)->name('busqueda');

Route::middleware(['auth:sanctum', 'verified'])->get('/informes', 
Informes::class)->name('informes');

Route::middleware(['auth:sanctum', 'verified'])->get('/informePDF/{dateTo}/{dateFrom}/{guide}/{dog}', [PDFController::class, 'crearPDF'])->name('informePDF');

