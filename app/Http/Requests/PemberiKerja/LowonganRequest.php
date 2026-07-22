<?php

namespace App\Http\Requests\PemberiKerja;

use Illuminate\Foundation\Http\FormRequest;

class LowonganRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var \App\Models\User $user */
        $user = $this->user();

        return $user !== null && $user->isPemberiKerja();
    }

    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'nama_perusahaan' => ['nullable', 'string', 'max:255'],
            'lokasi' => ['required', 'string', 'max:500'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'upah' => ['required', 'numeric', 'min:0'],
            'satuan_upah' => ['required', 'in:harian,borongan'],
            'kategori_id' => ['required', 'integer', 'exists:kategori,id'],
            'deskripsi' => ['required', 'string'],
            'kuota_pekerja' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul lowongan wajib diisi.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'latitude.required' => 'Silakan pilih titik lokasi di peta.',
            'longitude.required' => 'Silakan pilih titik lokasi di peta.',
            'upah.required' => 'Upah wajib diisi.',
            'upah.min' => 'Upah tidak boleh negatif.',
            'satuan_upah.in' => 'Satuan upah harus harian atau borongan.',
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            'deskripsi.required' => 'Deskripsi pekerjaan wajib diisi.',
            'kuota_pekerja.min' => 'Kuota pekerja minimal 1.',
        ];
    }
}
