<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Responses\ApiErrorResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
class StoreWorkerRequest extends FormRequest
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
            'firstName'=>'required|string',
            'lastName'=>'required|string',
            'email'=>'required|email|unique:workers,email'
        ];
    }

    public function messages(): array 
    {
        return [
            'firstName.required' => 'First name is required.',
            'firstName.string' => 'First name must be a valid string.',
            'lastName.required' => 'Last name is required.',
            'lastName.string' => 'Last name must be a valid string.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Email address must be a valid email address.',
            'email.unique' => 'The email address is already registered.',
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
