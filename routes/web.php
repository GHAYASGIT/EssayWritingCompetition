<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\EssayController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\McqsController;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Route::resource('home', HomeController::class);
Route::get('/event/show/{id}', [HomeController::class, 'show'])->name('event.show');

Route::get('/check-auth', function () {
    return response()->json(['authenticated' => Auth::check()]);
});

// Route::get('/home', function () {
//     // return view('dashboard');
//     return 'Verma';
// })->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resources([
        'profile'   => ProfileController::class,
        'booking'   => BookingController::class,
        'essay'     => EssayController::class,
        'mcqs'      => McqsController::class
    ]);
});

Route::fallback(function(){
    return view('fallback');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';