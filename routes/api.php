<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::controller(Controller::class)->group(function () {
  Route::get('/', 'index')->name('index');
});
