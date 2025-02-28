<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\DisponibiliteController;
use App\Http\Controllers\PassagerController;
use App\Http\Controllers\TrajetController;



// $_SESSION['user_id'] = 2;


Route::get('/chauffeur/index', [ChauffeurController::class, 'index'])->name('chauffeur.index');

Route::get('/chauffeur/trajet', [TrajetController::class, 'trajet'])->name('chauffeur.trajet');


// Route::POST('chauffeur.index' , [DisponibiliteController::class , 'index']);
// Route::POST('chauffeur.show' , [DisponibiliteController::class , 'index']);
// Route::POST('chauffeur.details' , [DisponibiliteController::class , 'index']);

Route::get('passager', [DisponibiliteController::class, 'index'])->name('passager.index');

Route::resource('chauffeur', DisponibiliteController::class); 

Route::get('chauffeur', [DisponibiliteController::class, 'index'])->name('chauffeur.index');


// Route::get('/chauffeur/trajet', [TrajetController::class, 'trajet'])->name('chauffeur.trajet');

Route::get('/passager/trajets', [TrajetController::class, 'trajets'])->name('passager.trajets');



// Route::get('/passager/index', [PassagerController::class, 'index'])->name('passager.index');

// Route::post('/passager', [TrajetController::class, 'store'])->name('passager.store');

Route::get('/passager/dashboard', [PassagerController::class, 'dashboard'])->name('passager.dashboard');

Route::post('/passager/dashboard', [TrajetController::class, 'store'])->name('passager.store');


Route::post('/trajets/{id}/annule', [TrajetController::class, 'annule'])->name('trajets.annule');

Route::post('/trajet/{id}/accept', [TrajetController::class, 'accept'])->name('trajet.accept');
Route::post('/trajet/{id}/refuse', [TrajetController::class, 'refuse'])->name('trajet.refuse');

// Route::get('/passager/dashboard', [PassagerController::class, 'index'])
//     ->middleware(['auth', 'role:passager'])
//     ->name('passager.index');

// Route::get('/chauffeur/dashboard', [ChauffeurController::class, 'index'])
//     ->middleware(['auth', 'role:chauffeur'])
//     ->name('chauffeur.index');
// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
