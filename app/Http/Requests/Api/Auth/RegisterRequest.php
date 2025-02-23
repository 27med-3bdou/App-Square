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
            'mobile' => 'required|unique:users,mobile',
            'password' => 'required|min:6|confirmed',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'name.required' => 'الاسم مطلوب!',
    //         'email.required' => 'البريد الإلكتروني مطلوب!',
    //         'email.unique' => 'البريد الإلكتروني مستخدم بالفعل!',
    //         'mobile.required' => 'رقم الهاتف مطلوب!',
    //         'password.required' => 'كلمة المرور مطلوبة!',
    //         'password.confirmed' => 'كلمة المرور غير متطابقة!',
    //     ];
    // }
}
