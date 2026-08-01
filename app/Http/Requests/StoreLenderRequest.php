<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLenderRequest extends FormRequest
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
        'name'    => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/u',
        'email'   => 'required|email|max:255|unique:lenders,email',
        'phone'   => 'required|string|max:20',
        'gender'  => 'required|in:male,female',
        'notes'   => 'nullable|string',
        'profile' => [
            'nullable',
            'image',
            'mimes:jpeg,png,jpg,gif,svg',
            'max:2048',
            Rule::dimensions()->minwidth(100)->minheight(100),
        ],
    ];
}

    /**
     * Get the validation errors.
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation Errors',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
