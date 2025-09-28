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

---

## 📖 Dokumentasi Teknis

Dokumentasi ini memberikan gambaran mendalam tentang arsitektur, alur kerja, dan komponen teknis dari aplikasi.

### Alur Kerja Aplikasi (Application Workflow)

#### 1. Proses Penyewaan Mobil
- **Pemilihan Mobil:** Admin memilih mobil yang tersedia dari halaman `admin/mobils`.
- **Input Data Sewa:** Admin membuka form penyewaan baru dari `admin/penyewaans/create`.
- **Pemilihan Pelanggan:** Admin dapat memilih pelanggan yang sudah ada atau menambahkan data pelanggan baru secara langsung (via AJAX).
- **Penentuan Tanggal:** Admin memasukkan tanggal sewa dan tanggal kembali. Total biaya sewa dihitung otomatis berdasarkan harga sewa mobil per hari.
- **Konfirmasi:** Setelah data disimpan, status mobil berubah menjadi "Disewa" (`disewa = true`), dan transaksi tercatat dengan status "Disewa".

#### 2. Proses Pengembalian Mobil
- **Akses Halaman Pengembalian:** Admin membuka halaman `admin/pengembalian`.
- **Pilih Transaksi:** Admin memilih transaksi penyewaan yang akan diproses.
- **Input Tanggal Kembali Aktual:** Admin memasukkan tanggal pengembalian mobil oleh pelanggan.
- **Perhitungan Denda:** Jika `tanggal_kembali_aktual` melebihi `tanggal_kembali`, sistem akan menghitung denda secara otomatis (`jumlah_hari_terlambat * denda_per_hari`).
- **Penyelesaian:** Setelah konfirmasi, status penyewaan berubah menjadi "Selesai", dan status mobil kembali menjadi "Tersedia" (`disewa = false`).

#### 3. Proses Manajemen Perawatan
- **Penjadwalan Otomatis:** Setiap mobil memiliki kolom `periode_perawatan_hari` (misal: 90 hari) dan `jadwal_perawatan_berikutnya`.
- **Pemicu Notifikasi:** Sebuah *scheduled command* (`app/Console/Commands/CheckMaintenanceSchedule.php`) berjalan setiap hari untuk memeriksa mobil mana yang jadwal perawatannya akan segera tiba.
- **Pengiriman Notifikasi:** Jika jadwal perawatan H-7, sistem akan membuat notifikasi di dalam aplikasi untuk admin.
- **Pencatatan Perawatan:** Admin dapat mencatat perawatan baru dari `admin/perawatans/create`, memasukkan deskripsi, biaya, dan tanggal. Selama masa perawatan, status mobil diubah menjadi "Perawatan".
- **Penyelesaian Perawatan:** Setelah perawatan selesai, admin mengubah statusnya, dan `jadwal_perawatan_berikutnya` akan di-update secara otomatis berdasarkan `tanggal_selesai` + `periode_perawatan_hari`.

### Struktur Database (Database Schema)

Berikut adalah deskripsi tabel-tabel utama dalam database:

- **`mobils`**
  - `id`: Primary Key
  - `merk`, `tipe`, `nopol`: Informasi dasar mobil.
  - `harga_sewa`, `denda_per_hari`: Atribut finansial.
  - `status`: Enum (`tersedia`, `disewa`, `perawatan`).
  - `disewa`: Boolean, penanda cepat apakah mobil sedang disewa.
  - `jadwal_perawatan_berikutnya`: Date, untuk penjadwalan perawatan.
  - `periode_perawatan_hari`: Integer, interval perawatan dalam hari.
  - `deleted_at`: Untuk Soft Deletes.

- **`pelanggans`**
  - `id`: Primary Key
  - `nama`, `no_ktp`, `no_hp`, `alamat`: Informasi data diri pelanggan.
  - `deleted_at`: Untuk Soft Deletes.

- **`penyewaans`**
  - `id`: Primary Key
  - `mobil_id`: Foreign key ke tabel `mobils`.
  - `pelanggan_id`: Foreign key ke tabel `pelanggans`.
  - `user_id`: Foreign key ke tabel `users` (mencatat admin yang memproses).
  - `tanggal_sewa`, `tanggal_kembali`: Jadwal sewa.
  - `tanggal_kembali_aktual`: Tanggal pengembalian aktual.
  - `total_biaya`, `denda`: Informasi finansial transaksi.
  - `status`: Enum (`Disewa`, `Selesai`).
  - `deleted_at`: Untuk Soft Deletes.

- **`perawatans`**
  - `id`: Primary Key
  - `mobil_id`: Foreign key ke tabel `mobils`.
  - `tanggal_mulai`, `tanggal_selesai`: Durasi perawatan.
  - `deskripsi`, `biaya`: Detail pekerjaan dan biaya perawatan.
  - `status`: Status pekerjaan perawatan.
  - `deleted_at`: Untuk Soft Deletes.

- **`mobil_gambars`**
  - `id`: Primary Key
  - `mobil_id`: Foreign key ke tabel `mobils`.
  - `path`: Lokasi file gambar.
  - `urutan`: Urutan tampilan gambar.

### Rute & Endpoint API (Routes & API Endpoints)

Semua rute utama memerlukan autentikasi dan berada di bawah prefix `admin/`.

| Method | URI                               | Nama Rute                      | Controller Action                 | Deskripsi                                            |
|--------|-----------------------------------|--------------------------------|-----------------------------------|------------------------------------------------------|
| GET    | `/login`                          | `login`                        | `LoginController@showLoginForm`   | Menampilkan halaman login.                           |
| POST   | `/login`                          | `login`                        | `LoginController@login`           | Memproses upaya login.                               |
| POST   | `/logout`                         | `logout`                       | `LoginController@logout`          | Memproses logout.                                    |
| GET    | `admin/dashboard`                 | `admin.dashboard`              | `DashboardController@index`       | Menampilkan dashboard utama.                         |
| GET    | `admin/mobils`                    | `admin.mobils.index`           | `MobilController@index`           | Menampilkan daftar mobil.                            |
| POST   | `admin/mobils`                    | `admin.mobils.store`           | `MobilController@store`           | Menyimpan data mobil baru.                           |
| GET    | `admin/mobils/{mobil}/edit`       | `admin.mobils.edit`            | `MobilController@edit`            | Menampilkan form edit mobil.                         |
| PUT    | `admin/mobils/{mobil}`            | `admin.mobils.update`          | `MobilController@update`          | Mengupdate data mobil.                               |
| DELETE | `admin/mobils/{mobil}`            | `admin.mobils.destroy`         | `MobilController@destroy`         | Menghapus data mobil (Soft Delete).                  |
| GET    | `admin/penyewaans`                | `admin.penyewaans.index`       | `PenyewaanController@index`       | Menampilkan daftar transaksi sewa.                   |
| POST   | `admin/penyewaans`                | `admin.penyewaans.store`       | `PenyewaanController@store`       | Menyimpan transaksi sewa baru.                       |
| GET    | `admin/pengembalian`              | `admin.pengembalian.index`     | `PenyewaanController@showPengembalianForm` | Menampilkan form untuk proses pengembalian.          |
| POST   | `admin/pengembalian/{penyewaan}`  | `admin.pengembalian.store`     | `PenyewaanController@prosesPengembalian` | Memproses pengembalian dan menghitung denda.         |
| GET    | `admin/perawatans`                | `admin.perawatans.index`       | `PerawatanController@index`       | Menampilkan riwayat perawatan.                       |
| POST   | `admin/perawatans`                | `admin.perawatans.store`       | `PerawatanController@store`       | Menyimpan data perawatan baru.                       |
| POST   | `admin/notifications/{notif}/mark-as-read` | `admin.notifications.markAsRead` | `NotifController@markAsRead` | Menandai notifikasi sebagai sudah dibaca.            |

---

## 👨‍💻 Pembuat

Dibuat oleh **Firgiawan Ristanto**

-   **GitHub:** `https://github.com/FirgiawanRistanto`
-   **LinkedIn:** `https://linkedin.com/in/[UsernameLinkedInKamu]`
