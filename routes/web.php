<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfantController;
use App\Http\Controllers\TutorController;

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
Route::view('/blog', 'blog')->name('blog');
Route::view('/excursions', 'excursions')->name('excursions')->middleware('auth'); // SI AFEGIM EL METODE ->middleware('auth') nomes podrem accedir a aquestes rutes si estem autenificats


// PELS CONTROLADORS RESOURCES

Route::get('/infant', [InfantController::class,'index'])->name('infants.index');

Route::get('/search/infant', [InfantController::class,'infants'])->name('infants.search');

Route::get('/infant/crear', [InfantController::class,'create'])->name('infants.create');

Route::get('/infant/{persona}/editar', [InfantController::class,'edit'])->name('infants.edit');
Route::patch('/infant/{persona}', [InfantController::class,'update'])->name('infants.update'); // Per actualitzar un formulari

Route::post('/infant', [InfantController::class,'store'])->name('infants.store');
Route::get('/infant/{persona}', [InfantController::class,'show'])->name('infants.show'); // MOLT IMPORTANT QUE AQUESTA RUTA SEMPRE SIGUI LA ULTIMA

Route::delete('/infant/{infant}', [InfantController::class,'destroy'])->name('infants.destroy');


Route::get('/tutor', [TutorController::class,'index'])->name('tutors.index');
Route::get('/tutor/crear', [TutorController::class,'create'])->name('tutors.create');

Route::get('/tutor/{persona}/editar', [TutorController::class,'edit'])->name('tutors.edit');
Route::patch('/tutor/{persona}', [TutorController::class,'update'])->name('tutors.update'); // Per actualitzar un formulari

Route::post('/tutor', [TutorController::class,'store'])->name('tutors.store');
Route::get('/tutor/{persona}', [TutorController::class,'show'])->name('tutors.show'); // MOLT IMPORTANT QUE AQUESTA RUTA SEMPRE SIGUI LA ULTIMA

Route::delete('/tutor/{infant}', [TutorController::class,'destroy'])->name('tutors.destroy');

// AQUESTES 7 RUTES ES PODEN SIMPLIFICAR AMB

//Route::resource('infant', InfantController::class)->parameters(['portafolio' => 'project'])->names('projects')->middleware('auth'); // SI AFEGIM EL METODE ->middleware('auth') nomes podrem accedir a aquestes rutes si estem autenificats



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
