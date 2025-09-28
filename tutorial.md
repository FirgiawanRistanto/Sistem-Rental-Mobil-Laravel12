# Alur Pemakaian Proyek Rental Mobil

Dokumen ini menjelaskan alur kerja dan penggunaan setiap modul utama dalam aplikasi rental mobil untuk memudahkan pembuatan flowchart dan pemahaman sistem.

## 1. Otentikasi (Login)

Alur ini adalah gerbang masuk ke dalam sistem untuk admin atau staff.

1.  **Akses Halaman Login**: Pengguna membuka URL aplikasi dan diarahkan ke halaman login.
2.  **Input Kredensial**: Pengguna memasukkan `email` dan `password`.
3.  **Validasi**: Sistem memvalidasi kredensial pengguna.
    *   **Jika Berhasil**: Pengguna diarahkan ke halaman **Dashboard**.
    *   **Jika Gagal**: Pesan error ditampilkan di halaman login.

## 2. Dashboard

Halaman utama setelah login berhasil.

1.  **Tampilan Informasi**: Dashboard menampilkan ringkasan data, seperti jumlah mobil yang tersedia, jumlah mobil yang sedang disewa, jumlah pelanggan, dan transaksi terakhir.
2.  **Navigasi**: Dari dashboard, pengguna dapat mengakses semua modul lain melalui menu navigasi (sidebar atau header).

## 3. Manajemen Mobil

Modul untuk mengelola data semua mobil yang disewakan.

**A. Menambah Mobil Baru**
1.  Akses menu **Manajemen Mobil**.
2.  Klik tombol **"Tambah Mobil"**.
3.  Isi formulir data mobil:
    *   Merk & Model
    *   Nomor Polisi
    *   Tarif Sewa per Hari
    *   Denda Keterlambatan per Hari
    *   Jadwal Perawatan Berikutnya (tanggal)
4.  Unggah satu atau lebih **gambar mobil**. Sistem akan mengatur urutan gambar.
5.  Klik **"Simpan"**. Mobil baru akan tersimpan dengan status **"Tersedia"**.

**B. Mengubah & Melihat Data Mobil**
1.  Akses menu **Manajemen Mobil**.
2.  Lihat daftar mobil yang ada.
3.  Klik tombol **"Edit"** pada mobil yang ingin diubah.
4.  Ubah data pada formulir.
5.  Klik **"Simpan"**.

**C. Menghapus Mobil**
1.  Akses menu **Manajemen Mobil**.
2.  Klik tombol **"Hapus"** pada mobil yang ingin dihapus.
3.  Sistem akan meminta konfirmasi.
4.  Setelah konfirmasi, data mobil akan dihapus (menggunakan *Soft Delete*, jadi data tidak benar-benar hilang dari database, hanya disembunyikan).

## 4. Manajemen Pelanggan

Modul untuk mengelola data pelanggan.

1.  **Akses menu Manajemen Pelanggan**.
2.  Alur kerja untuk **menambah, mengubah, dan menghapus** data pelanggan sama persis dengan alur pada **Manajemen Mobil**.
3.  Data yang diisi biasanya meliputi: Nama, Alamat, Nomor Telepon, dan Nomor KTP.

## 5. Alur Penyewaan & Pengembalian

Ini adalah alur inti dari bisnis rental mobil.

**A. Membuat Transaksi Penyewaan Baru**
1.  Akses menu **Penyewaan**.
2.  Klik tombol **"Buat Penyewaan Baru"** atau sejenisnya.
3.  Pilih **Pelanggan** dari daftar yang sudah ada.
4.  Pilih **Mobil** dari daftar mobil yang berstatus **"Tersedia"**.
5.  Tentukan **Tanggal Mulai Sewa** dan **Tanggal Selesai Sewa**.
6.  Sistem akan otomatis menghitung **estimasi total biaya sewa**.
7.  Klik **"Simpan"** atau **"Proses"**.
8.  Status mobil yang dipilih akan berubah menjadi **"Disewa"**.

**B. Proses Pengembalian Mobil**
1.  Akses menu **Pengembalian** (atau bisa jadi bagian dari menu **Penyewaan**).
2.  Cari transaksi penyewaan yang aktif (berdasarkan nama pelanggan atau nopol mobil).
3.  Klik tombol **"Proses Pengembalian"**.
4.  Sistem akan membandingkan **tanggal pengembalian aktual** dengan **tanggal selesai sewa** yang seharusnya.
    *   **Jika Terlambat**: Sistem otomatis menghitung **total denda** berdasarkan jumlah hari keterlambatan dikalikan denda per hari.
    *   **Jika Tepat Waktu**: Tidak ada denda.
5.  Admin mengonfirmasi total yang harus dibayar (biaya sewa + denda jika ada).
6.  Setelah transaksi selesai, klik **"Selesaikan Transaksi"**.
7.  Status penyewaan diperbarui menjadi **"Selesai"**.
8.  Status mobil yang bersangkutan akan kembali menjadi **"Tersedia"**.

## 6. Manajemen Perawatan

Modul untuk melacak dan mengelola jadwal perawatan mobil.

**A. Mencatat Perawatan**
1.  Akses menu **Perawatan**.
2.  Klik **"Catat Perawatan Baru"**.
3.  Pilih **Mobil** yang akan menjalani perawatan. Status mobil otomatis berubah menjadi **"Dalam Perawatan"**.
4.  Isi detail perawatan:
    *   Tanggal Masuk Perawatan
    *   Deskripsi pekerjaan (misal: ganti oli, servis rem)
    *   Biaya Perawatan
5.  Klik **"Simpan"**.

**B. Menyelesaikan Perawatan**
1.  Setelah perawatan selesai, cari data perawatan yang aktif.
2.  Klik tombol **"Selesai Perawatan"**.
3.  Status mobil akan kembali menjadi **"Tersedia"** dan siap untuk disewakan lagi.
4.  Jadwal perawatan berikutnya pada data mobil bisa diperbarui.

## 7. Notifikasi Perawatan

Sistem ini memiliki fitur pengingat jadwal perawatan mobil.

1.  **Proses Otomatis**: Sebuah *scheduled task* (cron job) berjalan setiap hari (`CheckMaintenanceSchedule`).
2.  **Pengecekan**: Tugas ini akan memeriksa semua mobil dan mencari mobil yang tanggal **jadwal perawatannya** sudah dekat atau terlewat.
3.  **Kirim Notifikasi**: Jika ada mobil yang memenuhi kriteria, sistem akan membuat notifikasi di dalam aplikasi (terlihat di ikon lonceng/notif) untuk memberitahu admin.

## 8. Laporan

Modul untuk melihat rekap data transaksi.

1.  Akses menu **Laporan**.
2.  Pilih jenis laporan yang ingin dilihat (misalnya: Laporan Penyewaan, Laporan Pendapatan, Laporan Perawatan).
3.  Pilih periode waktu (misal: bulan ini, tahun ini, atau rentang tanggal kustom).
4.  Klik **"Generate"** atau **"Tampilkan"**.
5.  Sistem akan menampilkan data laporan dalam bentuk tabel dan mungkin juga grafik.
6.  Terdapat opsi untuk **mencetak** atau **mengunduh** laporan (misal: dalam format PDF atau Excel).
