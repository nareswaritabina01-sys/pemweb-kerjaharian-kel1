# 🎨 DESIGN DOCUMENT

> Dokumen ini menjadi acuan desain antarmuka (UI/UX) proyek **KerjaHarian** agar seluruh anggota tim memiliki standar desain yang sama selama proses pengembangan.

---

# 1. Filosofi Desain

KerjaHarian mengusung konsep **modern, sederhana, cepat, dan mudah digunakan**.

Target utama pengguna adalah masyarakat umum, sehingga antarmuka harus mudah dipahami tanpa membutuhkan pembelajaran yang rumit.

Prinsip desain:

- Bersih (Clean)
- Minimalis
- Mobile Friendly
- Konsisten
- Mudah dipahami
- Fokus pada pencarian pekerjaan

---

# 2. Identitas Visual

## Warna

| Nama           | Warna   | Kegunaan                   |
| -------------- | ------- | -------------------------- |
| Primary        | #0F766E | Tombol utama, navbar, link |
| Secondary      | #FBBF24 | Highlight, CTA             |
| Background     | #F8FAFC | Background halaman         |
| Surface        | #FFFFFF | Card                       |
| Success        | #22C55E | Berhasil                   |
| Warning        | #F59E0B | Peringatan                 |
| Danger         | #EF4444 | Error                      |
| Text           | #111827 | Teks utama                 |
| Text Secondary | #6B7280 | Subtitle                   |

---

## Font

Menggunakan:

- Plus Jakarta Sans

Fallback:

- sans-serif

---

## Icon

Menggunakan:

- Bootstrap Icons

Tidak menggunakan lebih dari satu library icon.

---

# 3. Layout

## Guest Layout

Digunakan untuk:

- Landing Page
- Login
- Register

---

## User Layout

Digunakan untuk:

- Dashboard
- Cari Kerja
- Profil
- Lamaran
- Kontrak

Memiliki:

- Navbar
- Sidebar
- Content
- Footer

---

## Admin Layout

Digunakan untuk halaman admin.

Memiliki:

- Sidebar
- Topbar
- Content
- Footer

---

# 4. Komponen

## Button

Primary

- Background Primary
- Text Putih

Secondary

- Background Putih
- Border Primary

Danger

- Background Merah

Success

- Background Hijau

Semua button menggunakan border radius 12px.

---

## Card

Semua card menggunakan:

- Border Radius 16px
- Shadow Soft
- Padding 20px

---

## Form Input

Menggunakan:

- Rounded
- Tinggi konsisten
- Label di atas input
- Validasi di bawah input

---

## Modal

Digunakan untuk:

- Konfirmasi Hapus
- Konfirmasi Pembayaran
- Logout

---

## Alert

Menggunakan SweetAlert2.

---

## Table

Digunakan pada:

- Admin
- Daftar Lowongan
- Daftar Pelamar

Menggunakan DataTables.

---

# 5. Halaman

## Landing Page

Komponen:

- Navbar
- Hero Section
- Search
- Popular Categories
- CTA
- Footer

---

## Login

Komponen:

- Logo
- Form Login
- Remember Me
- Lupa Password
- Tombol Login

---

## Register

Komponen:

- Form Register
- Upload Foto (Opsional)

---

## Dashboard Pencari Kerja

Menampilkan:

- Statistik
- Lowongan Terdekat
- Lamaran Aktif
- Riwayat
- Profil

---

## Dashboard Pemberi Kerja

Menampilkan:

- Statistik Lowongan
- Pelamar Terbaru
- Kontrak Aktif
- Pembayaran
- Riwayat

---

## Dashboard Admin

Menampilkan:

- Total User
- Total Lowongan
- Total Kontrak
- Total Laporan
- Grafik
- Aktivitas Terbaru

---

## Cari Kerja

Menampilkan:

- Search
- Filter
- Radius
- Peta
- Daftar Lowongan

---

## Detail Lowongan

Menampilkan:

- Informasi Lowongan
- Lokasi
- Maps
- Tombol Lamar

---

## Lamaran

Menampilkan:

- Status Lamaran
- Riwayat Lamaran

---

## Kontrak

Menampilkan:

- Detail Kontrak
- Status
- Pembayaran
- Review

---

## Pembayaran

Pemberi Kerja:

- Upload Bukti Transfer

Pencari Kerja:

- Konfirmasi Pembayaran

---

## Profil

Menampilkan:

- Informasi Akun
- Foto
- Edit Profil

---

# 6. Responsive

Desktop

≥ 1200px

Tablet

768px – 1199px

Mobile

≤ 767px

Semua halaman wajib responsive.

---

# 7. UX Rules

Loading

- Gunakan Spinner Bootstrap.

Delete

- Konfirmasi SweetAlert.

Submit

- Disable Button ketika loading.

Success

- SweetAlert Success.

Error

- SweetAlert Error.

Empty Data

- Tampilkan ilustrasi dan pesan.

---

# 8. Konsistensi

Semua halaman wajib:

- Menggunakan layout yang sama.
- Menggunakan warna yang sama.
- Menggunakan font yang sama.
- Menggunakan icon yang sama.
- Menggunakan spacing yang konsisten.

Tidak diperbolehkan membuat komponen baru apabila komponen yang sama sudah tersedia.

---

# 9. Struktur Views

```
resources/views/

├── admin/
│   ├── dashboard/
│   ├── pengguna/
│   ├── kategori/
│   ├── lowongan/
│   ├── laporan/
│
├── pemberi-kerja/
│   ├── dashboard/
│   ├── lowongan/
│   ├── pelamar/
│   ├── kontrak/
│   ├── pembayaran/
│
├── pencari-kerja/
│   ├── dashboard/
│   ├── cari-lowongan/
│   ├── lamaran/
│   ├── kontrak/
│   ├── pembayaran/
│   ├── profil/
│
├── auth/
├── components/
├── layouts/
├── landing/
└── errors/
```

---

# 10. Catatan

- Fokus pada kemudahan penggunaan.
- Hindari halaman yang terlalu ramai.
- Prioritaskan fungsi dibanding animasi.
- Semua desain harus mengikuti dokumen ini agar konsisten.

---

## Aturan Implementasi

- Gunakan Blade Components jika komponen digunakan lebih dari satu kali.
- Jangan menulis CSS inline.
- Gunakan Bootstrap Utility Class terlebih dahulu sebelum membuat CSS baru.
- Semua halaman harus menggunakan layout yang sesuai dengan role.
- Semua route harus menggunakan penamaan bahasa Indonesia.
- Semua controller, middleware, request, dan service menggunakan Bahasa Indonesia.
- Nama tabel database menggunakan Bahasa Indonesia (snake_case).
- Penamaan variabel tetap menggunakan camelCase agar mengikuti standar PHP/Laravel.
