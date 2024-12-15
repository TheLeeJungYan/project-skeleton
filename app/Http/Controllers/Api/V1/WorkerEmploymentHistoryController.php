<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\storeWorkerEmploymentHistoryRequest;
use App\Http\Requests\updateWorkerEmploymentHistoryRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Responses\ApiSuccessResponse;
use App\Http\Responses\ApiErrorResponse;
use App\Models\Worker;
use App\Models\WorkerEmploymentHistory;
use App\Exceptions\ActiveEmploymentException;
use DB;

class WorkerEmploymentHistoryController extends Controller
{
    public function create(storeWorkerEmploymentHistoryRequest $request):JsonResponse
    {
        try{

            $validatedData = $request->validated();
            $worker = Worker::where('email',$request->input('workerEmail'))
                        ->with(['workerEmploymentHistories'=>function($query){
                            $query->whereNull('endDate');
                        }])->first();

            if($worker && !$worker->workerEmploymentHistories->isEmpty()){
                throw new ActiveEmploymentException();
            }
            
            $workerEmploymentHistory = WorkerEmploymentHistory::create([
                'workerId'=>$worker->id,
                'companyName'=>$request->input('companyName'),
                'jobTitle'=>$request->input('jobTitle'),
                'startDate'=>$request->input('startDate')
            ]);

            $responseData = [
                'id'=>$workerEmploymentHistory->id
            ];
            
            return new ApiSuccessResponse($responseData,Response::HTTP_CREATED);  

        }catch(ActiveEmploymentException $e){
            return new ApiErrorResponse($e->getMessage(),$e->getStatusCode());
        }
        catch(\Exception  $e){
            $statusCode = $e instanceof \Symfony\Component\HttpKernel\Exception\HttpException
                ? $e->getStatusCode() 
                : Response::HTTP_INTERNAL_SERVER_ERROR;
            return new ApiErrorResponse($e->getMessage(),$statusCode);
        }
    }

    public function update(updateWorkerEmploymentHistoryRequest $request)
    {
        
        try{
            $validatedData = $request->validated();
            $workerEmploymentHistory = WorkerEmploymentHistory::find($request->input('workerEmploymentId'));
            $workerEmploymentHistory->update([
                'endDate'=>$request->input('endDate')
            ]);
            $responseData = [
                'id'=>$workerEmploymentHistory->id
            ];
            return new ApiSuccessResponse($responseData,Response::HTTP_OK);  
        }catch(\Exception  $e){
            $statusCode = $e instanceof \Symfony\Component\HttpKernel\Exception\HttpException
                ? $e->getStatusCode() 
                : Response::HTTP_INTERNAL_SERVER_ERROR;
            return new ApiErrorResponse($e->getMessage(),$statusCode);
        }
      
    }
}
