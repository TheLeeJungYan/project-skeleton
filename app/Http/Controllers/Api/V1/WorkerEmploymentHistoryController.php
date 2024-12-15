<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\storeWorkerEmploymentHistoryRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Responses\ApiSuccessResponse;
use App\Http\Responses\ApiErrorResponse;
use App\Models\Worker;
use App\Models\WorkerEmploymentHistory;
use DB;
class WorkerEmploymentHistoryController extends Controller
{
    public function create(storeWorkerEmploymentHistoryRequest $request):JsonResponse
    {
        try{
            DB::beginTransaction();
            $validatedData = $request->validated();
            $worker = Worker::where('email',$request->input('workerEmail'))->first();
            return response()->json(['worker'=>$worker->id]);
            $workerEmploymentHistory = WorkerEmploymentHistory::create([
                'workerId'=>$worker->id,
                'companyName'=>$request->input('companyName'),
                'jobTitle'=>$request->input('jobTitle'),
                'startDate'=>$request->input('startDate')
            ]);
            return response()->json(['worker'=>$worker]);
        }catch(\Exception  $e){
            DB::rollBack();
            $statusCode = $e instanceof \Symfony\Component\HttpKernel\Exception\HttpException
                ? $e->getStatusCode() 
                : Response::HTTP_INTERNAL_SERVER_ERROR;
            return new ApiErrorResponse($e->getMessage(),$statusCode);
        }
    }

    public function update(){
        
    }
}
