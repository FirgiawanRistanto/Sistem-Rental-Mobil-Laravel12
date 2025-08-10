# Aplikasi Manajemen Rental Mobil

Aplikasi ini adalah sistem informasi manajemen rental mobil berbasis web yang dibangun menggunakan framework Laravel. Proyek ini dibuat sebagai studi kasus untuk memenuhi tugas selama kegiatan Praktik Kerja Lapangan (PKL) di PT. Microdata Indonesia.

Sistem ini bertujuan untuk mempermudah pengelolaan data mobil, pelanggan, transaksi penyewaan, hingga penjadwalan perawatan kendaraan secara digital.

## 🚀 Fitur Utama

-   🔐 **Autentikasi & Manajemen User:** Sistem login yang aman untuk admin.
-   🚗 **Manajemen Data Mobil:** Operasi CRUD (Create, Read, Update, Delete) untuk data mobil yang disewakan.
-   👥 **Manajemen Data Pelanggan:** Operasi CRUD untuk data pelanggan.
-   📝 **Manajemen Transaksi:** Mengelola proses penyewaan dan pengembalian mobil.
-   💸 **Perhitungan Denda Otomatis:** Sistem otomatis menghitung denda jika terjadi keterlambatan pengembalian.
-   🛠️ **Manajemen Perawatan:** Mencatat dan menjadwalkan perawatan rutin untuk setiap kendaraan.
-   🔔 **Notifikasi Jadwal Perawatan:** Mengirimkan pengingat otomatis ketika jadwal perawatan mobil akan tiba.

## 💻 Teknologi yang Digunakan

-   **Backend:** PHP 8.x, Laravel 11.x
-   **Frontend:** Vite, Blade, Bootstrap
-   **Database:** MySQL
-   **Development Tool:** Composer, NPM

## ⚙️ Panduan Instalasi

Berikut adalah langkah-langkah untuk menjalankan proyek ini di lingkungan development.

1.  **Clone Repository**
    ```bash
    git clone https://github.com/username/repo-name.git
    ```

2.  **Masuk ke Direktori Proyek**
    ```bash
    cd rentalMobil
    ```

3.  **Install Dependensi Composer (PHP)**
    ```bash
    composer install
    ```

4.  **Buat File Konfigurasi Lingkungan**
    Salin file `.env.example` menjadi `.env`. Di Windows, gunakan perintah:
    ```bash
    copy .env.example .env
    ```

5.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

6.  **Konfigurasi Database**
    Buka file `.env` dan sesuaikan pengaturan database Anda.
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=rental_mobil_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

7.  **Jalankan Migrasi & Seeder Database**
    Perintah ini akan membuat semua tabel yang dibutuhkan dan mengisinya dengan data awal (jika ada seeder).
    ```bash
    php artisan migrate --seed
    ```

8.  **Install Dependensi NPM (JavaScript)**
    ```bash
    npm install
    ```

9.  **Kompilasi Aset Frontend**
    Jalankan Vite untuk mem-build file CSS dan JS.
    ```bash
    npm run dev
    ```

10. **Jalankan Server Development**
    Di terminal lain, jalankan server lokal Laravel.
    ```bash
    php artisan serve
    ```

11. **Selesai!**
    Buka browser Anda dan kunjungi `http://127.0.0.1:8000`.

## 📂 Struktur Proyek Penting

-   `app/Http/Controllers`: Berisi semua logic untuk menangani request.
-   `app/Models`: Representasi tabel database (Eloquent).
-   `database/migrations`: Skema untuk membangun tabel database.
-   `resources/views`: Berisi semua file tampilan (Blade templates).
-   `routes/web.php`: Mendefinisikan semua rute untuk aplikasi web.
-   `public`: Web server's document root.

## 👨‍💻 Pembuat

Dibuat oleh **Firgiawan Ristanto**

-   **GitHub:** `https://github.com/FirgiawanRistanto`
-   **LinkedIn:** `https://linkedin.com/in/[UsernameLinkedInKamu]`

---