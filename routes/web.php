<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\InfantController;
use App\Http\Controllers\ExcursioController;
use App\Http\Controllers\InscripcioController;

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

Route::view('/', 'home')->name('home');
Route::post('home', [HomeController::class,'store'])->name('home.contact');

Route::view('/nosaltres', 'nosaltres')->name('nosaltres');

Route::get('/infant', [InfantController::class,'index'])->name('infants.index');

Route::get('/search/infant', [InfantController::class,'infants'])->name('infants.search');

Route::get('/infant/crear', [InfantController::class,'create'])->name('infants.create');

Route::get('/infant/{persona}/editar', [InfantController::class,'edit'])->name('infants.edit');
Route::patch('/infant/{persona}', [InfantController::class,'update'])->name('infants.update');

Route::post('/infant', [InfantController::class,'store'])->name('infants.store');
Route::get('/infant/{persona}', [InfantController::class,'show'])->name('infants.show');

Route::delete('/infant/{persona}', [InfantController::class,'destroy'])->name('infants.destroy');



Route::post('/tutor/existeix', [TutorController::class,'existeix'])->name('tutors.existeix');

Route::get('/tutor/contrasenya', [TutorController::class,'canviar'])->name('tutors.change');
Route::post('/tutor/contrasenya', [TutorController::class,'canviarContrasenya'])->name('tutors.changePassword');

Route::get('/tutor/{persona}/crear', [TutorController::class,'create'])->name('tutors.create');

Route::get('/tutor/{persona}/editar', [TutorController::class,'edit'])->name('tutors.edit');
Route::patch('/tutor/{persona}', [TutorController::class,'update'])->name('tutors.update');

Route::post('/tutor/{persona}', [TutorController::class,'store'])->name('tutors.store');
Route::get('/tutor/{persona}', [TutorController::class,'show'])->name('tutors.show'); 

Route::delete('/tutor/{persona}', [TutorController::class,'destroy'])->name('tutors.destroy');



Route::get('/excursions', [ExcursioController::class,'index'])->name('excursions.index');

Route::get('/search/excursio', [ExcursioController::class,'excursions'])->name('excursions.search');

Route::get('/excursions/crear', [ExcursioController::class,'create'])->name('excursions.create'); 

Route::get('/excursions/{excursio}/editar', [ExcursioController::class,'edit'])->name('excursions.edit');
Route::patch('/excursions/{excursio}', [ExcursioController::class,'update'])->name('excursions.update');

Route::post('/excursions', [ExcursioController::class,'store'])->name('excursions.store');
Route::get('/excursions/{excursio}', [ExcursioController::class,'show'])->name('excursions.show');

Route::delete('/excursions/{excursio}', [ExcursioController::class,'destroy'])->name('excursions.destroy');



Route::get('/search/inscripcio', [InscripcioController::class,'infants'])->name('inscripcions.search');

Route::get('/inscripcions/{excursio}/crear', [InscripcioController::class,'create'])->name('inscripcions.create');
Route::post('/inscripcions/{excursio}/crear', [InscripcioController::class,'store'])->name('inscripcions.store');

Route::get('/inscripcions/{excursio}', [InscripcioController::class,'index'])->name('inscripcions.index');



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
