<?php

use App\Http\Controllers\MonitoredSiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::resource('sites', MonitoredSiteController::class);
});