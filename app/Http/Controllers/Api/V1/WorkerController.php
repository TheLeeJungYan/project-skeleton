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
use App\Http\Resources\WorkerCollection;
use App\Http\Resources\WorkerResource;
use DB;

class WorkerController extends Controller
{
    public function index():JsonResponse
    {
        try{

            $worker = Worker::select(
                'id',
                'firstName',
                'lastName',
                'email'
                )
                ->with('workerEmploymentHistories')
                ->get();
            $workerResources  = WorkerResource::collection($worker);
            $responseData  = [
                'workers'=>$workerResources 
            ];
            return new ApiSuccessResponse($responseData,Response::HTTP_OK);

        }catch(\Exception  $e){

            $statusCode = $e instanceof \Symfony\Component\HttpKernel\Exception\HttpException
                ? $e->getStatusCode() 
                : Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = $e->getMessage();
            return new ApiErrorResponse($message,$statusCode);
            
        }   
    }

    public function create(StoreWorkerRequest $request):JsonResponse
    {
        try{

            $validatedData = $request->validated();
            $worker = Worker::create($validatedData);
            $id = [
                'id'=>$worker->id
            ];
            return new ApiSuccessResponse($id,Response::HTTP_CREATED); 

        }catch(\Exception  $e){

            $statusCode = $e instanceof \Symfony\Component\HttpKernel\Exception\HttpException
                ? $e->getStatusCode() 
                : Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = $e->getMessage();
            return new ApiErrorResponse($message,$statusCode);
            
        }
    
    }
}
