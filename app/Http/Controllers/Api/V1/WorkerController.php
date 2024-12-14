<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Worker;
class WorkerController extends Controller
{
    public function index():JsonResponse
    {
        $workers = Worker::all();
        return response()->json(['data'=>$workers]);
    }
}
