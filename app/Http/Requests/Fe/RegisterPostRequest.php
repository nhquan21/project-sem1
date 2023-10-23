<?php

namespace App\Http\Requests\Fe;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPostRequest extends FormRequest
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
            'name'=>['required','unique:users'],
            'phone'=>['required','regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
            'email'=>['required','email'],
            'password'=>['required']
        ];
    }
}
