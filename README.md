# Management Kendaraan

Deskripsi singkat tentang proyek Anda.

## Prasyarat

Sebelum Anda memulai, pastikan sistem Anda memenuhi persyaratan berikut:

- [Git](https://git-scm.com/downloads)
- [Composer](https://getcomposer.org/download/)
- PHP >= 8.2
- [MySQL](https://www.mysql.com/downloads/) atau database lain yang kompatibel

## Instalasi

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan proyek:

1. Kloning repositori
   ```
   git clone https://github.com/neddy1298/management-kendaraan
   cd management-kendaraan
   ```

2. Instal dependensi PHP
   ```
   composer install
   ```

3. Salin file .env
   ```
   cp .env.example .env
   ```

4. Generate kunci aplikasi
   ```
   php artisan key:generate
   ```

5. Konfigurasi database
   Buka file `.env` dan sesuaikan pengaturan database:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=username
   DB_PASSWORD=password
   ```

6. Jalankan migrasi database
   ```
   php artisan migrate
   ```

7. (Opsional) Jalankan seeder
   ```
   php artisan db:seed
   ```

8. Jalankan server lokal
   ```
   php artisan serve
   ```

   Aplikasi sekarang berjalan di `http://localhost:8000`.

## Fitur Utama

- Management Kendaraan
- Data Maintenance Kendaraan
- Laporan

## Lisensi

[MIT](https://choosealicense.com/licenses/mit/)
