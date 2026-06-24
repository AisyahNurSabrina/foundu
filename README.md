# FoundU — Platform Lost & Found Mahasiswa Kampus

FoundU adalah platform berbasis web untuk membantu mahasiswa menemukan barang yang hilang di area kampus. Mahasiswa dapat melaporkan barang temuan, mencari barang miliknya, dan mengklaim barang. Admin bertugas memoderasi konten spam.

## Fitur Utama

### Autentikasi
- Register, Login, Logout, Forgot Password (Laravel Breeze)
- Validasi email domain kampus (`@mhs.unsoed.ac.id`)
- Password minimal 8 karakter
- Field WhatsApp pada registrasi

### Role & Otorisasi
- **Admin**: Kelola kategori, titik pengambilan, moderasi konten, dashboard statistik
- **Mahasiswa**: Lapor barang temuan, cari barang, tandai terklaim

### CRUD Barang Temuan (Items)
- Lapor barang temuan dengan foto, kategori, titik pengambilan
- Search by nama (LIKE query)
- Filter by kategori dan status
- Pagination 10 item per halaman
- Upload foto (JPG/JPEG/PNG, maks 2MB)
- SoftDeletes untuk penghapusan

### Klaim Barang
- Penemu bisa menandai barang sebagai "terklaim"
- Bukti/keterangan klaim dicatat

### Moderasi Admin
- Admin bisa menghapus (soft-delete) item spam
- Alasan penghapusan dicatat di tabel reports

### Kategori & Titik Pengambilan
- CRUD lengkap (khusus admin)
- Kategori: Elektronik, Dokumen, Aksesori, Lainnya
- Titik Pengambilan: Pos Gerbang Utama, Pos Fakultas A, Pos Perpustakaan

## Tech Stack

- **Backend**: Laravel 11 (PHP 8.2+)
- **Frontend**: Blade Templates + Bootstrap 5
- **Database**: MySQL (XAMPP)
- **Auth**: Laravel Breeze (Blade stack)
- **Icons**: Bootstrap Icons
- **Font**: Inter (Google Fonts)

## Instalasi

### Prasyarat
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL (XAMPP)

### Langkah-langkah

```bash
# 1. Clone repository
git clone <repository-url> foundu
cd foundu

# 2. Install dependensi PHP
composer install

# 3. Copy file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Konfigurasi database di .env
# Ubah baris berikut:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=foundu
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Buat database 'foundu' di MySQL/phpMyAdmin

# 7. Jalankan migration dan seeder
php artisan migrate --seed

# 8. Buat symbolic link untuk storage
php artisan storage:link

# 9. Install dependensi frontend dan build
npm install
npm run build

# 10. Jalankan server
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

## Kredensial Default

### Admin
- **Email**: `admin@foundu.test`
- **Password**: `password`

### Mahasiswa
- Register dengan email domain `@mhs.unsoed.ac.id`

## Struktur Direktori Utama

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── ItemController.php
│   │   ├── CategoryController.php
│   │   ├── PickupPointController.php
│   │   ├── ClaimController.php
│   │   └── Admin/
│   │       └── ReportController.php
│   ├── Requests/
│   │   ├── StoreItemRequest.php
│   │   └── UpdateItemRequest.php
│   └── Middleware/
│       └── CheckRole.php
├── Models/
│   ├── User.php
│   ├── Item.php
│   ├── Category.php
│   ├── PickupPoint.php
│   ├── Claim.php
│   └── Report.php
database/
├── migrations/
├── seeders/
│   ├── AdminUserSeeder.php
│   ├── CategorySeeder.php
│   └── PickupPointSeeder.php
resources/views/
├── layouts/ (app, guest)
├── auth/ (login, register, forgot-password, reset-password)
├── items/ (index, create, edit, show)
├── categories/ (index, create, edit)
├── pickup-points/ (index, create, edit)
├── admin/ (dashboard, reports/index)
└── profile/ (edit)
```

## Screenshots

> *Tambahkan screenshot di sini*

## Lisensi

Project ini dibuat untuk keperluan pembelajaran Pemrograman Web.
