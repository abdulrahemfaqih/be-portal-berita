<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            "title" => "sometimes|required|max:200",
            "content" => "sometimes|required",
            "image" => "sometimes|file|image|max:2048"
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul wajib diisi',
            'title.max' => 'Judul maksimal 200 karakter',
            'content.required' => 'Konten wajib diisi',
            'image.file' => 'File harus berupa gambar',
            'image.image' => 'File harus berupa format gambar (jpg, png, dll)',
            'image.max' => 'Ukuran gambar maksimal 2MB'
        ];
    }
}
