# UjiCoba Kerentanan - Keamanan Data Dan Informasi (UAS)

**Nama:** Muhammad Rikza Rizqi Al Azka
**NIM:** C2C023070
**Mata Kuliah:** Praktikum Keamanan Data & Informasi  
**Dosen Pengampu:** Dr. Dhendra Marutho, S.Kom., M.Kom

---

## Deskripsi Project
Aplikasi web sederhana ini dibuat untuk mensimulasikan celah keamanan umum pada website (Vulnerabilities) dan bagaimana cara memperbaikinya (Secure Coding). Aplikasi dibagi menjadi dua lingkungan:
1.  **Vulnerable Mode (Merah):** Kode sengaja dibuat tidak aman untuk demonstrasi eksploitasi.
2.  **Secure Mode (Hijau):** Kode telah dipatch dengan teknik mitigasi keamanan.

###  Teknologi
* **Language:** Native PHP (Tanpa Framework)
* **Frontend:** Bootstrap 5 (CDN) & Custom CSS
* **Server:** Apache (XAMPP/Laragon)

---

##  1. Deskripsi Kerentanan (Vulnerability Analysis)

### A. Authentication Bypass (Login Module)
* **Jenis:** Brute Force Attack & Weak Password Policy.
* **Penyebab:**
    * Sistem tidak membatasi jumlah percobaan login (*No Rate Limiting*).
    * Pesan error terlalu spesifik ("Password salah"), memicu *User Enumeration*.
    * Credential disimpan secara *hardcoded* dan *plaintext*.

### B. Cross-Site Scripting (XSS)
* **Jenis:** Reflected XSS.
* **Penyebab:**
    * Input pengguna pada formulir komentar langsung ditampilkan kembali (*echo*) ke browser tanpa filter.
    * Browser mengeksekusi tag HTML/JavaScript yang disisipkan penyerang (misal: `<script>alert('Hacked by Me!')</script>`).

### C. Local File Inclusion (LFI)
* **Jenis:** Directory Traversal.
* **Penyebab:**
    * Parameter URL `?file=` langsung diproses oleh fungsi `include()` tanpa validasi.
    * Penyerang dapat memanipulasi path menggunakan `../` untuk mengakses file sensitif server (misal: source code index).

---

## 2. Teknik Mitigasi (Secure Implementation)

### A. Pengamanan Login
1.  **Anti-Brute Force (Rate Limiting):** Menggunakan *PHP Session* untuk menghitung percobaan login gagal. Jika gagal 3x, akun dikunci sementara selama 30 detik.
2.  **CSRF Token:** Menambahkan token unik pada form login untuk mencegah serangan lintas situs.
3.  **Generic Error Message:** Mengubah pesan error menjadi umum ("Kredensial tidak valid") agar tidak membocorkan validitas username.

### B. Pencegahan XSS
1.  **Input Sanitization:** Menggunakan fungsi bawaan PHP `htmlspecialchars($input, ENT_QUOTES, 'UTF-8')`.
2.  **Mekanisme:** Fungsi ini mengubah karakter berbahaya seperti `<` menjadi `&lt;` dan `>` menjadi `&gt;`, sehingga browser membacanya sebagai teks biasa, bukan kode eksekusi.

### C. Pencegahan LFI
1.  **Whitelisting:** Membuat daftar array file yang diizinkan (misal: `['intro.txt', 'readme.txt']`).
2.  **Validasi Ketat:** Sebelum melakukan `include()`, sistem mengecek apakah input user ada di dalam daftar whitelist (`in_array`). Jika tidak, akses ditolak.

---

##  3. Analisis Risiko Singkat

Berikut adalah analisis risiko pada mode Vulnerable (sebelum mitigasi):

### 1. Modul Login (Authentication)
* **Dampak (Impact): CRITICAL**
    Penyerang bisa mengambil alih akun administrator secara penuh dan mengontrol sistem.
* **Kemungkinan (Likelihood): HIGH**
    Password yang digunakan lemah dan mudah ditebak menggunakan *tools* otomatis.
* **Prioritas Perbaikan:** Utama (P1).

### 2. Modul File Viewer (LFI)
* **Dampak (Impact): HIGH**
    Potensi kebocoran *source code* aplikasi atau konfigurasi server yang sensitif.
* **Kemungkinan (Likelihood): MEDIUM**
    Penyerang perlu menebak struktur folder target untuk mendapatkan file yang valid.
* **Prioritas Perbaikan:** Kedua (P2).

### 3. Modul Komentar (XSS)
* **Dampak (Impact): MEDIUM**
    Dapat mencuri *session cookie* milik pengguna lain atau melakukan *redirect* ke situs berbahaya.
* **Kemungkinan (Likelihood): HIGH**
    Sangat mudah dieksekusi, cukup dengan mengirimkan link yang sudah disisipi script.
* **Prioritas Perbaikan:** Ketiga (P3).

---

## 🔗 Link Repository
Kode sumber lengkap dapat diakses di:
**https://github.com/KokAzkaImut/praktikumkeamanan**

---
*Dibuat untuk memenuhi tugas UAS Praktikum Keamanan Data & Informasi 2026.*