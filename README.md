<h1>POLIKLINIK UDINUS</h1>
# Poli BK - README

## Pendahuluan

Proyek ini merupakan sistem manajemen poli yang memungkinkan dokter dan pasien untuk mengelola informasi secara efisien. Sistem ini mencakup fitur login untuk dokter, admin, dan pasien, serta pendaftaran untuk pasien baru.

---

## Panduan Instalasi

### 1. Download dan Ekstrak File

1. Unduh file dari repository GitHub.
2. Ekstrak file tersebut ke dalam folder `xampp/htdocs` di komputer Anda.

### 2. Persyaratan

- **PHP Versi Terbaru**: Pastikan Anda telah menginstal versi terbaru dari PHP.
- **XAMPP**: Unduh dan instal [XAMPP](https://www.apachefriends.org/index.html).

### 3. Menjalankan XAMPP

1. Buka aplikasi XAMPP.
2. Aktifkan module `Apache` dan `MySQL`.

### 4. Membuat Database

1. Buka browser web Anda dan akses: [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/).
2. Buat database baru dengan nama: **`poli_bk`**.
3. Impor file SQL yang terdapat di: `poli_bk-main/database/poli_bk.sql`.

---

## Cara Kerja Website

### 1. Membuka Website

1. Buka web browser.
2. Akses [http://localhost/poli\_bk-main/](http://localhost/poli_bk-main/).

### 2. Fitur Login dan Pendaftaran

- Terdapat halaman login untuk **dokter** dan **pasien** pada tampilan awal (dashboard).
- Anda juga dapat mendaftar sebagai pasien baru melalui fitur yang tersedia.

### 3. Login Dokter

- **Username**: Gunakan username dokter.
- **Password**: Sama dengan username.

### 4. Login Admin

- **Username**: `admin`
- **Password**: `admin123`

---

## Catatan

- Pastikan semua module di XAMPP berjalan dengan baik untuk menghindari error saat menjalankan website.
- Jika mengalami masalah, periksa file konfigurasi dan pastikan database telah diimpor dengan benar.

---

**Terima Kasih!**
