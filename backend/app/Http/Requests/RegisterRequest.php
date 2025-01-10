<?php

namespace App\Http\Requests;

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
            "name" => "required|string|max:200",
            "username" => "required|string|max:200|unique:users",
            "email" => "required|email",
            "password" => "required|string|min:8|max:200",
            "confirmPassword" => "required|same:password",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Nama wajib diisi",
            "name.string" => "Nama harus berupa string",
            "name.max" => "Nama tidak boleh lebih dari 200 karakter",
            "username.required" => "Username wajid diisi",
            "username.string" => "Username harus berupa string",
            "username.max" => "Username tidak boleh lebih dari 200 karakter",
            "username.unique" => "Username sudah ada",
            "email.required" => "Email wajib diisi",
            "email.email" => "Email tidak valid",
            "password.required" => "Password wajib diisi",
            "password.string" => "Password harus berupa string",
            "password.min" => "Password minimal 8 karakter",
            "password.max" => "Password tidak boleh lebih dari 200 karakter",
            "confirmPassword.required" => "Konfirmasi password wajib diisi",
            "confirmPassword.same" => "Password dan Konfirmasi Password tidak sama",
        ];
    }
}
