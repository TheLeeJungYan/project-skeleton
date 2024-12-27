<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class Controller
{
    // public function index():JsonResponse
    // {
    //     $database = null;

    //     try {
    //         $database = (bool) DB::getPdo() ? 'OK' : 'FAILURE';
    //     } catch (\Exception $exception) {
    //         $database = 'FAILURE';
    //     }

    //     return response()->json([
    //         'container' => 'OK',
    //         'database' => $database,
    //     ]);
    // }
}
