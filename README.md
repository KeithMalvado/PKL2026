## 📌 Project Overview

| Informasi | Detail |
|---|---|
| Project Name | PKL2026 |
| Application Type | Web-Based Information System |
| Project Category | Complaint Management System |
| Development Status | Ongoing |
| Current Branch | `fitur-workflow-pengaduan` |
| Repository | [KeithMalvado/PKL2026](https://github.com/KeithMalvado/PKL2026) |

### 🎯 Project Objectives

1. Menyediakan sarana pengaduan publik yang terstruktur dan mudah diakses.
2. Memusatkan pengelolaan data pengaduan dalam satu sistem.
3. Menerapkan autentikasi dan pembagian hak akses berdasarkan peran pengguna.
4. Mengorganisasi proses penanganan pengaduan melalui workflow administratif.
5. Mempermudah pengawasan dan pemantauan aktivitas pengaduan melalui dashboard.
6. Mendukung pengelolaan informasi dan konten melalui modul CMS.

---

## ✨ Key Features

### 1. 📝 Public Complaint Module

Modul yang menyediakan akses bagi masyarakat untuk menyampaikan pengaduan melalui sistem.

Ruang lingkup fungsional:

- Penyediaan halaman layanan pengaduan publik.
- Pencatatan informasi pengaduan.
- Pengelolaan data laporan yang dikirimkan pengguna.
- Integrasi laporan publik dengan proses pengelolaan administratif.

### 2. 🔐 Authentication & Role Management

Modul autentikasi dan manajemen hak akses untuk mengatur penggunaan sistem berdasarkan peran masing-masing pengguna.

Ruang lingkup fungsional:

- Autentikasi pengguna.
- Pengelolaan identitas dan akun pengguna.
- Pembagian role dan hak akses.
- Pembatasan akses terhadap modul berdasarkan kewenangan pengguna.

### 3. 🔄 Complaint Workflow Management

Modul pengelolaan alur kerja pengaduan yang berfokus pada proses administratif dan penanganan laporan.

Ruang lingkup fungsional:

- Pengelolaan data pengaduan oleh administrator.
- Pengorganisasian proses penanganan laporan.
- Pengelolaan tanggung jawab penanganan berdasarkan penugasan.
- Pemantauan perkembangan pengaduan.
- Pengelolaan proses administrasi pengaduan.

### 4. 📊 Admin Panel & CMS

Panel administrasi yang menjadi pusat pengelolaan sistem dan informasi.

Ruang lingkup fungsional:

- Pengelolaan data dan administrasi.
- Pengelolaan informasi sistem.
- Pengelolaan konten melalui CMS.
- Pemantauan data pengaduan.
- Pengelolaan kebutuhan operasional administrator.

---

## 👥 User Roles & Responsibilities

Sistem menggunakan konsep pembagian peran pengguna untuk memisahkan tanggung jawab dan kewenangan dalam pengoperasian aplikasi.

| Role | Deskripsi | Tanggung Jawab Utama |
|---|---|---|
| 👤 Pelapor / Masyarakat | Pengguna layanan publik | Menyampaikan pengaduan dan memperoleh informasi perkembangan laporan sesuai fasilitas yang tersedia. |
| 🛡️ Administrator | Pengelola sistem | Mengelola data, pengguna, administrasi, dan proses pengaduan. |
| 📋 PIC / Petugas | Penanggung jawab penanganan | Menindaklanjuti pengaduan sesuai penugasan dan kewenangannya. |

### 👤 Pelapor / Masyarakat

Berperan sebagai pihak yang menggunakan layanan pengaduan publik.

Fokus tanggung jawab:

- Mengakses layanan pengaduan.
- Menyampaikan informasi permasalahan.
- Mengirimkan laporan melalui sistem.
- Memperoleh informasi perkembangan laporan sesuai fasilitas yang tersedia.

### 🛡️ Administrator

Berperan sebagai pengelola utama operasional aplikasi.

Fokus tanggung jawab:

- Mengelola data pengaduan.
- Mengelola akun dan hak akses pengguna.
- Mengatur kebutuhan administrasi sistem.
- Mengawasi proses pengelolaan pengaduan.
- Mengelola informasi dan konten melalui CMS.

### 📋 PIC / Petugas

Berperan sebagai pihak yang bertanggung jawab terhadap tindak lanjut pengaduan.

Fokus tanggung jawab:

- Menerima tanggung jawab pengaduan sesuai penugasan.
- Melakukan tindak lanjut terhadap laporan.
- Memperbarui informasi penanganan sesuai kewenangan.
- Mendukung proses penyelesaian pengaduan.

---

## 🔑 Role-Based Access Control

Pembatasan akses dilakukan berdasarkan peran pengguna. Matriks berikut merupakan gambaran rancangan kewenangan dan harus disesuaikan dengan permission aktual aplikasi.

| Modul / Aktivitas | Pelapor | Administrator | PIC / Petugas |
|---|---|---|---|
| Pengajuan pengaduan | Mengajukan | Mengelola | — |
| Pengelolaan data pengaduan | Akses sesuai fasilitas | Mengelola | Sesuai penugasan |
| Manajemen pengguna | — | Mengelola | — |
| Workflow pengaduan | Memantau sesuai fasilitas | Mengelola | Menindaklanjuti |
| Penugasan PIC | — | Mengelola | Menerima penugasan |
| Administrasi CMS | — | Mengelola | — |
| Monitoring administrasi | — | Mengelola | Sesuai kewenangan |

---

## 🔄 Complaint Workflow

Workflow pengaduan merupakan mekanisme yang mengatur perjalanan laporan sejak disampaikan oleh masyarakat hingga melalui proses penanganan.

1. **Pengajuan Pengaduan** — Masyarakat menyampaikan laporan melalui modul pengaduan publik.
2. **Penerimaan Laporan** — Data laporan tersedia untuk dikelola pada sisi administrasi.
3. **Verifikasi dan Pengelolaan** — Administrator memeriksa dan mengelola laporan berdasarkan informasi yang disampaikan.
4. **Penugasan Penanganan** — Pengaduan diarahkan kepada PIC atau petugas yang bertanggung jawab.
5. **Proses Tindak Lanjut** — PIC atau petugas melakukan penanganan dan memperbarui informasi sesuai kewenangannya.
6. **Monitoring dan Penyelesaian** — Administrator memantau perkembangan laporan hingga proses penanganan diselesaikan sesuai prosedur.

> **Catatan:** Urutan status, mekanisme disposisi, aturan transisi status, dan otorisasi setiap tahapan harus mengikuti implementasi workflow aktual. Tahapan di atas merupakan gambaran konseptual, bukan klaim bahwa seluruh mekanisme telah tersedia.

---

## 🧩 System Modules

| Modul | Fungsi Utama | Pengguna Utama |
|---|---|---|
| Public Complaint | Layanan pengajuan pengaduan masyarakat | Pelapor |
| Authentication | Autentikasi pengguna | Seluruh pengguna |
| Role Management | Pengaturan peran dan hak akses | Administrator |
| Complaint Administration | Pengelolaan administratif laporan | Administrator |
| Complaint Workflow | Pengaturan proses penanganan pengaduan | Administrator / PIC |
| Admin Panel | Pusat administrasi dan monitoring | Administrator |
| CMS | Pengelolaan informasi dan konten aplikasi | Administrator |

---

## 📊 Dashboard & Administration

Dashboard administrasi merupakan bagian sistem yang ditujukan untuk membantu pengelola mengakses dan mengawasi informasi operasional.

Ruang lingkup dashboard:

- Akses informasi administratif.
- Pengelolaan data pengaduan.
- Pemantauan aktivitas pengelolaan laporan.
- Akses terhadap modul administrasi.
- Pengelolaan informasi dan konten sistem melalui CMS.

---

## 🛠️ Technology Stack

Teknologi harus dicantumkan berdasarkan dependensi dan konfigurasi aktual repository. Tabel berikut merupakan kerangka dokumentasi, bukan daftar teknologi yang sudah diverifikasi.

| Komponen | Teknologi | Keterangan |
|---|---|---|
| Backend | Perlu verifikasi | Periksa `composer.json` dan source code |
| Frontend | Perlu verifikasi | Periksa `package.json` dan direktori `resources` |
| Database | Perlu verifikasi | Periksa konfigurasi dan migration |
| Version Control | Git & GitHub | Pengelolaan versi source code |
| Development Environment | Local Development Environment | Lingkungan pengembangan lokal |

---

## 📁 Project Structure

Struktur berikut merupakan contoh struktur umum proyek Laravel. Sesuaikan dengan direktori yang benar-benar tersedia pada repository.

```text
PKL2026/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   └── Models/
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
│   ├── web.php
│   └── api.php
├── storage/
├── tests/
├── .env.example
├── artisan
├── composer.json
└── README.md
```

---

## 🚀 Installation & Setup

Panduan berikut ditujukan untuk proyek Laravel. Jalankan sesuai konfigurasi dan kebutuhan aktual aplikasi.

### 1. Clone Repository

```bash
git clone https://github.com/KeithMalvado/PKL2026.git
```

### 2. Masuk ke Direktori Project

```bash
cd PKL2026
```

### 3. Install Dependencies

```bash
composer install
```

### 4. Konfigurasi Environment

Salin file environment contoh:

```bash
cp .env.example .env
```

Sesuaikan konfigurasi database dan environment pada file `.env`.

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Jalankan Database Migration

Pastikan database sudah dibuat dan konfigurasi koneksi telah sesuai, kemudian jalankan:

```bash
php artisan migrate
```

### 7. Jalankan Aplikasi

```bash
php artisan serve
```

Aplikasi Laravel secara default dapat diakses melalui:

```text
http://127.0.0.1:8000
```

> **Penting:** Perintah instalasi di atas perlu disesuaikan jika proyek menggunakan konfigurasi tambahan, seeder, frontend build, atau layanan lain.

---

## 🔐 Security & Access Control

Keamanan sistem menjadi bagian penting dalam pengembangan aplikasi, khususnya dalam pengelolaan data pengaduan dan pembatasan akses.

Prinsip keamanan yang perlu diterapkan:

- **Authentication:** memastikan identitas pengguna sebelum mengakses area yang dilindungi.
- **Authorization:** membatasi fitur dan data berdasarkan role serta permission.
- **Input Validation:** memvalidasi data yang dikirimkan pengguna.
- **Access Restriction:** melindungi halaman dan endpoint administratif dari akses yang tidak berwenang.
- **Sensitive Configuration:** tidak menyimpan kredensial atau informasi rahasia ke dalam repository publik.
- **Data Responsibility:** membatasi pengelolaan data sesuai tanggung jawab pengguna.

---

## 🌿 Development & Contribution

Pengembangan repository menggunakan Git sebagai version control agar perubahan source code dapat dikelola secara terorganisasi.

### Development Branches

| Branch | Keterangan |
|---|---|
| `main` | Cabang utama repository |
| `fitur-workflow-pengaduan` | Cabang pengembangan workflow pengaduan |

### Contribution Workflow

1. Mengambil perubahan terbaru dari repository.
2. Membuat atau menggunakan branch sesuai kebutuhan fitur.
3. Mengembangkan dan menguji perubahan secara lokal.
4. Melakukan commit dengan pesan yang jelas.
5. Mengirimkan perubahan ke repository melalui push.
6. Melakukan review sebelum perubahan digabungkan ke branch utama.

Contoh perintah Git:

```bash
git checkout -b fitur-nama-fitur
git add .
git commit -m "feat: deskripsi perubahan"
git push origin fitur-nama-fitur
```

Gunakan nama branch dan pesan commit yang konsisten agar riwayat pengembangan mudah ditelusuri.

---

## 📌 Development Status

Proyek masih berada dalam tahap pengembangan. Implementasi modul dan penyempurnaan sistem dilakukan secara bertahap berdasarkan kebutuhan fungsional aplikasi.

Fokus pengembangan meliputi:

- Pengembangan layanan pengaduan publik.
- Penyempurnaan autentikasi dan manajemen role.
- Pengembangan workflow pengaduan administratif.
- Pengembangan panel administrator dan CMS.
- Integrasi antarmodul.
- Pengujian fungsional dan penyempurnaan sistem.

---

## 📄 License

Informasi lisensi dan ketentuan distribusi perangkat lunak mengikuti lisensi yang ditetapkan pada repository. Apabila belum tersedia, tentukan lisensi sebelum mendistribusikan proyek secara publik.

---

<div align="center">

**PKL2026 — Sistem Informasi Pengaduan**

*Structured Complaint Management · Administrative Workflow · Role-Based Access Control*

[Repository GitHub](https://github.com/KeithMalvado/PKL2026)

</div>

