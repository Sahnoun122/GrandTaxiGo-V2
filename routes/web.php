<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\DisponibiliteController;
use App\Http\Controllers\PassagerController;
use App\Http\Controllers\TrajetController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\PaymentsController;

use App\Http\Controllers\CommentsController;
// $_SESSION['user_id'] = 2;



Route::get('/chauffeur/index', [ChauffeurController::class, 'index'])->name('chauffeur.index');

Route::get('/chauffeur/trajet', [TrajetController::class, 'trajet'])->name('chauffeur.trajet');

Route::get('/admin/dashboardAdmin' , [AdminController::class , 'index'])->name('admin.dashboardAdmin');

Route::get('/admin/admintrj' , [AdminController::class , 'trajets'])->name('admin.admintrj');

Route::get('/admin/adminds' , [AdminController::class , 'dispo'])->name('admin.adminds');


// // Route::get('/admin/dashboardAdmin' , [AdminController::class , 'edit'])->name('admin.dashboardAdmin');
// // Route::get('/admin/dashboardAdmin' , [AdminController::class , 'updat'])->name('admin.dashboardAdmin');
// // Route::get('/admin/dashboardAdmin' , [AdminController::class , 'destroy'])->name('admin.dashboardAdmin');



// // Route::resource('admin.dashboardAdmin' , AdminController::class );

// // Route::POST('chauffeur.index' , [DisponibiliteController::class , 'index']);
// // Route::POST('chauffeur.show' , [DisponibiliteController::class , 'index']);
// // Route::POST('chauffeur.details' , [DisponibiliteController::class , 'index']);


Route::delete('/passager/destroy/{id}', [CommentsController::class, 'destroy'])->name('passager.destroy');

Route::get('/details/{id}', [PassagerController::class, 'details'])->name('passager.details');

Route::post('/ajouterComment/{id}', [CommentsController::class , 'ajouterComment'])->name('passager.ajouterComment');

Route::get('passager', [DisponibiliteController::class, 'index'])->name('passager.index');

Route::resource('chauffeur', DisponibiliteController::class); 

Route::get('chauffeur', [DisponibiliteController::class, 'index'])->name('chauffeur.index');


// // Route::get('/chauffeur/trajet', [TrajetController::class, 'trajet'])->name('chauffeur.trajet');

Route::get('/passager/trajets', [TrajetController::class, 'trajets'])->name('passager.trajets');



// // Route::get('/passager/index', [PassagerController::class, 'index'])->name('passager.index');

// // Route::post('/passager', [TrajetController::class, 'store'])->name('passager.store');

Route::get('/passager/dashboard', [PassagerController::class, 'dashboard'])->name('passager.dashboard');

Route::post('/passager/dashboard', [TrajetController::class, 'store'])->name('passager.store');


Route::post('/trajets/{id}/annule', [TrajetController::class, 'annule'])->name('trajets.annule');

Route::post('/trajet/{id}/accept', [TrajetController::class, 'accept'])->name('trajet.accept');
Route::post('/trajet/{id}/refuse', [TrajetController::class, 'refuse'])->name('trajet.refuse');



// // Route::get('/passager/dashboard', [PassagerController::class, 'index'])
// //     ->middleware(['auth', 'role:passager'])
// //     ->name('passager.dashboard');


// // Route::get('/chauffeur/index', [ChauffeurController::class, 'index'])
// //     ->middleware(['auth', 'role:chauffeur'])
// //     ->name('chauffeur.index');
// // Route::get('/', function () {
// //     return view('welcome');
// // });


// Route::middleware('auth')->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboardAdmin');
//     Route::get('/chauffeur', [ChauffeurController::class, 'index'])->name('chauffeur.index');
//     Route::get('/passager/dashboard', [PassagerController::class, 'dashboard'])->name('passager.dashboard');
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});



Route::get('/auth/google', [SocialController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

Route::get('/auth/facebook', [SocialController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [SocialController::class, 'handleFacebookCallback']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); 


// // Socialite
Route::controller(SocialController::class)->group(function(){
    Route::get('auth/google','googleLogin')->name('auth.google');
    Route::get('auth/google-callback','googleAuthentication')->name('auth.google-callback');
});


Route::get('/passager/payment', [PaymentsController::class, 'index'])->name('passager.index');
Route::post('/passager/payment', [PaymentsController::class, 'charge'])->name('passager.charge');


require __DIR__.'/auth.php';

