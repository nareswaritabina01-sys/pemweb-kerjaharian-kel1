<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LamaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isPencariKerja() ?? false;
    }

    public function rules(): array
    {
        return [
            'pesan' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'pesan.max' => 'Pesan tidak boleh lebih dari 1000 karakter.',
        ];
    }
}