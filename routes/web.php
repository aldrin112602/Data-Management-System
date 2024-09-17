<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SystemDataController;
use App\Http\Controllers\ProvincialDataController;
use App\Http\Controllers\MunicipalDataController;
use App\Http\Controllers\OfficialsDataController;
use App\Http\Controllers\LocationDataController;
use App\Http\Controllers\LocationInformationController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('system-data', SystemDataController::class);
Route::resource('provincial-data', ProvincialDataController::class);
Route::resource('municipal-data', MunicipalDataController::class);
Route::resource('officials-data', OfficialsDataController::class);
Route::resource('location-data', LocationDataController::class);
Route::resource('location-information', LocationInformationController::class);


Route::get('/getMunicipalities/{province_id}', [App\Http\Controllers\OfficialsDataController::class, 'getMunicipalities']);
