<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController as UserProfileController;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Route::resource('home', HomeController::class);
Route::get('/event/show/{id}', [HomeController::class, 'show'])->name('event.show');

Route::get('/home', function () {
    // return view('dashboard');
    return 'Verma';
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resources([
        'profile'       => UserProfileController::class,
    ]);
});

Route::fallback(function(){
    return view('fallback');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';