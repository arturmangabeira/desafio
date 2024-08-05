<?php

use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LivroController;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('livros.index');
});*/

Auth::routes();

//Route::get('/livros', [LivroController::class, 'index'])->name('livros.index');

Route::resource('livros', LivroController::class);
Route::get('/livros/gerarpdf/relatorio', [LivroController::class, 'gerarRelatorioPDF'])->name('livros.relatorio');

Route::resource('autors', AutorController::class);
Route::get('/autors/{autor}/validar', [AutorController::class, 'validarExclusaoAutor'])->name('autors.validar');

Route::resource('assuntos', AssuntoController::class);
Route::get('/assuntos/{assunto}/validar', [AssuntoController::class, 'validarExclusaoAssunto'])->name('assuntos.validar');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\LivroController::class, 'index'])->name('/');


