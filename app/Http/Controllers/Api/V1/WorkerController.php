<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Worker;
use App\Http\Requests\StoreWorkerRequest;
use App\Http\Responses\ApiSuccessResponse;
use App\Http\Responses\ApiErrorResponse;
use DB;

class WorkerController extends Controller
{
    public function index():JsonResponse
    {
        try{
            $workers = Worker::select(
                'id',
                'firstName',
                'lastName',
                'email'
                )
                ->with('workerEmploymentHistories')
                ->get();
            $value = [
                'workers'=>$workers
            ];
            return new ApiSuccessResponse($value,Response::HTTP_OK);
        }catch(\Exception  $e){
         
            $statusCode = $e instanceof \Symfony\Component\HttpKernel\Exception\HttpException
                ? $e->getStatusCode() 
                : Response::HTTP_INTERNAL_SERVER_ERROR;
            return new ApiErrorResponse($e->getMessage(),$statusCode);
        }   
    }

    public function create(StoreWorkerRequest $request)
    {
        try{
            DB::beginTransaction();
            $validatedData = $request->validated();
            $worker = Worker::create($validatedData);
            $id = [
                'id'=>$worker->id
            ];
            DB::commit();
            return new ApiSuccessResponse($id,Response::HTTP_OK);     
        }catch(\Exception  $e){
            DB::rollBack();
            $statusCode = $e instanceof \Symfony\Component\HttpKernel\Exception\HttpException
                ? $e->getStatusCode() 
                : Response::HTTP_INTERNAL_SERVER_ERROR;
            return new ApiErrorResponse($e->getMessage(),$statusCode);
        }
    
    }
}
