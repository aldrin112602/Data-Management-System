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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('system-data', SystemDataController::class);
Route::resource('provincial-data', ProvincialDataController::class);
Route::resource('municipal-data', MunicipalDataController::class);
Route::resource('officials-data', OfficialsDataController::class);
Route::resource('location-data', LocationDataController::class);
Route::resource('location-information', LocationInformationController::class);


Route::get('/getMunicipalities/{province_id}', [App\Http\Controllers\OfficialsDataController::class, 'getMunicipalities']);

Route::resource('reviews', ReviewController::class);
Route::patch('/reviews/{review}/approve', [ReviewController::class, 'approve'])->name('reviews.approve');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

Route::resource('events', EventController::class);

Route::resource('pinned-locations', PinnedLocationController::class);
Route::post('pinned-locations/{id}/approve', [PinnedLocationController::class, 'approve'])->name('pinned-locations.approve');
Route::delete('pinned-locations/{id}', [PinnedLocationController::class, 'destroy'])->name('pinned-locations.destroy');
