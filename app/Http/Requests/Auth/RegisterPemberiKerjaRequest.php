<?php
// app/Http/Requests/Auth/RegisterPemberiKerjaRequest.php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPemberiKerjaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
        ];
    }
}