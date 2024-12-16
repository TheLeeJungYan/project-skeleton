<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Responses\ApiErrorResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class updateWorkerEmploymentHistoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'workerEmploymentId'=>'required|numeric|exists:workerEmploymentHistories,id',
            'endDate'=>'required|date_format:Y-m-d',
        ];
    }

    public function messages(): array 
    {
        return [
            'workerEmploymentId.required' => 'Worker employment id is required.',
            'workerEmploymentId.numeric' => 'Email address must be a valid numeric.',
            'workerEmploymentId.exists' => 'The worker employment id does not exist.',
            'endDate.required'=> 'End Date is required.',
            'endDate.date_format' => 'End date format is invalid. Please use the format "YYYY-MM-DD".',
        ];
    }

    protected function failedValidation(Validator $validator):JsonResponse
    {
        $errors = $validator->errors();
        $statusCode = Response::HTTP_BAD_REQUEST;
        throw new HttpResponseException(
            new ApiErrorResponse($errors,$statusCode)
        );
    }
}
