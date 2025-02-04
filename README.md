# Aplikasi Manajemen Properti

## Gambaran Umum

Ini adalah Aplikasi Manajemen Properti sederhana yang dirancang untuk membantu agen penjualan dalam mengelola properti perumahan yang akan dijual. Aplikasi ini berfungsi mirip dengan CRM, tetapi dikhususkan untuk manajemen properti. Aplikasi ini memungkinkan agen untuk mencatat detail properti, menjadwalkan tindak lanjut dengan pelanggan, dan menghasilkan laporan untuk memastikan tim tetap terinformasi tentang aktivitas yang sedang berlangsung.

## Fitur

1. **Manajemen Properti**:
   - Tambah, edit, dan hapus daftar properti.
   - Lihat informasi detail tentang setiap properti (misalnya, alamat, harga, status, dll.).

2. **Penjadwalan**:
   - Atur pengingat tindak lanjut untuk agen penjualan.
   - Beri notifikasi kepada agen tentang tindak lanjut yang akan datang dengan pelanggan.

3. **Pelaporan**:
   - Hasilkan laporan tentang aktivitas tindak lanjut.
   - Bagikan informasi tindak lanjut dengan agen lain untuk memastikan transparansi dan kolaborasi.

4. **Manajemen Pengguna**:
   - Tambah dan kelola agen penjualan.
   - Tetapkan properti dan tugas tindak lanjut kepada agen tertentu.

5. **Antarmuka Sederhana dan Intuitif**:
   - Antarmuka yang mudah digunakan untuk entri data dan manajemen yang cepat.

## Instalasi

1. **Clone repository**:
   ```bash
   git clone https://github.com/namapengguna/aplikasi-manajemen-properti.git
   ```

2. **Masuk ke direktori proyek**:
   ```bash
   cd aplikasi-manajemen-properti
   ```

3. **Instal dependensi**:
   ```bash
   composer install
   ```

4. **Siapkan database**:
   - Buat database baru di sistem manajemen database SQL yang Anda gunakan.
   - Perbarui konfigurasi database di `.env`.

5. **Jalankan migrasi**:
   ```bash
   php artisan migrate
   ```

## Cara Penggunaan

1. **Menambahkan Properti**:
   - Buka bagian "Properti".
   - Klik "Tambah Properti Baru" dan isi detail yang diperlukan.

2. **Menjadwalkan Tindak Lanjut**:
   - Buka bagian "Penjadwalan".
   - Pilih properti dan atur tanggal serta waktu tindak lanjut.
   - Sistem akan memberi notifikasi kepada agen yang ditugaskan ketika waktu tindak lanjut tiba.

3. **Membuat Laporan**:
   - Buka bagian "Laporan".
   - Pilih jenis laporan yang ingin dibuat (misalnya, aktivitas tindak lanjut).
   - Laporan akan ditampilkan dan dapat dibagikan dengan agen lain.

## Berkontribusi

Kontribusi sangat diterima! Jika Anda memiliki saran, laporan bug, atau permintaan fitur, silakan buka _issue_ atau ajukan _pull request_.

1. **Fork repository**.
2. **Buat branch baru**:
   ```bash
   git checkout -b fitur/nama-fitur-anda
   ```
3. **Commit perubahan Anda**:
   ```bash
   git commit -m 'Tambahkan fitur baru'
   ```
4. **Push ke branch**:
   ```bash
   git push origin fitur/nama-fitur-anda
   ```
5. **Ajukan pull request**.

## Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT - lihat file [LICENSE](LICENSE) untuk detailnya.

## Kontak

Jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut, jangan ragu untuk menghubungi saya di [a.syakur14@gmail.com](mailto:a.syakur14@gmail.com).

---

Terima kasih telah menggunakan Aplikasi Manajemen Properti! Semoga aplikasi ini dapat membantu menyederhanakan proses penjualan properti Anda dan meningkatkan kolaborasi tim.
