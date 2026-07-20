<div align="center">

# 🎬 MediaVerse
### Platform Katalog Film, Series & Anime Terintegrasi — UAS Pemrograman Web 2

![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap&logoColor=white)
![Breeze](https://img.shields.io/badge/Auth-Laravel%20Breeze-FF2D20?logo=laravel&logoColor=white)
![License](https://img.shields.io/badge/Tugas%20Kuliah-UAS%20P.%20Web%202-8B5CF6?style=flat-square)

![MediaVerse Landing Page](docs/screenshots/landing%20page.png)

</div>

---

## 📌 Daftar Isi

- [Tentang Project](#-tentang-project)
- [Screenshot](#-screenshot)
- [Fitur Utama per Role](#-fitur-utama-per-role)
- [Tabel Role & Hak Akses](#-tabel-role--hak-akses)
- [Tech Stack](#️-tech-stack)
- [Struktur Database](#️-struktur-database)
- [Prerequisites](#-prerequisites)
- [Instalasi & Menjalankan Secara Lokal](#-instalasi--menjalankan-secara-lokal)
- [Akun Default (Seeder)](#-akun-default-seeder)
- [Cara Pakai](#-cara-pakai)
- [Struktur Folder Penting](#-struktur-folder-penting)
- [Keamanan](#-keamanan)
- [Testing](#-testing)
- [Deployment](#-deployment)
- [Roadmap](#-roadmap)
- [Dokumentasi Tambahan](#-dokumentasi-tambahan)
- [Penggunaan AI](#-penggunaan-ai)
- [Acknowledgments](#-acknowledgments)
- [Penyusun & Kontak](#-penyusun--kontak)
- [Lisensi](#-lisensi)

---

## 📖 Tentang Project

### Latar Belakang Masalah
Penggemar tontonan visual selama ini harus berpindah-pindah platform yang terpisah untuk masing-masing kategori — satu platform untuk film, platform lain untuk anime, dan platform lain lagi untuk series — sehingga pengalaman mencatat tontonan, memberi rating, dan menulis review menjadi terfragmentasi.

### Target pengguna
**MediaVerse** hadir sebagai satu platform terintegrasi yang mewadahi ketiga kategori tersebut (Film, TV Series, dan Anime) sekaligus, lengkap dengan fitur **watchlist**, **favorite**, dan **review** pengguna — ditargetkan untuk mahasiswa dan pecinta film/series/anime yang menginginkan satu platform terpadu untuk menelusuri katalog, mencatat tontonan, serta berbagi rating dan review lintas kategori media.

Project ini dikembangkan sebagai submisi **UAS Mata Kuliah Pemrograman Web 2**, dibangun dari nol mengikuti alur kerja terstruktur mulai dari Discovery, Product Design, Database Design, Backend Architecture, Frontend, Feature Development, Testing, UI Polish, hingga Deployment.

---

## 📸 Screenshot

> Screenshot di bawah menunjukkan tema visual **Dark Cinematic** dengan aksen warna emas (gold) yang konsisten di seluruh halaman.

<details>
<summary><b>Klik untuk melihat semua screenshot</b></summary>

<br>

### Login & Register
_Background langit sore, form dengan aksen navy & emas_
![Login/Register](docs/screenshots/login%20register.png)

### Detail Media
_Sinopsis, rating, tombol Watchlist/Favorite, dan daftar review — inti fitur aplikasi_
![Detail Media](docs/screenshots/detail%20media.png)

### Dashboard User
_Avatar profil, watchlist terbaru, favorite carousel, review terakhir, dan kolom komentar_
![Dashboard User](docs/screenshots/dashboard%20user.png)

### Dashboard Admin
_Statistik total media/user/review, sidebar navigasi ke seluruh modul manajemen_
![Dashboard Admin](docs/screenshots/dashboard%20admin.png)

</details>

---

## ✨ Fitur Utama per Role

### 👤 Guest (Belum Login)
- Lihat Beranda dengan carousel **Trending** (10 judul, berdasarkan jumlah watchlist & rata-rata rating)
- Jelajah & cari katalog media (search judul, filter tipe, filter genre, pagination)
- Lihat Detail Media (sinopsis, studio, genre, rating, seluruh review)
- Diarahkan ke Login/Register saat mencoba Watchlist/Favorite/Review/Komentar

### 🙋 User (Terdaftar)
Semua hak Guest, ditambah:
- Registrasi, Login/Logout, reset & ubah password
- Kelola profil (nama, email), hapus akun sendiri (wajib konfirmasi ulang password)
- Upload foto profil (avatar), auto-fit ke card profil
- Tambah/hapus Watchlist & Favorite (toggle satu tombol)
- Tulis, perbarui, dan hapus review (rating 1–10 + teks) — 1 review aktif per user per media
- Dashboard pribadi: avatar, 3 watchlist terbaru, seluruh favorite (carousel jika >10 judul), 3 review terakhir
- Lihat profil publik user lain (`/u/{user}`) dan tinggalkan komentar (guestbook)

### 🛠️ Admin
Semua hak User, ditambah:
- Akses Dashboard Admin (sidebar navigasi terpisah)
- CRUD Media (termasuk upload poster, penentuan studio & genre)
- CRUD Genre
- CRUD Studio
- Lihat statistik: total media, total user, total review, 5 review terbaru platform

### 👑 Absolute Admin (Super Admin)
Semua hak Admin, ditambah:
- Manajemen User: menaikkan/menurunkan role User ↔ Admin
- Mengaktifkan/menonaktifkan akun user/admin lain
- Akun Absolute Admin sendiri **tidak dapat diubah oleh siapa pun** lewat UI (safety rule, hanya bisa dibuat lewat seeder)

---

## 🔐 Tabel Role & Hak Akses

| Fitur | Guest | User | Admin | Absolute Admin |
|---|:---:|:---:|:---:|:---:|
| Browse & Search Media | ✅ | ✅ | ✅ | ✅ |
| Lihat Detail Media & Review | ✅ | ✅ | ✅ | ✅ |
| Watchlist / Favorite | ❌ | ✅ | ✅ | ✅ |
| Tulis / Edit / Hapus Review | ❌ | ✅ | ✅ | ✅ |
| Upload Avatar & Kelola Profil | ❌ | ✅ | ✅ | ✅ |
| Komentar Profil User Lain | ❌ | ✅ | ✅ | ✅ |
| Akses Dashboard Admin | ❌ | ❌ | ✅ | ✅ |
| CRUD Media / Genre / Studio | ❌ | ❌ | ✅ | ✅ |
| Manajemen Role & Status User | ❌ | ❌ | ❌ | ✅ |
| Diubah/dinonaktifkan pihak lain | — | ✅ (oleh Absolute Admin) | ✅ (oleh Absolute Admin) | ❌ (terkunci) |

---

## ⚙️ Tech Stack

| Kategori | Teknologi |
|---|---|
| Backend | Laravel 13 (PHP 8.3) |
| Frontend | Blade Templating, Bootstrap 5.3.3 (CDN), TailwindCSS, Alpine.js |
| Build Tool | Vite |
| Database | MySQL 8.0 |
| Autentikasi | Laravel Breeze (session-based) |
| Testing | PHPUnit (Laravel Feature Test) |
| Local Dev | Laragon (Nginx + PHP 8.3 + MySQL) |
| Containerization | Docker (untuk deployment) |

---

## 🗄️ Struktur Database

MediaVerse terdiri dari **9 tabel inti** yang saling berelasi:

| Tabel | Fungsi |
|---|---|
| `users` | Identitas akun, password (hashed), role (`user`/`admin`/`absolute_admin`), status aktif, avatar |
| `studios` | Data studio/rumah produksi media |
| `genres` | Data genre media |
| `media` | Judul film/series/anime: judul, slug, tipe, sinopsis, tahun rilis, poster, studio terkait |
| `media_genres` | Tabel pivot relasi many-to-many antara `media` dan `genres` |
| `reviews` | Rating (1–10) & teks review milik user untuk suatu media (1 review per user per media) |
| `watchlists` | Daftar media yang ingin ditonton user (1 baris per user per media) |
| `favorites` | Daftar media favorit user (1 baris per user per media) |
| `profile_comments` | Komentar antar-user di halaman profil (`profile_user_id` = pemilik profil, `commenter_id` = penulis komentar) |

Diagram ERD lengkap tersedia di [`docs/PRD Final - MediaVerse.pdf`](docs/PRD%20Final%20-%20MediaVerse.pdf).

---

## 📋 Prerequisites

Pastikan sudah terpasang sebelum instalasi:

- **PHP** 8.3 atau lebih baru, dengan ekstensi `pdo_mysql`, `mbstring`, `fileinfo`, `gd`
- **Composer** 2.x
- **Node.js** 20+ dan **npm**
- **MySQL** 8.0+
- Web server lokal (disarankan **Laragon** untuk Windows, atau setara seperti XAMPP/Valet)

---

## 🚀 Instalasi & Menjalankan Secara Lokal

```bash
# 1. Clone repository
git clone https://github.com/AbdHyi/MediaVerse.git
cd MediaVerse

# 2. Install dependency PHP
composer install

# 3. Install dependency Node & build asset
npm install
npm run build

# 4. Salin file environment
cp .env.example .env
php artisan key:generate
```

Edit `.env`, sesuaikan koneksi database (default Laragon: user `root`, password kosong):

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mediaverse
DB_USERNAME=root
DB_PASSWORD=
```

```bash
# 5. Buat database kosong (via HeidiSQL/phpMyAdmin, atau CLI):
mysql -u root -e "CREATE DATABASE mediaverse;"

# 6. Jalankan migration & seeder
php artisan migrate --seed

# 7. WAJIB — buat symbolic link storage
# (tanpa ini, avatar & poster upload tidak akan tampil di browser)
php artisan storage:link

# 8. Jalankan server lokal
php artisan serve
```

Buka `http://127.0.0.1:8000` di browser.

> **Catatan storage:link:** kalau di Windows `php artisan storage:link` gagal karena izin akses, jalankan terminal **sebagai Administrator** — symbolic link butuh hak akses elevated di Windows.

---

## 🔑 Akun Default (Seeder)

Seeder `AbsoluteAdminSeeder` otomatis membuat 1 akun Absolute Admin untuk keperluan development/testing:

| Field | Nilai |
|---|---|
| Email | `admin@mediaverse.test` |
| Password | `Admin123!` |

> ⚠️ **Penting:** ini akun development, bukan akun produksi. **Wajib diganti password-nya** (atau buat akun baru & hapus seeder ini) sebelum aplikasi go-public / dideploy untuk penggunaan nyata.

---

## 🖱️ Cara Pakai

1. **Sebagai pengunjung baru** — buka Beranda, jelajahi Trending atau klik "Mulai Jelajahi" untuk browse seluruh katalog. Gunakan search bar dan filter tipe/genre untuk mempersempit hasil.
2. **Daftar akun** lewat halaman Register, lalu login.
3. Buka **Detail Media** mana pun → klik tombol **Watchlist**/**Favorite** untuk menyimpan, atau isi rating + tulis review di bagian bawah halaman.
4. Klik nama profil di navbar → **Dashboard** untuk melihat ringkasan aktivitas sendiri (watchlist terbaru, favorite, review, dan upload foto profil).
5. Kunjungi `/u/{nama-user-lain}` untuk melihat profil publik user lain dan tinggalkan komentar.
6. **Login sebagai Admin/Absolute Admin** (lihat [Akun Default](#-akun-default-seeder)) untuk mengakses Dashboard Admin dari dropdown profil → kelola Media, Genre, Studio, dan (khusus Absolute Admin) Manajemen User.

---

## 📂 Struktur Folder Penting

```
MediaVerse/
├── docs/                        # PRD, ERD, screenshot dokumentasi
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/           # CRUD Media, Genre, Studio, User Management
│   │   │   └── Auth/            # Breeze auth controllers
│   │   ├── Middleware/
│   │   │   ├── CheckRole.php            # Middleware role fleksibel (role:admin,absolute_admin)
│   │   │   └── EnsureUserIsActive.php   # Paksa logout akun nonaktif
│   │   └── Requests/            # Form Request validasi
│   └── Models/                  # User, Media, Genre, Studio, Review, Watchlist, Favorite, ProfileComment
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── AbsoluteAdminSeeder.php
│       └── DummyMediaSeeder.php
├── resources/views/
│   ├── admin/                   # View CRUD & dashboard admin
│   ├── auth/                    # Login, Register (Breeze)
│   ├── components/              # Blade component reusable (media-card, layouts, dll)
│   ├── media/                   # Browse & Detail Media
│   └── profile/                 # Dashboard user & profil publik
├── routes/web.php
├── tests/Feature/                # Test fungsional (Auth, Access Control, Review, dll)
├── public/css/theme.css         # Design system Dark Cinematic
├── Dockerfile                   # Untuk deployment (Railway)
└── railway.json
```

---

## 🔒 Keamanan

- Password di-hash menggunakan **bcrypt** (Laravel `hashed` cast), tidak pernah disimpan/ditampilkan plain text
- **CSRF protection** pada seluruh form (`VerifyCsrfToken` middleware)
- **Validasi server-side** pada setiap request (Form Request class), termasuk validasi tipe & ukuran file upload (avatar, poster)
- **Mass assignment protection**: kolom `role` dan `is_active` sengaja dikecualikan dari `$fillable` pada model `User` — hanya bisa diubah lewat modul Admin, bukan dari input user biasa
- **Role-based access control** lewat middleware custom `CheckRole`, dengan 3 lapis pengecekan: status login → status akun aktif → kecocokan role
- Middleware `EnsureUserIsActive` memaksa logout otomatis jika akun dinonaktifkan admin saat sesi user masih berjalan
- Konfirmasi ulang password diwajibkan sebelum penghapusan akun

---

## 🧪 Testing

Jalankan seluruh test suite:

```bash
php artisan test
```

Cakupan test yang tersedia di `tests/Feature/`:
- Autentikasi (register, login, reset password, verifikasi email)
- Access Control regression (role & middleware)
- Validasi review (rating range, unique per user)
- Keunikan judul media (admin)
- Favorite & Profile

---

## ☁️ Deployment

- **Repository GitHub**: [github.com/AbdHyi/MediaVerse](https://github.com/AbdHyi/MediaVerse) — riwayat commit lengkap tersedia
- **Live Deployment (Railway)**: 🚧 *Coming Soon* — konfigurasi (`Dockerfile`, `docker/entrypoint.sh`, `railway.json`) sudah disiapkan, masih dalam tahap troubleshooting konfigurasi environment. Panduan lengkap tersedia di [`DEPLOY_RAILWAY.md`](DEPLOY_RAILWAY.md).

---

## 🗺️ Roadmap

- [ ] Live deployment ke Railway (konfigurasi sudah siap, tinggal troubleshoot)
- [ ] Moderasi review oleh Admin
- [ ] Sistem notifikasi like/comment pada review
- [ ] REST API publik (Laravel Sanctum)

---

## 📚 Dokumentasi Tambahan

- [PRD Final - MediaVerse (PDF)](docs/PRD%20Final%20-%20MediaVerse.pdf) — Project Overview, User Flow, Functional Requirements, ERD lengkap
- [Query MediaVerse (SQL)](docs/Query%20MediaVerse.sql) — dump struktur database
- [Laporan UAS Pemrograman Web 2](<docs/[UAS P. Web 2] MediaVerse - Abdul Hayyi - 2410010612 - 4D TI Reg. Banjarbaru.pdf>)

---

## 🤖 Penggunaan AI

Dalam proses pengembangan MediaVerse, AI (GenAI/LLM) dimanfaatkan pada tiga tahap berbeda dengan peran spesifik:

- **Tahap Awal — ChatGPT**: brainstorming ide, menyusun rancangan PRD awal, serta membahas dan menentukan fitur-fitur aplikasi sebelum masuk ke tahap produksi.
- **Tahap Menengah — Claude AI (Sonnet 5)**: asisten utama dalam pelaksanaan pembangunan aplikasi — pengembangan backend & frontend, troubleshooting, code review, penanganan struktur database, hingga proses deployment.
- **Tahap Akhir — Gemini (Pro 3.1)**: berperan sebagai "penasihat" untuk meninjau ulang dokumen PRD, serta memberikan review akhir terhadap struktur project sebagai polesan (finishing touch) sebelum pengumpulan.

Meskipun dibantu AI pada setiap tahap, seluruh alur logika, arsitektur sistem, dan validitas kode tetap dipahami dan diverifikasi sendiri oleh pengembang — AI digunakan murni sebagai alat bantu untuk mempercepat proses, bukan sebagai pengganti pemahaman terhadap kode yang dibangun.

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) & [Laravel Breeze](https://laravel.com/docs/starter-kits#breeze) — framework & starter kit autentikasi
- [Bootstrap](https://getbootstrap.com) — UI framework
- [Unsplash](https://unsplash.com) — foto latar (background auth & dashboard bertema langit/galaksi)
- [Google Fonts — Figtree](https://fonts.google.com/specimen/Figtree) — tipografi

---

## 👤 Penyusun & Kontak

| | |
|---|---|
| **Nama** | Abdul Hayyi |
| **NIM** | 2410010612 |
| **Kelas** | 4D TI Reg. Banjarbaru |
| **Mata Kuliah** | Pemrograman Web 2 (UAS) |
| **GitHub** | [@AbdHyi](https://github.com/AbdHyi) |

---

## 📄 Lisensi

Project ini dibuat untuk memenuhi tugas **Ujian Akhir Semester (UAS) Mata Kuliah Pemrograman Web 2** — Program Studi Teknik Informatika.

<div align="center">

Dibuat dengan 🎬 semangat menonton & 💻 banyak secangkir kopi

</div>
