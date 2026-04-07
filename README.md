# Labsi Bersih

## Deskripsi Proyek

**Labsi Bersih** adalah aplikasi manajemen sistem yang dibangun di atas kerangka kerja **Laravel 13** dan memanfaatkan **Filament Admin Panel v5** untuk mempermudah pengelolaan data (CRUD) serta tampilan dasbor administratif yang interaktif. 

Aplikasi ini menggunakan modul Role-Based Access Control (RBAC) melalui integrasi paket **Spatie Laravel-Permission**, sehingga akses dapat dibatasi sesuai dengan peran (role) pengguna. Selain panel admin standar, aplikasi ini juga memiliki antarmuka dashboard kustom (non-Filament) yang dibangun dengan Blade templating dan Tailwind CSS, menggantikan setup bawaan Laravel Breeze.

Terdapat 4 jenis peran (Role) utama yang diimplementasikan dalam skenario pengelolaan (merujuk pada tabel/skema seed):
- **Super Admin**: Memiliki akses ke segala aspek sistem tanpa batasan.
- **Pak Adi**: Memiliki hak akses khusus untuk proses persetujuan dan pengawasan tingkat tinggi.
- **Asisten**: Dapat mengelola operasional harian atau memvalidasi akses yang di bawahnya.
- **Ketua Tingkat**: Pengguna level terendah dengan akses fungsional terbatas.

---

## Persyaratan Sistem

Pastikan environment Anda telah terinstal hal-hal dasar di bawah ini sebelum melanjutkan instalasi:
- **PHP** >= 8.3
- **Composer** (Package Manager)
- **Node.js** & **NPM** (Untuk manajemen aset Frontend Vite)
- **Database** (MySQL / PostgreSQL / SQLite)

---

## Langkah Instalasi

Berikut adalah langkah-langkah untuk menyiapkan dan menjalankan aplikasi secara lokal. Aplikasi ini telah disiapkan untuk proses setup yang terotomatisasi via script `composer`.

### 1. Dapatkan Kode Sumber
Silakan *clone* repositori proyek ini ke dalam direktori komputer Anda.
```bash
git clone <URL_REPOSITORY> labsi-bersih
cd labsi-bersih
```

### 2. Setup Otomatis (Direkomendasikan)
Anda dapat menggunakan script kustom yang sudah disiapkan di `composer.json` untuk mempercepat instalasi dependencies, pembuatan file `.env`, *generate key*, migrasi database dasar, serta instalasi dan *build* aset *frontend*.

Jalankan perintah berikut:
```bash
composer setup
```

**Sebagai Informasi**, script `composer setup` di balik layar menjalankan proses berikut secara berurutan:
- `composer install`
- *Copy* file `.env.example` menjadi `.env`
- `php artisan key:generate`
- `php artisan migrate --force`
- `npm install --ignore-scripts`
- `npm run build`

> **Catatan:** Jangan lupa untuk menyesuaikan konfigurasi database Anda (nama DB, *username*, *password*) pada file `.env` sebelum menjalankan *seed* database jika Anda tidak menggunakan SQLite atau koneksi default.

### 3. Inisialisasi Role & Akses (Database Seeder)
Sistem ini membutuhkan data *Role* dan konfigurasi pengguna (User) di awal untuk dapat melakukan *Login* dan mengakses dashboard/Filament admin. Jalankan *seeder* berikut:

```bash
php artisan db:seed --class=RolesAndPermissionsSeeder
```
*(Catatan: Anda juga bisa menjalankan `php artisan db:seed` apabila Role seeder sudah dimasukkan ke dalam file `DatabaseSeeder.php` root).*

### 4. Menjalankan Development Server
Untuk mulai menjalankan aplikasi dalam mode pengembangan lokal (termasuk hot-reloading untuk aset Vite dan Queue Worker), jalankan:

```bash
composer dev
```

Ini akan menjalankan perintah `php artisan serve`, Queue, dan `npm run dev` secara bersamaan (via utilitas *concurrently*).

### 5. Mengakses Aplikasi
Setelah server berhasil berjalan, Anda dapat mengakses URL berikut pada browser Anda:
- **Halaman Utama / Dashboard Custom**: [http://localhost:8000](http://localhost:8000)
- **Panel Admin Filament**: [http://localhost:8000/admin](http://localhost:8000/admin)

Gunakan kredensial (Email & Password) dari seeder (hasil output dari `RolesAndPermissionsSeeder`) untuk menguji coba masuk ke dasbor dan panel akses aplikasi.
