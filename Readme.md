# LAPORAN TUGAS AKHIR PRAKTIKUM PEMROGRAMAN WEB : PERPUSTAKAAN
 
DISUSUN OLEH :
- Jenar Mahesa Putri
L200230038
- Luthfia Martha Puspita
L200230064
- Olga Paramartha Sani
L200230065
- Aulia Rachmadina 
L200230074
  
TEKNIK INFORMATIKA
FAKULTAS KOMUNIKASI DAN INFORMATIKA
UNIVERSITAS MUHAMMADIYAH SURAKARTA
2024/2025

DAFTAR ISI
BAB I	3
PENDAHULUAN	3
1.1 Latar Belakang	3
1.2 Tujuan pembuatan aplikasi	3
BAB II	5
PEMBAHASAN	5
2.1 Deskripsi Aplikasi	5
2.2 Fitur-fitur utama	5
2.3 Teknologi yang digunakan	5
2.4 Cara instalasi dan menjalankan aplikasi	5
2.5 Screenshot aplikasi untuk setiap fitur utama	5
2.6 Manual penggunaan aplikasi	5
2.7 Pembagian Tugas Anggota Kelompok	6
BAB III	7
PENUTUP	7
3.1 Kesimpulan	7
3.2 Saran Pengembangan	7

BAB I
PENDAHULUAN

1.1 Latar Belakang 

Dalam era digital yang semakin maju, aksesibilitas layanan informasi menjadi sangat penting, terutama bagi mahasiswa yang membutuhkan sumber daya untuk mendukung proses belajar mereka. Perpustakaan sebagai pusat informasi dan pengetahuan memiliki peran yang krusial dalam menyediakan akses ke berbagai sumber daya, baik buku fisik maupun digital. Namun, seringkali mahasiswa menghadapi kendala dalam mengakses layanan perpustakaan secara langsung. Seperti keterbatasan waktu dan lokasi. Oleh karena itu, pengembangan aplikasi perpustakaan berbasis web dapat diakses secara online menjadi suatu kebutuhan yang mendesak. Aplikasi berbasis web ini dirancang untuk memberikan kemudahan bagi pengguna dalam mengakses katalog dan layanan perpustakaan kapan saja dan dimana saja melalui perangkat yang terhubung ke internet. Selain itu dengan adanya aplikasi perpustakaan berbasis web, proses pengelolaan data dan administrasi lebih efisien. Petugas perpustakaan dapat dengan mudah memperbarui katalog buku, mengelola data anggota, serta memantau data peminjaman buku dan pengembalian secara otomatis. Hal ini tidak hanya mengurangi beban kerja administratif, tetapi juga meminimalisir terjadinya kesalahan pencatatan yang sering terjadi pada sistem manual.
Selain meningkatkan aksesibilitas, aplikasi perpustakaan berbasis web juga mampu memberikan pelayanan yang lebih cepat, transparan, serta mampu memperluas jangkauan layanan hingga ke pengguna di luar lokasi fisik perpustakaan. Fitur-fitur otomatis seperti pemberitahuan pengingat, reservasi buku, dan laporan otomatis dapat meningkatkan kualitas pelayanan dan kepuasan pengguna. Lebih dari itu, pengembangan sistem ini juga mendukung pengelolaan sumber daya digital dan memastikan keberlanjutan layanan perpustakaan di era digitalisasi yang terus berkembang
 
1.2 Tujuan Pembuatan Aplikasi

Tujuan utama dalam pembuatan aplikasi perpustakaan ini adalah sebagai berikut:
1. Meningkatkan aksesibilitas layanan bagi pengguna mahasiswa karena mereka dapat mengakses katalog dan layanan perpustakaan kapan saja melalui perangkat yang terhubung internet.
2. Memudahkan proses administrasi seperti pencatatan peminjaman, pengembalian, dan pengelolaan data buku serta anggota secara otomatis tanpa perlu proses manual yang rumit.
3. Mengurangi risiko kehilangan data atau kesalahan pencatatan, karena semua data tersimpan secara digital dan terpusat.
4. Mendukung pengembangan layanan berbasis teknologi, agar perpustakaan tetap relevan dan mampu bersaing di era digital.

BAB II
PEMBAHASAN

2.1 Deskripsi Aplikasi 

Aplikasi perpustakaan ini dirancang untuk memberikan kemudahan dalam pengelolaan data buku, anggota, serta proses peminjaman dan pengembalian buku. Dengan antarmuka yang user-friendly, pengguna dapat dengan mudah menavigasi berbagai fitur yang tersedia. Aplikasi ini juga dilengkapi dengan sistem autentikasi untuk memastikan bahwa hanya pengguna yang terdaftar yang dapat mengakses layanan tertentu.

2.2 Fitur-Fitur Utama

Fitur utama yang digunakan adalah sebagai berikut :
1. Katalog buku 
2. Peminjaman buku
3. Pengembalian buku dan perhitungan denda


2.3 Teknologi yang Digunakan

Aplikasi ini dibangun menggunakan berbagai teknologi modern untuk memastikan
performa dan keamanan yang optimal seperti berikut:
1. Frontend : HTML, CSS, dan JavaScript digunakan untuk membangun antarmuka pengguna yang responsif dan interaktif.
2.Backend : PHP digunakan sebagai bahasa pemrograman server side untuk menangani logika aplikasi dan interaksi dengan database.
3.Database : MYSQL digunakan untuk menyimpan data buku, anggota, dan transaksi peminjaman.
4.Framework : Bootstrap digunakan untuk memastikan tampilan aplikasi responsif

2.4 Cara Instalasi dan Menjalankan Aplikasi
Sebelum memulai instalasi, pastikan sistem anda memenuhi persyaratan berikut :
Web server, PHP versi 7.0 atau lebih tinggi, MySQL, Browser web modern (Chrome, Firefox, Safari).
Cara Meng-instalasi Aplikasi:
1. Menginstall XAMPP 
2. Mengunduh File Perpustakaan dari repository yang telah kami sediakan.
3.Mengekstrak file ZIP yang telah di unduh ke dalam folder XAMPP di bagian HtDoc.
4. Membuat database baru di MySQL dengan nama  perpustakaan (CREATE DATABASE)
5.Import file SQL yang sudah di unduh(perpustakaan.sql) yang dimasukkan kedalam databases yang telah dibuat.
Cara Menjalankan Aplikasi:
1. Setelah langkah mengunduh aplikasi selesai, Buka Browser web 
2. Masukkan URL aplikasi seperti dibawah ini
http://localhost/nama_file

2.5 Screenshot Aplikasi untuk Setiap Fitur Utama

Gambar 1.1 Tampilan Page Landing.

Gambar 1.2 Tampilan Login sebagai admin.

Gambar 1.3 Tampilan daftar Buku perpustakaan.

Gambar 1.4 Tampilan pada Edit Buku.

Gambar 1.5 Tampilan pada saat menghapus Buku.

Gambar 1.6 Tampilan page untuk menambah buku.

Gambar 1.7 Tampilan Login sebagai user.

Gambar 1.8 Tampilan Koleksi Buku.

Gambar 1.9 Tampilan peminjaman dan pengembalian buku.


2.6 Manual Penggunaan Aplikasi
Manual penggunaan aplikasi ini bertujuan untuk membantu pengguna memahami  
cara menggunakan aplikasi dengan efektif
1. Login : Pengguna harus melakukan login menggunakan username dan password yang telah terdaftar.
2. Mencari buku : Fitur pencarian di katalog untuk menemukan buku yang diinginkan. Pengguna dapat memasukkan kata kunci untuk mempercepat pencarian.
3.Peminjaman buku : Pengguna dapat memilih buku tersebut dan mengikuti instruksi untuk menyelesaikan proses peminjaman. Dan pengguna harus memastikan bahwa ketersediaan stok buku sebelum melakukan peminjaman buku.
4. Pengembalian buku : Pengguna setelah menemukan buku yang di inginkan, selanjutnya dapat memilih buku untuk di kembalikan.
5. Pembayaran denda : Pembayaran denda akan bekerja jika pengguna telah melewati waktu pengembalian buku.

2.7 Pembagian Tugas Anggota Kelompok
Pembagian tugas dalam pengembangan aplikasi ini dilakukan untuk memaksimalkan  
efisiensi dan hasil akhir. Berikut adalah pembagian tugas anggota kelompok :   
Anggota 1 : Jenar Mahesa Putri (L200230038)
 - Membuat kode 
 - Membuat PPT
 - Membuat file kode login perpustakaan
 - Membuat file kode landing 
 - Membuat file kode daftar buku perpustakaan untuk admin
 - Menyempurnakan file kode edit dan hapus buku untuk admin
  Anggota 2 : Luthfia Martha Puspita (L200230064)
 - Membuat laporan
 - Membuat file kode sistem peminjaman dan pengembalian buku
 - Menyempurnakan File kode sistem peminjaman dan pengembalian buku.
 - Membuat file kode koleksi buku populer
Anggota 3 : Olga Paramartha Sani (L200230065)
 - Membuat Laporan
 - Membuat file kode koleksi buku populer
 - Menyempurnakan file kode koleksi buku populer 
Anggota 4 : Aulia Rachmadina (L200230074)
 - Pembuatan kode 
 - Penentuan tema
 - Membuat file kode login perpustakaan
 - Membuat file kode landing 
 - Membuat file kode daftar buku perpustakaan untuk admin
 - Membuat file kode edit dan hapus buku untuk admin  

BAB III
PENUTUP

3.1 Kesimpulan 
Pengembangan aplikasi perpustakaan berbasis web merupakan inovasi yang sangat penting dalam menghadapi tantangan akses layanan perpustakaan secara langsung, seperti keterbatasan waktu dan lokasi. Sistem ini memungkinkan pengguna, terutama mahasiswa, untuk mengakses katalog dan layanan perpustakaan secara online kapan saja dan di mana saja melalui perangkat yang terkoneksi internet, sehingga meningkatkan fleksibilitas dan kenyamanan bagi pengguna. 

3.2 Saran Pengembangan
1. Untuk pengembangan lebih lanjut, beberapa saran yang dapat dipertimbangkan adalah:
2. Pengembangan ini bisa digunakan khalayak umum
3. Peningkatan fitur dan menambahkan fitur 
4. Pengembangan ke aplikasi Mobile untuk meningkatkan aksesibilitas bagi pengguna yang lebih simple menggunakan perangkat seluler.
