<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfilPemberiKerjaRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = Auth::user();

        return $user?->isPemberiKerja() ?? false;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:30',
            'alamat' => 'nullable|string|max:1000',
            'bio' => 'nullable|string',
            'foto_profil' => 'nullable|image|max:2048',
            'nama_usaha' => 'nullable|string|max:255',
            'jenis_usaha' => 'nullable|string|max:255',
        ];
    }
}