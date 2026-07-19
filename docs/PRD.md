# Product Requirements Document (PRD)

## Project Information

| Item         | Detail                          |
| ------------ | ------------------------------- |
| Project Name | KerjaHarian                     |
| Version      | 1.0                             |
| Status       | Development                     |
| Framework    | Laravel 13.18.0                 |
| Database     | MySQL                           |
| Team         | Kelompok UAS Pemrograman Web II |

---

# Executive Summary

KerjaHarian merupakan platform berbasis web yang menghubungkan pemberi kerja dengan pekerja harian berdasarkan lokasi geografis pengguna. Sistem memanfaatkan Geolocation API dan perhitungan radius menggunakan Haversine Formula sehingga pengguna dapat menemukan pekerjaan yang berada di sekitar lokasi mereka.

Selain pencarian pekerjaan berbasis lokasi, sistem menyediakan mekanisme konfirmasi pembayaran yang aman melalui proses unggah bukti transfer dan konfirmasi penerimaan pembayaran oleh pekerja.

---

# Problem Statement

Permasalahan yang ingin diselesaikan:

- Sulit mencari pekerja harian terdekat.
- Sulit menemukan pekerjaan harian di sekitar lokasi.
- Tidak adanya mekanisme konfirmasi pembayaran.
- Sulit mengetahui status pekerjaan secara real-time.

---

# Product Goals

Produk ini bertujuan untuk:

- Mempermudah pencarian pekerjaan harian.
- Mempermudah pencarian pekerja sekitar.
- Menampilkan pekerjaan berdasarkan radius lokasi.
- Menyediakan proses perekrutan yang sederhana.
- Menyediakan sistem konfirmasi pembayaran yang aman.

---

# Scope

## In Scope

- Authentication
- Role Management
- Dashboard
- CRUD Lowongan
- Geolocation
- Radius Search
- Apply Lowongan
- Kontrak Kerja
- Upload Bukti Transfer
- Konfirmasi Pembayaran
- Review
- Dashboard Admin

## Out of Scope

- Payment Gateway
- Chat
- Video Call
- QRIS
- Push Notification
- Mobile App

---

# Target Users

## User

Dapat menjadi:

- Pemberi Kerja
- Pekerja

Menggunakan satu akun.

## Admin

Mengelola seluruh sistem.

---

# User Roles

## User

Hak akses:

- Register
- Login
- Mengubah profil
- Membuat lowongan
- Mengelola lowongan
- Mencari pekerjaan
- Apply pekerjaan
- Melihat kontrak
- Upload bukti pembayaran (sebagai pemberi kerja)
- Konfirmasi pembayaran (sebagai pekerja)
- Memberikan review

---

## Admin

Hak akses:

- Kelola User
- Kelola Lowongan
- Monitoring Kontrak
- Monitoring Pembayaran
- Menangani Laporan
- Dashboard Statistik

---

# Functional Requirements

## Authentication

- Register
- Login
- Logout

---

## Vacancy Management

- Tambah Lowongan
- Edit Lowongan
- Hapus Lowongan
- Detail Lowongan

---

## Geolocation

- Mengambil lokasi pengguna
- Menampilkan marker
- Menghitung radius
- Menampilkan pekerjaan terdekat

---

## Recruitment

- Apply pekerjaan
- Menerima pelamar
- Menolak pelamar
- Membuat kontrak

---

## Payment Confirmation

- Upload bukti transfer
- Status menunggu konfirmasi
- Konfirmasi pembayaran
- Riwayat pembayaran

---

## Review

- Rating
- Komentar

---

# Non Functional Requirements

- Responsive
- Laravel Authentication
- Password Hashing
- Session Based Authentication
- Validasi Form
- CSRF Protection
- Database Relasional
- UI mudah digunakan

---

# User Journey

## Employer

Login

↓

Posting Lowongan

↓

Menunggu Pelamar

↓

Memilih Pekerja

↓

Kontrak

↓

Transfer Pembayaran

↓

Upload Bukti

↓

Pekerja Konfirmasi

↓

Review

---

## Worker

Login

↓

Aktifkan Lokasi

↓

Cari Lowongan

↓

Apply

↓

Diterima

↓

Mengerjakan Pekerjaan

↓

Konfirmasi Pembayaran

↓

Review

---

# Business Rules

1. User dapat menjadi pekerja maupun pemberi kerja.
2. User harus login.
3. Lowongan hanya dapat dilamar ketika status OPEN.
4. Radius default pencarian adalah 5 km.
5. Pekerjaan selesai setelah kedua pihak menyelesaikan proses.
6. Pembayaran dianggap selesai setelah pekerja mengonfirmasi bukti transfer.
7. Review hanya dapat diberikan setelah pekerjaan selesai.

---

# Database Overview

users

job_categories

vacancies

applications

contracts

reviews

reports

---

# MVP Features

Authentication

User Dashboard

CRUD Lowongan

Kategori

Maps

Geolocation

Radius Search

Apply Job

Accept Applicant

Contract

Payment Confirmation

Review

Admin Dashboard

---

# Tech Stack

Backend

- Laravel 12

Frontend

- Blade
- Bootstrap 5
- JavaScript

Database

- MySQL

Library

- LeafletJS
- OpenStreetMap
- SweetAlert2
- DataTables
- Chart.js

---

# Development Milestones

Sprint 1

Authentication

Database

RBAC

Sprint 2

Vacancy

Category

Maps

Sprint 3

Geolocation

Radius Search

Sprint 4

Recruitment

Contract

Sprint 5

Payment Confirmation

Review

Sprint 6

Admin Dashboard

Testing

Deployment

---

# Acceptance Criteria

Sistem dinyatakan selesai apabila:

- User dapat Register dan Login.
- User dapat membuat lowongan.
- User dapat mencari pekerjaan berdasarkan radius lokasi.
- User dapat melamar pekerjaan.
- Pemberi kerja dapat memilih pekerja.
- Kontrak berhasil dibuat.
- Pemberi kerja dapat mengunggah bukti transfer.
- Pekerja dapat mengonfirmasi pembayaran.
- Kedua pihak dapat memberikan review.
- Admin dapat memonitor seluruh aktivitas sistem.
