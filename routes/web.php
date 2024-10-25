<?php

use App\Events\reservebook;
use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ListingImageController;
use App\Http\Controllers\MyBookPlaces;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route::get('/socket', function () {
//     event(new reservebook('hello'));
//     return 'ok';
// });
Route::resource('userprofile', UserProfileController::class);
Route::resource('rental', RentalController::class);
Route::resource('image', ListingImageController::class);
Route::resource('amenities', AmenitiesController::class);
Route::resource('booking', BookingController::class);
Route::resource('mybookplaces', MyBookPlaces::class);
// Route::get("http://localhost:3000/");

require __DIR__ . '/auth.php';
