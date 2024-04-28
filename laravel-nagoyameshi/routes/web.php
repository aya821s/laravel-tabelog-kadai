<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ReservationController;

Route::get('/',  [WebController::class, 'index'])->name('top');

Route::controller(UserController::class)->group(function () {
    Route::get('user/mypage', 'mypage')->name('mypage');
    Route::get('user/mypage/edit', 'edit')->name('mypage.edit');
    Route::put('user/mypage', 'update')->name('mypage.update');
    Route::get('users/delete', 'delete')->name('user.delete');
    Route::delete('users/delete', 'destroy')->name('mypage.destroy');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
    Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');
    Route::get('/restaurants/search', [RestaurantController::class, 'edit'])->name('restaurants.search');
});


Route::middleware(['notsubscribed'])->group(function () {
});
    Route::get('/subscription', [SubscriptionController::class, 'create'])->name('subscription.create');
    Route::post('/subscription/store', [SubscriptionController::class, 'store'])->name('subscription.store');


Route::middleware(['subscribed'])->group(function () {
    Route::get('/users/mypage/favorite', [UserController::class, 'favorite'])->name('mypage.favorite');

    Route::get('/reviews/{restaurant}', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/reviews/{restaurant}', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');


    Route::post('/favorites/{restaurant_id}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{restaurant_id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    Route::get('/subscription/edit', [SubscriptionController::class, 'edit'])->name('subscription.edit');
    Route::patch('/subscription/update', [SubscriptionController::class, 'update'])->name('subscription.update');
    Route::get('/subscription/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
    Route::post('/subscription/cancel', [SubscriptionController::class, 'destroy'])->name('subscription.destroy');

    Route::get('/reservations/index', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/{restaurant}', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations/{restaurant}', [ReservationController::class, 'store'])->name('reservations.store');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
});
    

require __DIR__.'/auth.php';