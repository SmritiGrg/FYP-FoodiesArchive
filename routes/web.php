<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FoodPostController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Models\FoodPosts;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('FoodiesArchive.index');
});

Route::get('/', [FrontendController::class, 'index']);
Route::get('/discover', [FrontendController::class, 'discover']);
Route::get('/writeReview', [FrontendController::class, 'writeReview']);
// Route::get('/about', [FrontendController::class, 'about']);
Route::get('/bookmark', [FrontendController::class, 'bookmark']);
Route::get('/PersonalProfile', [FrontendController::class, 'personalProfile'])->name('personalProfile');

Route::get('/search', [FoodPostController::class, 'search'])->name('search.food');
// Route::get('/writeReviewSearch', [FoodPostController::class, 'searchForReview'])->name('search.review');

Route::get('/postDetails/{id}', [FoodPostController::class, 'show'])->name('food.details');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::resource('/foodpost', FoodPostController::class);

    Route::get('/foodpost/{step?}', [FoodPostController::class, 'create'])->name('foodpost.create');
    // Route::post('/foodpost', [FoodPostController::class, 'store'])->name('foodpost.store');

    Route::post('/foodpost/next', [FoodPostController::class, 'nextStep'])->name('foodpost.next');
    Route::post('/foodpost/previous', [FoodPostController::class, 'previousStep'])->name('foodpost.previous');
    Route::post('/foodpost/submit', [FoodPostController::class, 'store'])->name('foodpost.store');
    Route::post('/foodpost/clear-session', [FoodPostController::class, 'clearFormSession'])->name('foodpost.clearSession');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'removeImage'])->name('profile.remove-image');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user/calendar/{month?}/{year?}', [AuthenticatedSessionController::class, 'userCalendar'])->name('user.calendar');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

require __DIR__ . '/auth.php';
