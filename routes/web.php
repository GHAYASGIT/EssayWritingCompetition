<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('/event/show/{id}', [HomeController::class, 'show'])->name('event.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resources([
        'permission'    => PermissionController::class, 
        'role'          => RoleController::class, 
        'user'          => UserController::class,
        'profile'       => ProfileController::class,
        'categories'    => CategoriesController::class,
        'events'        => EventsController::class
    ]);

    Route::get('events/active/{id}', [EventsController::class, 'active'])->name('events.active');
    Route::get('events/inactive/{id}', [EventsController::class, 'inactive'])->name('events.inactive');

    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::fallback(function(){
    return view('fallback');
});

require __DIR__.'/auth.php';
