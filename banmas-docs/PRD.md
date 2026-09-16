# Product Requirements Document

## 1. Informasi Produk

Nama produk: BanMas Helpdesk
Kepanjangan: Bantuan Masalah
Subjudul: Sistem Manajemen Layanan dan Bantuan IT
Platform: Aplikasi web lokal
Target teknologi:
- Laravel
- PHP
- MariaDB/MySQL
- Blade
- Tailwind CSS
- Vite
- Laragon
- Windows
- VS Code

## 2. Tujuan Produk

BanMas Helpdesk digunakan untuk:
1. Menerima laporan masalah IT dari karyawan.
2. Mengelola tiket bantuan IT.
3. Menugaskan tiket kepada teknisi.
4. Memantau status pekerjaan.
5. Mendokumentasikan solusi.
6. Menyediakan laporan pekerjaan IT.

## 3. Role Pengguna

### Admin
Hak akses:
- Melihat semua tiket.
- Membuat dan mengubah tiket.
- Menugaskan teknisi.
- Mengubah status tiket.
- Mengelola user.
- Mengelola kategori.
- Melihat dashboard dan laporan.
- Melihat log aktivitas.

### Teknisi
Hak akses:
- Melihat tiket yang ditugaskan.
- Melihat detail tiket.
- Mengubah status tiket.
- Menulis komentar.
- Menulis solusi.
- Mengunggah bukti pekerjaan.
- Menandai tiket sebagai resolved.

### User/Pelapor
Hak akses:
- Membuat tiket.
- Melihat tiket miliknya.
- Menulis komentar pada tiket miliknya.
- Mengunggah bukti.
- Membatalkan tiket sebelum diproses.
- Mengonfirmasi tiket selesai.

## 4. Status Tiket

- Open
- Assigned
- In Progress
- Pending
- Resolved
- Closed
- Rejected
- Reopened

## 5. Kategori Tiket

- Hardware
- Software
- Network
- Printer
- Account
- CCTV
- Radio/HT
- Server
- Other

## 6. Prioritas

- Low
- Medium
- High
- Critical

## 7. Data Tiket

Field minimal:
- id
- ticket_number
- title
- description
- category_id
- priority
- status
- reporter_id
- technician_id
- location
- attachment
- solution
- opened_at
- resolved_at
- closed_at
- created_at
- updated_at

## 8. Halaman MVP

### Public
- Landing page sederhana.
- Login.

### User
- Dashboard user.
- Buat tiket.
- Daftar tiket milik user.
- Detail tiket.
- Komentar tiket.
- Profil.

### Teknisi
- Dashboard teknisi.
- Tiket yang ditugaskan.
- Detail tiket.
- Update status.
- Komentar.
- Solusi.

### Admin
- Dashboard admin.
- Semua tiket.
- Kelola user.
- Kelola teknisi.
- Kelola kategori.
- Laporan.
- Log aktivitas.
- Pengaturan.

## 9. Aturan Keamanan

- Password harus di-hash.
- Validasi semua input.
- Gunakan CSRF protection.
- Gunakan authorization berdasarkan role.
- User hanya boleh melihat tiket miliknya.
- Teknisi hanya boleh memproses tiket yang ditugaskan atau diizinkan.
- Jangan menyimpan secret key di repository.
- File upload harus memeriksa ukuran dan MIME type.
- Nama file upload harus dibuat ulang oleh aplikasi.
- Jangan menampilkan stack trace pada production.
- APP_DEBUG=false pada production.
- Semua perubahan status penting dicatat di log aktivitas.

## 10. UI/UX

- Default theme terang.
- Dark mode sebagai opsi.
- Responsive untuk desktop, tablet, dan mobile.
- Sidebar pada desktop.
- Bottom navigation atau menu ringkas pada mobile.
- Status menggunakan badge teks dan warna.
- Form memiliki label dan pesan error.
- Tombol destructive harus memiliki konfirmasi.
- Tampilkan loading state saat form diproses.
- Tampilkan empty state jika belum ada data.
- Tampilkan success/error notification.

## 11. Non-Functional Requirements

- Kode mudah dibaca.
- Struktur mengikuti konvensi Laravel.
- Database menggunakan migration.
- Fitur penting memiliki validasi.
- Error dicatat di storage/logs/laravel.log.
- Jangan menampilkan error teknis kepada pengguna umum.
- Project dapat dijalankan secara lokal melalui Laragon.
- Setiap milestone diuji sebelum lanjut.

## 12. Urutan Pengerjaan

1. Inisialisasi Laravel.
2. Konfigurasi database.
3. Membuat layout utama.
4. Membuat autentikasi.
5. Membuat role dan authorization.
6. Membuat tabel users.
7. Membuat tabel categories.
8. Membuat tabel tickets.
9. Membuat CRUD tiket.
10. Membuat dashboard sesuai role.
11. Menambahkan assignment teknisi.
12. Menambahkan komentar.
13. Menambahkan upload lampiran.
14. Menambahkan filter dan pencarian.
15. Menambahkan log aktivitas.
16. Menambahkan dark mode.
17. Testing.
18. Dokumentasi.
19. AI assistant sebagai fitur lanjutan.

## 13. Batasan MVP

Jangan membuat fitur berikut pada tahap awal:
- multi-agent AI;
- WhatsApp gateway;
- mobile app;
- microservices;
- real-time websocket;
- deployment production;
- integrasi banyak layanan eksternal.

## 14. Kriteria Selesai MVP

MVP dianggap selesai jika:
1. User dapat login.
2. User dapat membuat tiket.
3. Admin dapat melihat semua tiket.
4. Admin dapat menetapkan teknisi.
5. Teknisi dapat mengubah status dan menulis solusi.
6. User hanya dapat melihat tiket miliknya.
7. Data tersimpan di database.
8. Validasi form bekerja.
9. Error tercatat di log.
10. Tampilan dapat digunakan pada desktop dan mobile.