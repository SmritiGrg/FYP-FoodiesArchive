<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\FoodPostController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewsController;
use App\Models\FoodPosts;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('FoodiesArchive.index');
});

Route::get('/', [FrontendController::class, 'index']);
Route::get('/discover', [FrontendController::class, 'discover'])->name('food.discover');
Route::get('/writeReview', [FrontendController::class, 'writeReview']);
// Route::get('/about', [FrontendController::class, 'about']);
Route::get('/bookmark', [FrontendController::class, 'bookmark']);


Route::get('/search', [FoodPostController::class, 'search'])->name('search.food');
// Route::get('/writeReviewSearch', [FoodPostController::class, 'searchForReview'])->name('search.review');

Route::get('/discover/postDetails/{id}', [FoodPostController::class, 'show'])->name('food.details');

Route::get('/userProfile/{id}', [FrontendController::class, 'otherProfile'])->name('otherProfile');

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

    Route::get('/PersonalProfile', [FrontendController::class, 'personalProfile'])->name('personalProfile');

    Route::get('/PersonalProfile/calendar/{month?}/{year?}', [AuthenticatedSessionController::class, 'userCalendar'])->name('user.calendar');

    Route::get('/write-review/{food_id}', [ReviewsController::class, 'writeReview'])->name('writeReview');

    Route::post('/food-posts/{foodPost}/like', [LikesController::class, 'like'])->name('food-posts.like');

    Route::post('users/{user}/follow', [FollowsController::class, 'follow'])->name('users.follow');
    Route::post('users/{user}/unfollow', [FollowsController::class, 'unfollow'])->name('users.unfollow');

    Route::get('/following', [FrontendController::class, 'following'])->name('food.following');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

require __DIR__ . '/auth.php';
