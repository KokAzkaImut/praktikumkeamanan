

## Gambar 1 – XSS pada Modul Komentar (Vulnerable)
**Deskripsi:** Screenshot menunjukkan payload `<script>alert('XSS')</script>` dieksekusi.
**Analisis:** Tidak ada sanitasi input sehingga browser menjalankan script.

## Gambar 2 – XSS Dimitigasi (Secure)
**Deskripsi:** Payload ditampilkan sebagai teks.
**Analisis:** Fungsi `htmlspecialchars()` mencegah eksekusi script.

## Gambar 3 – LFI Berhasil (Vulnerable)
**Deskripsi:** File sensitif berhasil diakses melalui parameter URL.
**Analisis:** Aplikasi tidak memvalidasi path file.

## Gambar 4 – LFI Dicegah (Secure)
**Deskripsi:** Akses file ditolak.
**Analisis:** Whitelist file diterapkan.

## Gambar 5 – Rate Limiting Login
**Deskripsi:** Login diblokir setelah beberapa percobaan.
**Analisis:** Rate limiting mengurangi risiko brute force.
