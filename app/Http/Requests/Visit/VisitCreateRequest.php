<?php

namespace App\Http\Requests\Visit;

use Illuminate\Foundation\Http\FormRequest;

class VisitCreateRequest extends FormRequest
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
            "name"=>['required', 'string', 'max:255'],
            "email"=>['required', 'string', 'email', 'max:255'],
            "latitude"=>['required', 'string', 'max:255'],
            "longitude"=>['required', 'string', 'max:255'],
        ];
    }
}
