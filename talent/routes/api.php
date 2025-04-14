<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OfferPostController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CandidatureController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });






// Route::group(['prefix' => 'auth'], function () {
//     Route::post('register', [AuthController::class, 'register']);
//     Route::post('login', [AuthController::class, 'login']);
//     Route::post('logout', [AuthController::class, 'logout']);
//     Route::post('refresh', [AuthController::class, 'refresh']);
//     Route::get('me', [AuthController::class, 'me']);
// });

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('jwt.verify');
    Route::post('refresh', [AuthController::class, 'refresh'])->middleware('jwt.verify');
    Route::get('me', [AuthController::class, 'me'])->middleware('jwt.verify');
});

// Offer Posts Routes
Route::apiResource('offer-posts', OfferPostController::class);
Route::get('recruiter/offer-posts', [OfferPostController::class, 'recruiterOffers'])->middleware(['auth:api', 'recruiter']);
// Route::apiResource('offer-posts', OfferPostController::class)
//     ->middleware('jwt.verify');

// Route::get('recruiter/offer-posts', [OfferPostController::class, 'recruiterOffers'])
//     ->middleware(['jwt.verify', 'recruiter']);
// // Route::middleware('auth:api')->group(function () {

// });

// Candidature Routes
Route::get('candidatures', [CandidatureController::class, 'index'])->middleware(['auth:api', 'candidate']);
Route::post('offer-posts/{id}/apply', [CandidatureController::class, 'store'])->middleware(['auth:api', 'candidate']);
Route::delete('candidatures/{id}', [CandidatureController::class, 'withdraw'])->middleware(['auth:api', 'candidate']);
Route::get('offer-posts/{id}/candidatures', [CandidatureController::class, 'jobApplications'])->middleware(['auth:api', 'recruiter']);
Route::put('candidatures/{id}/status', [CandidatureController::class, 'updateStatus'])->middleware(['auth:api', 'recruiter']);


Route::middleware(['auth', 'role:recruteur'])->group(function () {

});

Route::middleware(['auth', 'role:candidat'])->group(function () {
   
});
