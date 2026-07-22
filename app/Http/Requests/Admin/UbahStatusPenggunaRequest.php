<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UbahStatusPenggunaRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var \App\Models\User $user */
        $user = $this->user();

        return $user->isAdmin();
    }

    public function rules(): array
    {
        return [
            'status_akun' => ['required', 'in:aktif,nonaktif,banned'],
        ];
    }

    public function messages(): array
    {
        return [
            'status_akun.required' => 'Status akun wajib dipilih.',
            'status_akun.in' => 'Status akun tidak valid.',
        ];
    }
}
