<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric|digits_between:8,15|unique:users,mobile',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username is required',
            'username.string' => 'Username must be string',
            'username.max' => 'Username max 50 characters',
            'email.required' => 'Email is required',
            'email.string' => 'Email must be string',
            'email.unique' => 'Email already exists',
            'mobile.required' => 'Mobile is required',

        ];
    }
}
