<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('/event/show/{id}', [HomeController::class, 'show'])->name('event.show');

Route::get('/home', function () {
    // return view('dashboard');
    return 'Verma';
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::resources([
        'permission'    => PermissionController::class, 
        'role'          => RoleController::class,
        'adminuser'     => AdminUserController::class,
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
require __DIR__.'/admin-auth.php';