<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UbahStatusPenggunaRequest;
use App\Models\User;
use App\Services\Admin\PenggunaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PenggunaController extends Controller
{
    public function __construct(protected PenggunaService $penggunaService) {}

    public function index(Request $request): View
    {
        $filter = $request->only(['role', 'status_akun', 'cari']);

        $penggunaList = $this->penggunaService->semua($filter);

        return view('admin.pengguna.index', compact('penggunaList', 'filter'));
    }

    public function show(User $pengguna): View
    {
        if ($pengguna->isAdmin()) {
            abort(403, 'Akses ditolak. Data Admin tidak dapat dilihat di sini.');
        }

        return view('admin.pengguna.show', compact('pengguna'));
    }

    public function updateStatus(UbahStatusPenggunaRequest $request, User $pengguna): RedirectResponse
    {
        if ($pengguna->isAdmin()) {
            abort(403, 'Akses ditolak. Status Admin tidak dapat diubah.');
        }

        $this->penggunaService->ubahStatus($pengguna, $request->validated()['status_akun']);

        return redirect()
            ->back()
            ->with('success', 'Status akun ' . $pengguna->nama . ' berhasil diperbarui.');
    }
}
