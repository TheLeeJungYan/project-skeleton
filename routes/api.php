<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureJsonRequest;
use App\Http\Controllers\Api\V1\WorkerController;
use App\Http\Controllers\Api\V1\WorkerEmploymentHistoryController;

Route::controller(Controller::class)->group(function () {
  Route::get('/', 'index')->name('index');
});

Route::middleware([EnsureJsonRequest::class])->group(function () {

  Route::controller(WorkerController::class)->group(function () {
    Route::get('/worker','index');
    Route::post('/worker','create');
  });

  Route::controller(WorkerEmploymentHistoryController::class)->group(function(){
    Route::post('/employment','create');
  });
  
});
