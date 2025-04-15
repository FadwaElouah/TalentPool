<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecruteurController;
use App\Http\Controllers\CandidatController;
use Laravel\Fortify\Features;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/recruteur/dashboard', [RecruteurController::class, 'dashboard'])->middleware(['auth', 'role:recruteur']);
Route::get('/candidat/dashboard', [CandidatController::class, 'dashboard'])->middleware(['auth', 'role:candidat']);


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// ==========

// routes/web.php
use App\Http\Controllers\OfferPostController;

Route::middleware(['auth', 'isRecruiter'])->group(function () {
    Route::get('/offers/create', [OfferPostController::class, 'create'])->name('offers.create');
    Route::post('/offers', [OfferPostController::class, 'store'])->name('offers.store');
});


require __DIR__.'/auth.php';
