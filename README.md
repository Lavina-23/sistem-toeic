<!-- Improved compatibility of back to top link -->

<a id="readme-top"></a>

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/Lavina-23/sistem-toeic">
    <img src="public/images/logo-toeicin.png" alt="TOEICIN Logo" width="300">
  </a>

  <h3 align="center">TOEICIN</h3>

  <p align="center">
    Jembatan menuju dunia global dengan semangat nasional.
  </p>
</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">Deskripsi Projek</a>
      <ul>
        <li><a href="#built-with">Teknologi yang Digunakan</a></li>
      </ul>
    </li>
    <li><a href="#logo-and-philosophy">Filosofi Logo</a></li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->

## Deskripsi Projek

![alt text](/storage/app/public/img/image.png)
![alt text](/storage/app/public/img/dash-peserta.png)
TOEICIN adalah aplikasi web yang dirancang untuk membantu proses registrasi Ujian TOEIC yang diselenggarakan oleh UPA Bahasa Polinema yang bekerjasama dengan International Test Center (ITC), bersifat **WAJIB** terutama untuk mahasiswa Polinema sebagai prasyarat pengambilan ijazah (Sertifikat TOEIC berlaku selama 2 tahun). Ada dua jenis ujian TOEIC di Polinema:

-   **Gratis**: Mahasiswa mendapatkan kesempatan 1x selama masa studi di Polinema (biasanya untuk mahasiswa semester akhir, termasuk yang mengikuti program khusus seperti student’s exchange, joint degree/double degree).
-   **Mandiri/Berbayar**: Dengan harga khusus untuk mahasiswa, dosen, tendik, dan alumni Polinema.

Selama ini, UPA Bahasa mengalami kesulitan dalam mendata pendaftaran TOEIC dan menyortir mahasiswa yang sudah pernah mengikuti ujian gratis sebelumnya.

### Role (Multi Level)

-   Peserta
-   Admin UPA Bahasa
-   Admin ITC

### Fitur

Fitur yang dibuat meliputi:

-   **Authentication**: Seluruh pengguna dapat melakukan register, login dan logout.
-   **Fitur untuk Peserta**:
    -   **Pengumuman**: Mahasiswa dapat melihat pengumuman-pengumuman terkait tes TOEIC.
    -   **Pendaftaran TOEIC**: Mahasiswa dapat mengisi data diri mereka untuk mendaftar ujian TOEIC.
    -   **Formulir Pendaftaran Online**: Mahasiswa dapat mengisi data diri mereka untuk mendaftar ujian TOEIC.
    -   **Riwayat Tes Toeic**: Mahasiswa dapat melihat riwayat data pendaftarannya dan jika sudah melakukan tes maka score sekaligus visualisasi data statistik dari scorenya dapat dilihat disini (ngomong apa dah T-T).
    -   **Request Surat Pernyataan**: Bagi Mahasiswa yang memiliki alasan tertentu sehingga tidak mampu melakukan tes TOEIC dan Mahasiswa yang telah melakukan tes sebanyak 2x namun score masih dibawah 500 maka harus meminta surat pernyataan sebagai pengganti sertifikat TOEIC.
-   **Fitur untuk Admin UPA Bahasa**:

    -   **Verifikasi Hak Ujian Gratis**: Sistem secara otomatis memeriksa apakah mahasiswa masih memiliki kesempatan ujian gratis, sehingga daftar peserta yang valid bisa langsung dikelola.
    -   **Manajemen Pengumuman**: Admin dapat mempublikasikan jadwal ujian terbaru, lokasi, dan detail pelaksanaan melalui sistem. Admin dapat mempublikasikan informasi terkait pengambilan sertifikat ujian.
    -   **Manajemen Pengguna**: Admin dapat mengelola pengguna dan mendaftarkan pengguna.
    -   **Upload Score Tes TOEIC**: Admin dapat mengupload file hasil tes dari ITC yang nantinya score akan otomatis ditampilkan di dashboard peserta.
    -   **Verifikasi Surat Pernyataan**: Admin dapat melakukan verifikasi request surat pernyataan dari para Peserta dengan mempertimbangkan alasan dan bukti yang diberikan.

-   **Fitur untuk Admin ITC**:
    -   **Broadcast Chat Whatsapp**: Admin bisa membuat chat secara broadcast melalui website dengan cara mengupload file excel berisi daftar nomor telepon peserta, fitur ini berguna bagi admin ITC yang diharuskan menghubungi setiap peserta H-1 sebelum tes untuk meminta foto ruangan ujian.
    -   **Verifikasi Foto Ruangan Ujian**: Admin bisa melakukan verifikasi pada peserta yang sudah mengirimkan foto tempat mereka akan melakukan ujian.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## 🛠️ Teknologi yang Digunakan

-   [![Tailwind CSS](https://img.shields.io/badge/TailwindCSS-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
-   [![Flowbite](https://img.shields.io/badge/Flowbite-38BDF8?style=for-the-badge&logo=flowbite&logoColor=white)](https://flowbite.com)
-   [![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=black)](https://alpinejs.dev)
-   [![Axios](https://img.shields.io/badge/Axios-5A29E4?style=for-the-badge&logo=axios&logoColor=white)](https://axios-http.com)
-   [![Laravel](https://img.shields.io/badge/Laravel-Vite-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
-   [![PostCSS](https://img.shields.io/badge/PostCSS-DD3A0A?style=for-the-badge&logo=postcss&logoColor=white)](https://postcss.org)
-   [![Autoprefixer](https://img.shields.io/badge/Autoprefixer-DD3735?style=for-the-badge&logo=autoprefixer&logoColor=white)](https://github.com/postcss/autoprefixer)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- LOGO AND PHILOSOPHY -->

## Logo and Philosophy

<div align="center">
  <img src="public/images/logo-toeicin.png" alt="TOEICIN Logo" width="200"/>
</div>

Logo TOEICIN dirancang untuk merepresentasikan semangat pendidikan, nasionalisme 🇮🇩, dan pencapaian global 🌍 dalam pembelajaran bahasa Inggris 🇬🇧 untuk anak-anak Indonesia. Berikut adalah elemen dan makna filosofis dari logo:

### 1. 🧑‍🎓 Figur Manusia dengan Toga (Biru Tua)

-   **Makna**: Melambangkan siswa atau peserta tes yang siap menempuh ujian sebagai bagian dari pencapaian akademik.
-   **Filosofi Warna**: Biru tua mencerminkan _kepercayaan_ 🤝, _intelektualitas_ 📘, dan _stabilitas_ 🧭 — nilai penting dalam dunia pendidikan.

### 2. 🌊 Bentuk Grafis Bergelombang

-   **Makna**: Melambangkan dua bendera:
    -   🔴 **Merah**: Bendera Indonesia
    -   🔵 **Biru**: Bendera Inggris
-   **Filosofi**: Menunjukkan bahwa TOEICIN menjadi **jembatan** 🌉 antara pelajar Indonesia dengan kemampuan berbahasa Inggris global, tanpa menghilangkan semangat **nasionalisme** 🇮🇩.

### 3. ⭐ Bintang Emas dan Garis Lengkung

-   **Makna**:
    -   ⭐ **Bintang**: Simbol _cita-cita_ dan _pencapaian tinggi_.
    -   💛 **Garis Emas**: Mengelilingi logo dalam bentuk setengah hati ❤️ sebagai simbol _dukungan_ dan _perhatian_ terhadap perkembangan anak.
-   **Filosofi**: Menyiratkan bahwa TOEICIN tidak hanya berfokus pada hasil akademik, tetapi juga peduli terhadap proses pertumbuhan anak secara menyeluruh 🌱.

### 🎨 Warna Utama

-   🔵 **Biru Tua**: Intelektual, Stabil, Percaya Diri
-   🔴 **Merah**: Semangat, Nasionalisme
-   💛 **Emas**: Prestasi, Perlindungan, Harapan

### 🏫 Tagline

> **TOEICIN**  
> _Jembatan menuju dunia global dengan semangat nasional._ 🌏❤️

<p align="right">(<a href="#readme-top">back to top</a>)</p>
