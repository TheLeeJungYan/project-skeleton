<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Responses\ApiErrorResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
class storeWorkerEmploymentHistoryRequest extends FormRequest
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
            'workerEmail'=>'required|email|exists:workers,email',
            'companyName'=>'required|string',
            'jobTitle'=>'required|string',
            'startDate'=>'required|date',
        ];
    }

    public function messages(): array 
    {
        return [
            'workerEmail.required' => 'Email address is required.',
            'workerEmail.email' => 'Email address must be a valid email address.',
            'workerEmail.exists' => 'The provided email address does not exist.',
            'companyName.required'=> 'Company Name is required.',
            'companyName.string' => 'Company name must be a valid string.',
            'jobTitle.required'=>'Job title is required.',
            'jobTitle.string' => 'Job title must be a valid string.',
            'startDate.required'=>'Start date is required.',
            'startDate.date' => 'Start date must be a valid date.',
        ];
    }


    protected function failedValidation(Validator $validator):JsonResponse
    {
        $errors = $validator->errors();
        throw new HttpResponseException(
            new ApiErrorResponse($errors,Response::HTTP_BAD_REQUEST)
        );
    }
}
