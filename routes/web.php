<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SystemDataController;
use App\Http\Controllers\ProvincialDataController;
use App\Http\Controllers\MunicipalDataController;
use App\Http\Controllers\OfficialsDataController;
use App\Http\Controllers\LocationDataController;
use App\Http\Controllers\LocationInformationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PinnedLocationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MapController;

// Admin Routes
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('system-data', SystemDataController::class);
Route::resource('provincial-data', ProvincialDataController::class);
Route::resource('municipal-data', MunicipalDataController::class);
Route::resource('officials-data', OfficialsDataController::class);
Route::resource('location-data', LocationDataController::class);
Route::resource('location-information', LocationInformationController::class);

Route::get('/getMunicipalities/{province_id}', [OfficialsDataController::class, 'getMunicipalities']);

Route::resource('reviews', ReviewController::class);
Route::patch('/reviews/{review}/approve', [ReviewController::class, 'approve'])->name('reviews.approve');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

Route::resource('events', EventController::class);

Route::resource('pinned-locations', PinnedLocationController::class);
Route::post('pinned-locations/{id}/approve', [PinnedLocationController::class, 'approve'])->name('pinned-locations.approve');
Route::delete('pinned-locations/{id}', [PinnedLocationController::class, 'destroy'])->name('pinned-locations.destroy');

// User Routes
Route::get('/user/identity', [UserController::class, 'showIdentityForm'])->name('user.identity');
Route::post('/user/set-identity', [UserController::class, 'setIdentity'])->name('user.setIdentity');

// Pinned Location for Users
Route::get('/user/pin-location', [PinnedLocationController::class, 'pinLocationForm'])->name('user.pinLocation');
Route::post('/user/pin-location', [PinnedLocationController::class, 'storePinnedLocation'])->name('user.storePinnedLocation');

// User Dashboard & Map
Route::get('/user/dashboard', [MapController::class, 'dashboard'])->name('user.dashboard');


Route::post('user/dashboard', [ReviewController::class, 'store'])->name('user.storeReview');


Route::get('user/reviews', [MapController::class, 'getReviews'])->name('user.get_reviews');
Route::get('/edit-review/{reviewId}', [MapController::class, 'editReview'])->name('user.editReview');
Route::patch('/edit-review/{reviewId}', [MapController::class, 'updateReview'])->name('user.updateReview');
Route::delete('/delete-review/{reviewId}', [MapController::class, 'deleteReview'])->name('user.deleteReview');

// Add to Favorites
Route::get('/add-to-favorites/{locationId}', [MapController::class, 'addToFavorites'])->name('user.addToFavorites');
Route::get('/user/favorites', [MapController::class, 'favorites'])->name('user.favorites');

// Location in Details
Route::get('/user/location-details', [MapController::class, 'locationDetails'])->name('user.location.details');

// User Notifications
Route::get('/user/notifications', [NotificationController::class, 'index'])->name('user.notifications');
Route::get('/user/get_notifications', [NotificationController::class, 'getNotif'])->name('user.get_notifications');

// User Events
Route::get('/user/events', [EventController::class, 'userEvents'])->name('user.events');
