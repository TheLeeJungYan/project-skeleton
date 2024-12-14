<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\WorkerController;
use Illuminate\Support\Facades\Route;

Route::controller(Controller::class)->group(function () {
  Route::get('/', 'index')->name('index');
});

Route::controller(WorkerController::class)->group(function () {
  Route::get('/worker','index');
});