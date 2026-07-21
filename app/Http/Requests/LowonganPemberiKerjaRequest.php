<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LowonganPemberiKerjaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // otorisasi kepemilikan dicek di Controller (route model binding + middleware role)
    }

    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:150'],
            'nama_perusahaan' => ['nullable', 'string', 'max:150'],
            'lokasi' => ['required', 'string', 'max:255'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'upah' => ['required', 'numeric', 'min:0'],
            'satuan_upah' => ['required', 'in:harian,borongan'],
            'kategori' => ['required', 'string', 'max:100'],
            'deskripsi' => ['required', 'string'],
            'kuota_pekerja' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'latitude.required' => 'Silakan pilih lokasi lowongan di peta.',
            'longitude.required' => 'Silakan pilih lokasi lowongan di peta.',
        ];
    }
}