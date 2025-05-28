<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            "name" => ['required', 'string'],
            "identification" => [
                'required',
                'string',
                Rule::unique("users", "identification")->ignore(id: request('users'), idColumn: 'id')
            ],
            "password" => ['required', 'string'],
            "role" => ["required"]
        ];
    }
    public function messages()
    {
        return [
            'identification.unique'=>__('The identification already exists')
        ];
    }
}
