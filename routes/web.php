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
//Route::view('/excursions', 'excursions')->name('excursions')->middleware('auth'); // SI AFEGIM EL METODE ->middleware('auth') nomes podrem accedir a aquestes rutes si estem autenificats


// PELS CONTROLADORS RESOURCES

Route::get('/infant', [InfantController::class,'index'])->name('infants.index');

Route::get('/search/infant', [InfantController::class,'infants'])->name('infants.search');

Route::get('/infant/crear', [InfantController::class,'create'])->name('infants.create');

Route::get('/infant/{persona}/editar', [InfantController::class,'edit'])->name('infants.edit');
Route::patch('/infant/{persona}', [InfantController::class,'update'])->name('infants.update'); // Per actualitzar un formulari

Route::post('/infant', [InfantController::class,'store'])->name('infants.store');
Route::get('/infant/{persona}', [InfantController::class,'show'])->name('infants.show'); // MOLT IMPORTANT QUE AQUESTA RUTA SEMPRE SIGUI LA ULTIMA

Route::delete('/infant/{persona}', [InfantController::class,'destroy'])->name('infants.destroy');


//Route::get('/tutor', [TutorController::class,'index'])->name('tutors.index');
Route::post('/tutor/existeix', [TutorController::class,'existeix'])->name('tutors.existeix');

Route::get('/tutor/contrasenya', [TutorController::class,'canviar'])->name('tutors.change');
Route::post('/tutor/contrasenya', [TutorController::class,'canviarContrasenya'])->name('tutors.changePassword');

Route::get('/tutor/{persona}/crear', [TutorController::class,'create'])->name('tutors.create'); // Route::get('/tutor/{persona}/crear', [TutorController::class,'create'])->name('tutors.create');

Route::get('/tutor/{persona}/editar', [TutorController::class,'edit'])->name('tutors.edit');
Route::patch('/tutor/{persona}', [TutorController::class,'update'])->name('tutors.update'); // Per actualitzar un formulari

Route::post('/tutor/{persona}', [TutorController::class,'store'])->name('tutors.store');  //Route::post('/tutor', [TutorController::class,'store'])->name('tutors.store');
Route::get('/tutor/{persona}', [TutorController::class,'show'])->name('tutors.show'); // MOLT IMPORTANT QUE AQUESTA RUTA SEMPRE SIGUI LA ULTIMA

Route::delete('/tutor/{persona}', [TutorController::class,'destroy'])->name('tutors.destroy');



Route::get('/excursions', [ExcursioController::class,'index'])->name('excursions.index');

Route::get('/search/excursio', [ExcursioController::class,'excursions'])->name('excursions.search');

Route::get('/excursions/crear', [ExcursioController::class,'create'])->name('excursions.create'); // Route::get('/tutor/{persona}/crear', [TutorController::class,'create'])->name('tutors.create');

Route::get('/excursions/{excursio}/editar', [ExcursioController::class,'edit'])->name('excursions.edit');
Route::patch('/excursions/{excursio}', [ExcursioController::class,'update'])->name('excursions.update'); // Per actualitzar un formulari



Route::post('/excursions', [ExcursioController::class,'store'])->name('excursions.store');  //Route::post('/tutor', [TutorController::class,'store'])->name('tutors.store');
Route::get('/excursions/{excursio}', [ExcursioController::class,'show'])->name('excursions.show'); // MOLT IMPORTANT QUE AQUESTA RUTA SEMPRE SIGUI LA ULTIMA

Route::delete('/excursions/{excursio}', [ExcursioController::class,'destroy'])->name('excursions.destroy');

Route::get('/search/inscripcio', [InscripcioController::class,'infants'])->name('inscripcions.search');

Route::get('/inscripcions/{excursio}/crear', [InscripcioController::class,'create'])->name('inscripcions.create');
Route::post('/inscripcions/{excursio}/crear', [InscripcioController::class,'store'])->name('inscripcions.store');

Route::get('/inscripcions/{excursio}', [InscripcioController::class,'index'])->name('inscripcions.index');



// AQUESTES 7 RUTES ES PODEN SIMPLIFICAR AMB

//Route::resource('infant', InfantController::class)->parameters(['portafolio' => 'project'])->names('projects')->middleware('auth'); // SI AFEGIM EL METODE ->middleware('auth') nomes podrem accedir a aquestes rutes si estem autenificats

Route::get('/404', function () { // PELS ERRORS?
    return abort(404);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
