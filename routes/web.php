<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FoodPostController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('FoodiesArchive.index');
});

Route::get('/', [FrontendController::class, 'index']);
Route::get('/discover', [FrontendController::class, 'discover']);
Route::get('/writeReview', [FrontendController::class, 'writeReview']);
Route::get('/postFood', [FrontendController::class, 'postFood']);
// Route::get('/about', [FrontendController::class, 'about']);
Route::get('/bookmark', [FrontendController::class, 'bookmark']);

Route::get('/search', [FoodPostController::class, 'search'])->name('search.food');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('/foodpost', FoodPostController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'removeImage'])->name('profile.remove-image');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

require __DIR__ . '/auth.php';
