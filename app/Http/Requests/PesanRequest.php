<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PesanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'isi' => ['required', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'isi.required' => 'Pesan tidak boleh kosong.',
        ];
    }
}