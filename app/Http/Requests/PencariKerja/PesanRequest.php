<?php

namespace App\Http\Requests\PencariKerja;

use Illuminate\Foundation\Http\FormRequest;

class PesanRequest extends FormRequest
{
    public function authorize(): bool
    {
        $percakapan = $this->route('percakapan');
        $user = $this->user();

        $idPencariKerja = $percakapan->lamaran->id_pencari_kerja;
        $idPemberiKerja = $percakapan->lamaran->lowongan->id_pemberi_kerja;

        return $user->id === $idPencariKerja || $user->id === $idPemberiKerja;
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
            'isi.max'      => 'Pesan maksimal 1000 karakter.',
        ];
    }
}
