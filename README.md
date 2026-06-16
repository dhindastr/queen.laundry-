# Queen Laundry — Management System
Aplikasi manajemen laundry berbasis web dengan Laravel 11. Mendukung 4 role: Admin, Owner, Kurir, dan Customer.

---

## Persyaratan Sistem
- PHP 8.2 atau lebih baru
- Composer
- Ekstensi PHP: `pdo`, `pdo_sqlite`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`

### Cek versi PHP:
```bash
php -v
```

---

## Langkah Instalasi dari Awal

### 1. Ekstrak ZIP
```bash
unzip queen_laundry.zip -d queen_laundry
cd queen_laundry
```

### 2. Install Dependencies
```bash
composer install
```
> Jika belum ada Composer: https://getcomposer.org/download/

### 3. Salin file .env
```bash
cp .env.example .env
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Buat database SQLite
```bash
touch database/database.sqlite
```

### 6. Jalankan Migrasi + Seeder
```bash
php artisan migrate --seed
```
> Perintah ini akan membuat semua tabel dan mengisi data demo.

### 7. Buat symlink storage (untuk foto upload)
```bash
php artisan storage:link
```

### 8. Jalankan Server
```bash
php artisan serve
```
> Buka browser: **http://localhost:8000**

---

## Akun Demo (password semua: `password`)

| Role     | Email                  |
|----------|------------------------|
| Admin    | admin@queen.com        |
| Owner    | owner@queen.com        |
| Kurir    | andi@queen.com         |
| Kurir    | rudi@queen.com         |
| Customer | customer@queen.com     |
| Customer | cv@queen.com           |
| Customer | toko@queen.com         |

---

## Fitur per Role

### Admin
- Dashboard overview + stats harian
- Kelola Order: tambah, assign kurir, update status, timeline
- Kelola Customer: CRUD lengkap
- Kelola Kurir: CRUD + statistik
- Stok Barang: tambah barang, restock, alert kritis
- Invoice: generate & cetak PDF
- Laporan: bar chart pemasukan, kinerja kurir, top customer

### Customer
- Dashboard order aktif + tracking timeline
- Request Pickup baru
- Lacak status order real-time
- Invoice & cetak PDF

### Kurir
- Dashboard tugas aktif
- Konfirmasi pickup + upload foto
- Konfirmasi delivery + upload foto
- Riwayat semua tugas

### Owner
- Dashboard finansial (pemasukan, pengeluaran, laba)
- Monitoring seluruh order
- Laporan bisnis 6 bulan
- Pantau stok tanpa edit

---

## Menggunakan MySQL (Opsional)

Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=queen_laundry
DB_USERNAME=root
DB_PASSWORD=
```

Buat database terlebih dahulu:
```sql
CREATE DATABASE queen_laundry CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Lalu jalankan:
```bash
php artisan migrate --seed
```

---

## Troubleshooting

**Error: `Permission denied` pada storage**
```bash
chmod -R 775 storage bootstrap/cache
```

**Error: `APP_KEY` tidak valid**
```bash
php artisan key:generate
```

**Error: `Class not found`**
```bash
composer dump-autoload
```

**Halaman error 500**
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```
