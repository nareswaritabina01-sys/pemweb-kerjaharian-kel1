# KerjaHarian — Fitur Admin: Planning & Context Handover

> Dokumen ini berisi seluruh konteks proyek dan hasil planning fitur Admin yang
> sudah dianalisis lengkap. Gunakan ini sebagai satu-satunya sumber kebenaran
> saat melanjutkan pengembangan dengan AI assistant apapun.

---

## 1. Info Proyek

| Item | Detail |
|---|---|
| Nama proyek | KerjaHarian |
| Folder | `pemweb-kerjaharian-kel1` |
| Framework | Laravel 13.18.0, PHP 8+ |
| Database | MySQL |
| Frontend | Blade, Tailwind CSS (via Vite, BUKAN Bootstrap), Alpine.js |
| Library | LeafletJS + OpenStreetMap (geolocation), SweetAlert2 (global via CDN di layout), Chart.js, DataTables, Font Awesome |
| Font | Plus Jakarta Sans |
| Warna | Primary `#007A87` (teal), Secondary `#f4b41a` (kuning), didefinisikan sebagai Tailwind `@theme` custom color |
| Arsitektur | Controller = validasi + service call + redirect saja. Business logic di Service layer. Model untuk relasi/scope/accessor/mutator. |
| Bahasa | Seluruh nama controller/middleware/service/route/tabel database pakai Bahasa Indonesia (lowongan, lamaran, kontrak, ulasan, laporan, dll). Variabel tetap camelCase. |
| Dev environment | Laragon (Windows), virtual host lokal |

**Strategi pengembangan:** dikerjakan **berurutan per role** — Admin → Pemberi Kerja → Pencari Kerja (untuk role) dan **per modul** dalam satu role. Jangan pindah sebelum modul sebelumnya selesai + ditest.

**AI berperan sebagai Tech Lead:** analisis requirement dulu → jelaskan rencana implementasi singkat → beri kode production-ready sesuai arsitektur di atas → flag kalau ada keputusan desain yang kurang baik beserta alasannya.

**Konvensi kode penting:** kalau ada method Laravel yang bikin static analyzer (Intelephense) error palsu "Undefined method" (misal `$request->user()->x`), solusinya BUKAN install `laravel-ide-helper` (sudah dicoba, tidak mempan) — tapi assign ke variabel dengan docblock eksplisit:
```php
/** @var User $user */
$user = $request->user();
```
Tetap gunakan `$request->user()` (bukan `auth()->id()`/`auth()->user()`) di dalam Controller untuk konsistensi.

---

## 2. Status Progres Saat Ini

- **Role Pencari Kerja**: ✅ 100% SELESAI (Dashboard, Cari Lowongan+radius, Detail Lowongan+Bookmark, Apply Lamaran, Batal Lamar, Notifikasi, Lowongan Tersimpan, Chat/Pesan dasar, Profil+foto — semua ditest dan lolos)
- **Role Pemberi Kerja**: ✅ 100% SELESAI
- **Role Admin**: 🔴 BELUM DIKERJAKAN — baru tahap planning/analisis lengkap (dokumen ini), route baru 1 baris dummy `admin/dashboard`

**Git:**
- Branch `fitur-pencari-kerja` dan `fitur-pemberi-kerja` sudah **merged ke `main`** (via PR GitHub, tanpa konflik berarti)
- Branch `fitur-admin` sudah dibuat dari `main` yang lengkap, sudah di-push ke origin — **branch aktif sekarang**
- Repo GitHub: `nareswaritabina01-sys/pemweb-kerjaharian-kel1` (milik teman satu tim)

---

## 3. Struktur Database Existing (Relevan untuk Fitur Admin)

### Tabel `users`
```php
id, nama, email, email_verified_at, password,
role enum('admin','pemberi_kerja','pencari_kerja'),
no_telepon, alamat,
latitude, longitude (decimal, untuk geolocation),
foto_profil, bio, nama_usaha, jenis_usaha,
nama_bank, nomor_rekening, nama_pemilik_rekening,
status_aktif boolean default true,   -- ⚠️ AKAN DIGANTI, lihat Modul 2
rememberToken, timestamps
```
**Catatan:** TIDAK ada kolom `status_akun` enum, TIDAK ada soft delete.

### Tabel `lowongan`
```php
id, id_pemberi_kerja (FK users),
judul, nama_perusahaan (nullable),
lokasi, latitude, longitude,
upah, satuan_upah enum('harian','borongan'),
kategori STRING BEBAS,   -- ⚠️ AKAN DIGANTI jadi FK, lihat Modul 1
deskripsi, kuota_pekerja,
status enum('dibuka','ditutup') default 'dibuka',
timestamps
```
**Catatan:** kategori masih string bebas (bukan foreign key). 8 nilai yang dipakai saat ini: `Pertukangan, ART, Buruh Harian, Supir, Security, Tukang Kebun, Laundry, Lainnya` — hardcoded di 3 file blade berbeda (lihat Modul 1). TIDAK ada field moderasi admin.

### Tabel `kontrak`
```php
id, id_lamaran (FK lamaran, unique),
status enum('berlangsung','selesai','dibayar','sengketa') default 'berlangsung',
bukti_transfer (nullable, path file),
dikonfirmasi_pencari_kerja boolean default false,
dikonfirmasi_pemberi_kerja boolean default false,
selesai_pada, dibayar_pada (nullable timestamps),
timestamps
```
**Catatan:** TIDAK ada kolom `catatan_admin`. TIDAK ada status `dibatalkan`.

### Mekanisme Sengketa yang SUDAH ADA (`app/Services/KontrakService.php`)
```php
public function ajukanSengketa(Kontrak $kontrak): Kontrak
{
    // Hanya bisa dari status 'selesai' atau 'dibayar'
    // Update status jadi 'sengketa'
    // Kirim notifikasi ke Pemberi Kerja (pemilik lowongan)
    // Kirim notifikasi ke SEMUA admin (User::admin()->get()), 
    //   link saat ini ke route('admin.dashboard') — PERLU DIARAHKAN 
    //   ke halaman sengketa admin yang baru nanti
}
```
**PENTING:** Sengketa **satu arah** — hanya Pencari Kerja yang bisa mengajukan (route `pencari-kerja.kontrak.sengketa`). Tidak ada tombol sengketa di sisi Pemberi Kerja.

### Sistem Notifikasi yang sudah ada
Tabel `notifikasi` sudah ada dan dipakai (persisted, bukan query on-the-fly), dengan pola:
```php
Notifikasi::create([
    'user_id' => $target->id,
    'tipe' => 'kontrak' | 'sengketa' | dst,
    'judul' => '...',
    'pesan' => '...',
    'link' => route(...),
    'data' => ['kontrak_id' => $kontrak->id],
]);
```
Badge unread count sudah ada di sidebar. Pola ini harus **diikuti** untuk semua notifikasi baru yang ditambahkan modul Admin.

---

## 4. Kerangka 5 Modul Admin (Final — Siap Eksekusi)

> **Urutan eksekusi WAJIB berurutan** — selesai + test satu modul dulu, baru pindah ke modul berikutnya. Jangan loncat.

### Modul 1 — Kelola Kategori
**Tujuan:** Kategori lowongan yang tadinya string bebas jadi data master terkelola.

**Migration:**
- `create_kategori_table`: `id`, `nama` (unique), timestamps
- `add_kategori_id_to_lowongan_table`: tambah `kategori_id` (nullable dulu, FK ke `kategori`, `onDelete('restrict')`)
- Migration/seeder backfill: isi 8 kategori existing ke tabel baru, lalu `UPDATE lowongan SET kategori_id = ...` berdasarkan mapping nama, baru ubah `kategori_id` jadi `NOT NULL` dan **drop kolom `kategori` (string) lama**

**Model baru:** `Kategori` — `hasMany(Lowongan::class)`
**Model `Lowongan`:** tambah `belongsTo(Kategori::class)`, update `$fillable`

**File existing yang WAJIB disesuaikan** (karena kategori pindah dari string ke relasi):
1. `resources/views/pemberi-kerja/lowongan/create.blade.php` — dropdown kategori dari array hardcoded `$kategoriList` → dari data kategori DB (dikirim Controller), `value` dari nama jadi `id`
2. `resources/views/pemberi-kerja/lowongan/edit.blade.php` — sama seperti create, plus `old('kategori', $lowongan->kategori)` → `old('kategori_id', $lowongan->kategori_id)`
3. `resources/views/pencari-kerja/lowongan/index.blade.php` — filter tombol kategori, sumber data + query filter Controller berubah dari `where('kategori', $kat)` → `where('kategori_id', $id)`
4. `resources/views/pencari-kerja/lowongan/show.blade.php` — `{{ $lowongan->kategori }}` → `{{ $lowongan->kategori->nama }}`
5. `LowonganController` di **kedua role** (Pemberi Kerja & Pencari Kerja) — kirim data kategori dari `Kategori::all()`, validasi `kategori_id` (bukan `kategori` string)

**Admin baru:**
- Controller: `Admin\KategoriController` — CRUD standar (index, store, update, destroy)
- Destroy digrouped: tolak hapus kalau `kategori->lowongan()->count() > 0` (guard di Service, pesan jelas lewat SweetAlert, bukan error DB mentah)
- Route: `admin/kategori` (resource standar)

---

### Modul 2 — Kelola User
**Tujuan:** Admin bisa lihat semua user & kontrol status akses.

**Migration:**
- `add_status_akun_to_users_table`: tambah `status_akun` enum(`aktif`,`nonaktif`,`banned`) default `aktif`
- Drop kolom `status_aktif` (boolean) lama — **⚠️ cek dulu apakah kolom ini sudah dipakai di kode manapun sebelum drop, supaya tidak error "column not found"**

**Middleware baru:** `CekStatusAkun`
- Dicek saat **proses login** (bukan tiap request)
- Kalau `status_akun != 'aktif'` → gagal login, pesan beda per status:
  - `nonaktif` → "Akun Anda dinonaktifkan, hubungi admin"
  - `banned` → "Akun Anda diblokir karena pelanggaran"
- Dipasang di `AuthController` (proses login existing)

**Admin baru:**
- Controller: `Admin\PenggunaController`
  - `index()` — filter role + status + search nama/email, pakai DataTables
  - `show($id)` — detail user + **ringkasan aktivitas sesuai role**:
    - Pemberi Kerja: jumlah lowongan diposting, jumlah lowongan aktif, jumlah kontrak
    - Pencari Kerja: jumlah lamaran, jumlah kontrak (berjalan/selesai)
  - `updateStatus($id)` — ubah `status_akun`
- Service: `Admin\PenggunaService::ubahStatus($user, $statusBaru)`
  - **GUARD WAJIB:** tolak kalau target `role = admin` (baik di UI disable tombol, maupun validasi backend — jangan cuma andalkan UI)
  - Trigger notifikasi ke user bersangkutan saat status diubah, pesan beda per status baru
- Route: `admin/pengguna`

---

### Modul 3 — Kelola Lowongan
**Tujuan:** Admin bisa moderasi lowongan (flag/nonaktifkan) tanpa bisa edit/hapus data milik Pemberi Kerja.

**Migration:**
- `add_moderasi_ke_lowongan_table`: tambah `dinonaktifkan_admin` (boolean, default `false`) + `alasan_nonaktif` (text, nullable)
- **SENGAJA terpisah** dari kolom `status` (dibuka/ditutup) operasional — supaya Pemberi Kerja tidak bisa override tindakan Admin lewat halaman edit miliknya sendiri

**Business rule:** Flag Admin **HANYA blokir lamaran baru** — TIDAK mengganggu kontrak yang sudah berjalan terkait lowongan tersebut.

**Model `Lowongan`:** tambah scope baru
```php
public function scopeTampil($query)
{
    return $query->where('status', 'dibuka')->where('dinonaktifkan_admin', false);
}
```
Dipakai di query listing pencarian Pencari Kerja (Controller, bukan cuma disembunyikan di view).

**File existing yang perlu disesuaikan:**
- `resources/views/pencari-kerja/lowongan/show.blade.php` — tambah kondisi `dinonaktifkan_admin` di cek boleh-lamar-atau-tidak:
```php
@elseif ($lowongan->status !== 'dibuka' || $lowongan->sisa_kuota <= 0 || $lowongan->dinonaktifkan_admin)
```

**Admin baru:**
- Controller: `Admin\LowonganController` — **read-only** + 1 aksi toggle flag (TIDAK ADA create/edit/delete)
  - `index()` — list semua lowongan lintas Pemberi Kerja
  - `show($id)` — detail
  - `toggleFlag($id)` — PATCH
- Service: `Admin\LowonganService::toggleFlag($lowongan, $alasan)`
  - Set `dinonaktifkan_admin` + `alasan_nonaktif`
  - Trigger notifikasi ke Pemberi Kerja pemilik lowongan (beri tahu alasan)
- Route: `admin/lowongan`

---

### Modul 4 — Kelola Laporan (paling kompleks, 2 sumber data)

**Bagian A — Sengketa Kontrak** (baca data existing, TIDAK perlu tabel baru)

Mekanisme `ajukanSengketa()` **sudah ada dan lengkap** (lihat section 3). Admin tinggal bangun halaman untuk menindaklanjuti.

**Migration tambahan:**
- `add_catatan_admin_to_kontrak_table`: tambah `catatan_admin` (text, nullable) — jejak keputusan admin

**Business rule penyelesaian sengketa:**
- Admin **pilih manual** hasil akhir, tapi enum kontrak cuma `['berlangsung','selesai','dibayar','sengketa']` — jadi hanya **2 opsi valid**:
  - `selesai` → kembalikan ke status sebelum sengketa (pembayaran dianggap belum sah)
  - `dibayar` → admin putuskan pembayaran sah, kontrak tuntas
- **TIDAK ADA status `dibatalkan`** — jangan tambahkan kecuali benar-benar dibutuhkan (belum dikonfirmasi perlu)

**Admin baru:**
- Service: `Admin\SengketaService::selesaikan($kontrak, $statusAkhir, $catatanAdmin)`
  - Validasi `$kontrak->status === 'sengketa'`
  - Update status + simpan `catatan_admin`
  - Kirim notifikasi ke **kedua pihak** (Pemberi Kerja & Pencari Kerja)
- Route: `admin/laporan/sengketa` (index), `admin/laporan/sengketa/{kontrak}` (show + selesaikan)

**Bagian B — Laporan User Baru** (fitur baru)

**Business rule:** Hanya bisa lapor **lawan transaksi dalam kontrak aktif** (bukan lapor sembarang user). Tombol "Laporkan" muncul di halaman detail kontrak, terlihat oleh **kedua role** (Pencari Kerja & Pemberi Kerja) — karena kontrak dua arah meski sengketa cuma satu arah.

**Migration:**
- `create_laporan_table`:
```php
id,
pelapor_id (FK users),
terlapor_id (FK users),
kontrak_id (FK kontrak),
kategori_laporan (string/enum: penipuan, tidak_profesional, pelanggaran_kesepakatan, lainnya),
deskripsi (text),
status enum('menunggu','diproses','selesai','ditolak') default 'menunggu',
catatan_admin (text, nullable),
timestamps
```

**Admin baru:**
- Controller: `Admin\LaporanController`
  - `index()` — 2 tab dalam 1 halaman: **Sengketa Kontrak** | **Laporan User** (query terpisah, tampilan terpisah — skema data beda)
  - `show($id)` — detail laporan + aksi proses/tolak/selesai
- Route: `admin/laporan` (index 2-tab), `admin/laporan/{laporan}` (show)

---

### Modul 5 — Dashboard Admin (terakhir, baca-saja/agregat)

**Tidak ada migration/tabel baru** — murni query agregat dari 4 modul sebelumnya.

**Kartu Statistik:**
| Kartu | Sumber |
|---|---|
| Total User | `User::count()`, breakdown per role |
| Total Lowongan | `Lowongan::count()`, breakdown status + dinonaktifkan_admin |
| Total Kontrak | `Kontrak::count()`, breakdown per status |
| Total Laporan | Sengketa (`Kontrak::where('status','sengketa')->count()`) + Laporan User (`Laporan::count()`) — ditampilkan **terpisah**, jangan digabung jadi 1 angka (skema data beda) |

**Grafik (Chart.js, maksimal 2):**
1. Lowongan dibuat per bulan (bar chart)
2. Distribusi status kontrak (donut chart)

**Aktivitas Terbaru:** 3 card terpisah berdampingan (bukan 1 list gabungan):
1. User baru register (5 terbaru)
2. Lowongan baru dibuat (5 terbaru)
3. Sengketa/Laporan baru masuk (5 terbaru) — kasih aksen visual beda (misal border merah tipis), karena prioritas butuh tindakan admin

**Shortcut/tombol:** kartu statistik yang relevan (misal "Sengketa Menunggu: X") klik langsung ke halaman terkait (`admin/laporan/sengketa`).

Route: `admin/dashboard` (ganti yang dummy sekarang)

---

## 5. Struktur Views (acuan folder, dari DESIGN.md)