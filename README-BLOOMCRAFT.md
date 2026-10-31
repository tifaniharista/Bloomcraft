# Bloomcraft — Instalasi Windows

## Prasyarat
- PHP 8.3 atau lebih baru dan ekstensi PHP yang dibutuhkan Laravel (termasuk `fileinfo`, `mbstring`, `openssl`, `pdo_mysql`, `tokenizer`, `xml`, `ctype`, `curl` dan `zip`).
- Composer 2.
- Node.js LTS + npm (untuk aset frontend jika dibutuhkan).
- MySQL 8 atau MariaDB kompatibel.

## 1. Siapkan aplikasi
1. Ekstrak ZIP ke folder seperti `C:\laragon\www\bloomcraft` (Laragon) atau folder kerja pilihan.
2. Buka Terminal/PowerShell pada folder proyek.
3. Jalankan:
   ```powershell
   composer install
   Copy-Item .env.example .env
   php artisan key:generate
   ```
   Jika `.env` sudah ada, jangan menimpanya; cukup pastikan `APP_NAME=Bloomcraft`.

## 2. Siapkan database MySQL
Buat database kosong bernama `bloomcraft`, lalu sesuaikan `.env`:
```dotenv
APP_NAME=Bloomcraft
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bloomcraft
DB_USERNAME=root
DB_PASSWORD=
BLOOMCRAFT_ADMIN_EMAIL=admin@bloomcraft.local
BLOOMCRAFT_ADMIN_PASSWORD=GantiDenganPasswordKuat12!
BLOOMCRAFT_BANK_NAME=NamaBank
BLOOMCRAFT_BANK_ACCOUNT_NAME=NamaPemilikRekening
BLOOMCRAFT_BANK_ACCOUNT_NUMBER=NomorRekeningResmi
```
Gunakan password admin pribadi yang kuat; jangan gunakan contoh password ini untuk situs publik.

Kemudian jalankan:
```powershell
php artisan config:clear
php artisan migrate:fresh --seed
php artisan storage:link
```
**Peringatan:** `migrate:fresh` menghapus semua tabel di database yang dikonfigurasi. Gunakan hanya untuk database lokal kosong.

## 3. Jalankan
```powershell
php artisan serve
```
Buka `http://127.0.0.1:8000`. Login admin menggunakan email/password yang diatur pada `.env`. Jika akun admin belum dibuat karena password belum diatur, isi `.env` lalu jalankan `php artisan db:seed`.

## Alur pembayaran Bloomcraft
1. Customer daftar/login, pilih produk dan checkout.
2. Total pembayaran dihitung dari harga produk aktif; ongkir selalu Rp0.
3. Sistem membuat nomor pesanan dan pembayaran berstatus menunggu bukti.
4. Customer transfer ke rekening admin yang disampaikan admin, lalu unggah bukti JPG/PNG/WEBP maksimal 4 MB.
5. Admin membuka Admin > Pesanan, memeriksa bukti, lalu menyetujui atau menolak.
6. Setelah pembayaran disetujui, admin menandai barang siap dikirim dan menggunakan tautan WhatsApp untuk memberi kabar kepada customer.

**Konfigurasi rekening:** isi `BLOOMCRAFT_BANK_NAME`, `BLOOMCRAFT_BANK_ACCOUNT_NAME`, dan `BLOOMCRAFT_BANK_ACCOUNT_NUMBER` di `.env` dengan detail rekening resmi Bloomcraft. Proyek tidak mengarang nomor rekening. Setelah mengubah `.env`, jalankan `php artisan config:clear`.

## Pengujian
```powershell
php artisan test
```
Jika pengujian memakai SQLite, aktifkan ekstensi `pdo_sqlite` di PHP. Untuk pengujian integrasi MySQL, siapkan database test terpisah dan jangan arahkan pengujian ke database berisi data penting.

## Catatan verifikasi paket
- Semua berkas PHP aplikasi, migrasi, seeder, dan test diperiksa dengan `php -l` saat paket disiapkan.
- Suite Laravel belum dapat dieksekusi di lingkungan penyusunan ZIP karena Composer dan direktori `vendor/` tidak tersedia. Jalankan `composer install` lalu `php artisan test` di komputer Windows untuk menjalankan pengujian otomatis yang disertakan.
