# ManajamenBuku (LibraryHub)

## Nama Proyek
**ManajamenBuku (LibraryHub)** adalah sistem manajemen perpustakaan digital berbasis Laravel yang memudahkan pengelolaan koleksi buku, anggota, peminjaman, dan administrasi perpustakaan secara modern.

## Fitur Utama
1. **Autentikasi & Registrasi**
   - **Login**: Pengguna dapat login menggunakan email, password, dan captcha. Setelah login, pengguna diarahkan ke dashboard sesuai peran (admin/user).
   - **Logout**: Pengguna dapat keluar dari sesi.
   - **Registrasi**: Pengguna baru dapat mendaftar sebagai anggota (role: user).
   - **Ganti Password**: Pengguna dapat mengganti password melalui halaman profil.
2. **Dashboard**
   - **Admin Dashboard**: Menampilkan statistik jumlah buku, anggota, peminjaman, buku belum dikembalikan, peminjaman terbaru, dan buku terpopuler.
   - **User Dashboard**: Menampilkan koleksi buku terbaru, fitur pencarian, dan filter kategori.
3. **Manajemen Buku**
   - **Lihat Daftar Buku**: Admin dan user dapat melihat daftar buku, dengan fitur pencarian dan filter kategori.
   - **Tambah Buku**: Admin dapat menambah buku baru, termasuk upload gambar.
   - **Edit Buku**: Admin dapat mengedit data buku.
   - **Hapus Buku**: Admin dapat menghapus buku.
   - **Cetak Daftar Buku (PDF)**: Admin dapat mencetak daftar buku ke PDF.
4. **Manajemen Kategori**
   - **Lihat Daftar Kategori**: Admin dapat melihat semua kategori beserta jumlah bukunya.
   - **Tambah Kategori**: Admin dapat menambah kategori baru.
   - **Edit Kategori**: Admin dapat mengedit kategori.
   - **Hapus Kategori**: Admin dapat menghapus kategori (tidak bisa jika masih ada buku di kategori tersebut).
5. **Manajemen Anggota**
   - **Lihat Daftar Anggota**: Admin dapat melihat semua anggota.
   - **Tambah Anggota**: Admin dapat menambah anggota baru.
   - **Edit Anggota**: Admin dapat mengedit data anggota.
   - **Hapus Anggota**: Admin dapat menghapus anggota.
6. **Manajemen Peminjaman Buku**
   - **Lihat Daftar Peminjaman**: Admin dapat melihat semua data peminjaman.
   - **Tambah Peminjaman**: Admin dapat mencatat peminjaman buku untuk anggota.
   - **Edit Peminjaman**: Admin dapat mengedit data peminjaman.
   - **Hapus Peminjaman**: Admin dapat menghapus data peminjaman.
   - **Peminjaman oleh User**: User dapat meminjam buku sendiri, sistem otomatis membuat data anggota jika belum ada.
   - **Lihat Riwayat Peminjaman User**: User dapat melihat daftar buku yang pernah dipinjam.
   - **Batalkan Peminjaman**: User dapat membatalkan peminjaman yang belum dikembalikan.
7. **Profil Pengguna**
   - **Lihat Profil**: Pengguna dapat melihat profilnya.
   - **Edit Profil**: Pengguna dapat mengubah nama dan email.
   - **Ganti Password**: Pengguna dapat mengganti password.
8. **Halaman Statis**
   - **Beranda (Landing Page)**: Menampilkan highlight fitur, koleksi buku terbaru, dan kategori.
   - **Tentang Perpustakaan**: Menjelaskan visi dan misi perpustakaan.
9. **Fitur Tambahan**
   - **Captcha**: Digunakan pada form login untuk keamanan.
   - **Navigasi Dinamis**: Menu navigasi menyesuaikan peran user (admin/user/tamu).
   - **Upload Gambar Buku**: Buku dapat memiliki gambar sampul.
   - **Statistik & Laporan**: Dashboard admin menampilkan statistik dan laporan singkat.
10. **Middleware & Role**
    - **Role Middleware**: Mengatur akses halaman berdasarkan peran (admin/user).
    - **Autentikasi Middleware**: Mengatur akses halaman hanya untuk user yang sudah login.
11. **Fitur Lain**
    - **Validasi Data**: Semua form menggunakan validasi Laravel.
    - **Notifikasi Sukses/Error**: Setelah aksi (tambah/edit/hapus), user mendapat notifikasi.

---

**Kesimpulan:**
Website ini adalah sistem manajemen perpustakaan digital dengan fitur lengkap: autentikasi, manajemen buku, kategori, anggota, peminjaman, dashboard statistik, profil pengguna, dan halaman statis. Hak akses diatur berdasarkan peran (admin/user), dan terdapat fitur keamanan seperti captcha.

