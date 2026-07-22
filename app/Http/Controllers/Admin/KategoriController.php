<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KategoriRequest;
use App\Models\Kategori;
use App\Services\Admin\KategoriService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KategoriController extends Controller
{
    public function __construct(protected KategoriService $kategoriService) {}

    public function index(): View
    {
        $kategoriList = $this->kategoriService->semua();

        return view('admin.kategori.index', compact('kategoriList'));
    }

    public function create(): View
    {
        return view('admin.kategori.create');
    }

    public function store(KategoriRequest $request): RedirectResponse
    {
        $this->kategoriService->buat($request->validated());

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori): View
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(KategoriRequest $request, Kategori $kategori): RedirectResponse
    {
        $this->kategoriService->perbarui($kategori, $request->validated());

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori): RedirectResponse
    {
        try {
            $this->kategoriService->hapus($kategori);
        } catch (\RuntimeException $e) {
            return redirect()
                ->route('admin.kategori.index')
                ->with('error', $e->getMessage());
        }

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
