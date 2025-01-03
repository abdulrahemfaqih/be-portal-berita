<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            "title" => "required|max:200",
            "content" => "required",
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "Judul wajib diisi",
            "title.max" => "Judul tidak boleh lebih dari 200 karakter",
            "content.required" => "Content wajib diisi",
        ];
    }
}
