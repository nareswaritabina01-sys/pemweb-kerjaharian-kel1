# 📋 TASK DOCUMENT

> Dokumen ini berisi aturan pengembangan proyek **KerjaHarian**.
> Seluruh anggota tim dan AI Assistant wajib mengikuti dokumen ini agar pengembangan tetap konsisten.

---

# Tujuan

Membangun Portal KerjaHarian menggunakan Laravel dengan fitur:

- Geolocation Radius
- Portal Lowongan Kerja Harian
- Konfirmasi Pembayaran
- Dashboard Admin
- Dashboard Pemberi Kerja
- Dashboard Pencari Kerja

Target:

- Kode bersih
- Mudah dipahami
- Mudah dipelihara
- Konsisten

---

# Aturan Umum

## Wajib

- Menggunakan Laravel 12
- Menggunakan Blade
- Menggunakan Bootstrap 5
- Menggunakan MySQL
- Menggunakan Bahasa Indonesia
- Menggunakan Clean Code
- Menggunakan MVC Laravel

---

## Tidak Boleh

- Inline CSS
- Inline JavaScript
- Query langsung di Blade
- Hardcode Data
- Duplikasi kode
- Mengubah struktur folder tanpa persetujuan tim

---

# Bahasa

Seluruh project menggunakan Bahasa Indonesia.

Contoh

Controller

```
LowonganController
```

Middleware

```
CekAdmin
```

Seeder

```
KategoriSeeder
```

Migration

```
create_lowongan_table
```

Model

```
Lowongan
```

View

```
lowongan/index.blade.php
```

---

# Struktur Folder

```
app/

Http/
    Controllers/
        Admin/
        PemberiKerja/
        PencariKerja/

Middleware/

Models/

Services/

Repositories/

resources/views/

admin/

pemberi-kerja/

pencari-kerja/

auth/

layouts/

components/
```

---

# Role

## Admin

Tugas

- Dashboard
- Kelola User
- Kelola Lowongan
- Kelola Kategori
- Kelola Laporan

---

## Pemberi Kerja

Tugas

- Dashboard
- CRUD Lowongan
- Melihat Pelamar
- Memilih Pelamar
- Upload Bukti Transfer
- Riwayat Kontrak

---

## Pencari Kerja

Tugas

- Dashboard
- Cari Lowongan
- Apply
- Kontrak
- Konfirmasi Pembayaran
- Review

---

# Sprint Development

## Sprint 1

Authentication

- Login
- Register
- Logout
- RBAC

Status

⬜

---

## Sprint 2

Admin

- Dashboard
- Kelola User
- Kelola Lowongan
- Kelola Kategori

Status

⬜

---

## Sprint 3

Pemberi Kerja

- Dashboard
- CRUD Lowongan
- Pelamar
- Kontrak

Status

⬜

---

## Sprint 4

Pencari Kerja

- Dashboard
- Cari Lowongan
- Radius
- Apply

Status

⬜

---

## Sprint 5

Pembayaran

- Upload Bukti
- Konfirmasi
- Review

Status

⬜

---

## Sprint 6

Finishing

- Responsive
- Testing
- Bug Fix
- Deployment

Status

⬜

---

# Prioritas Fitur

⭐⭐⭐⭐⭐

Authentication

⭐⭐⭐⭐⭐

Dashboard

⭐⭐⭐⭐⭐

CRUD Lowongan

⭐⭐⭐⭐⭐

Geolocation

⭐⭐⭐⭐⭐

Apply

⭐⭐⭐⭐⭐

Kontrak

⭐⭐⭐⭐⭐

Pembayaran

⭐⭐⭐⭐

Review

⭐⭐⭐⭐

Admin Dashboard

⭐⭐⭐

Notifikasi

⭐⭐

Pesan

⭐

Animasi

---

# Coding Standard

## Controller

Hanya berisi

- Validasi
- Memanggil Service
- Redirect

Tidak boleh berisi business logic panjang.

---

## Model

Berisi

- Relasi
- Scope
- Accessor
- Mutator

---

## Service

Berisi business logic.

---

## Request

Seluruh validasi menggunakan Form Request.

---

## Blade

Tidak boleh query database.

Tidak boleh business logic.

---

# Database

Gunakan Bahasa Indonesia.

Contoh

```
users

kategori

lowongan

lamaran

kontrak

ulasan

laporan
```

Gunakan foreign key.

Gunakan soft delete jika diperlukan.

---

# Penamaan Route

Gunakan Bahasa Indonesia.

Contoh

```
dashboard

profil

lowongan.index

lowongan.create

lowongan.store

lowongan.edit

lowongan.update

lowongan.destroy

lamaran.index

kontrak.index
```

---

# Git Workflow

Branch utama

```
main
```

Branch fitur

```
fitur-admin

fitur-lowongan

fitur-pencari-kerja

fitur-pembayaran
```

Commit

Gunakan format

```
feat:

fix:

refactor:

style:

docs:
```

Contoh

```
feat: menambahkan CRUD lowongan

fix: memperbaiki validasi login

docs: memperbarui PRD
```

---

# Definition of Done

Suatu fitur dianggap selesai apabila

- Berjalan tanpa error
- Responsive
- Validasi lengkap
- Menggunakan SweetAlert
- Mengikuti DESIGN.md
- Mengikuti PRD.md
- Sudah diuji manual

---

# Checklist Pengembangan

## Authentication

- [ ] Login
- [ ] Register
- [ ] Logout
- [ ] RBAC

---

## Admin

- [ ] Dashboard
- [ ] Kelola User
- [ ] Kelola Kategori
- [ ] Kelola Lowongan
- [ ] Kelola Laporan

---

## Pemberi Kerja

- [ ] Dashboard
- [ ] CRUD Lowongan
- [ ] Pelamar
- [ ] Kontrak
- [ ] Upload Bukti Transfer

---

## Pencari Kerja

- [ ] Dashboard
- [ ] Cari Lowongan
- [ ] Geolocation
- [ ] Radius
- [ ] Apply
- [ ] Kontrak
- [ ] Konfirmasi Pembayaran
- [ ] Review

---

## Finishing

- [ ] Responsive
- [ ] Testing
- [ ] Bug Fix
- [ ] Dokumentasi
- [ ] Presentasi

---

# Instruksi untuk AI Assistant

Jika membantu pengembangan proyek ini, AI harus mengikuti aturan berikut:

1. Selalu membaca PRD.md, DESIGN.md, dan TASK.md sebelum memberikan solusi.
2. Gunakan Bahasa Indonesia untuk nama controller, middleware, service, request, dan route.
3. Jangan mengubah arsitektur proyek tanpa persetujuan.
4. Ikuti struktur folder yang telah ditetapkan.
5. Gunakan Bootstrap 5 dan Blade sebagai standar antarmuka.
6. Hindari membuat fitur di luar ruang lingkup PRD.
7. Utamakan kode yang sederhana, mudah dipahami, dan konsisten daripada solusi yang terlalu kompleks.
8. Jika membuat migration, model, controller, atau view baru, pastikan penamaannya sesuai standar proyek.
9. Jika menemukan inkonsistensi antara PRD, DESIGN, dan implementasi, prioritaskan PRD lalu sesuaikan implementasi.
10. Berikan solusi yang siap digunakan dalam proyek Laravel tanpa mengubah teknologi yang telah dipilih.
