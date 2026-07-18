ya# Plan (Diagnosa Logo Tidak Muncul di PDF)

## Information Gathered
- `application/views/admin/laporan_pdf.php` memuat logo dengan:
  - `$logoPath = FCPATH . 'assets/img/LOGO.png';`
  - `<img src="<?php echo $logoPath; ?>" ... />`
- File logo ada di filesystem: `assets/img/LOGO.png`.
- Controller `application/controllers/Admin/Laporan.php` membuat Dompdf dengan composer dan mengatur font. Belum terlihat setting khusus `isRemoteEnabled` atau `setChroot`.
- Folder chroot/domPDF restriction belum dicek secara eksplisit (belum ditemukan/diobservasi di controller).

## Plan (Urutan Fix Sesuai Diagnosa)
1. (Opsi 1) Cek apakah dompdf mengaktifkan `isRemoteEnabled` di instantiation options. Jika belum, sementara belum kita ubah (karena ini absolute path), tapi tetap kita pastikan tidak ada konfigurasi lain yang membuat akses remote/atau image jadi ditolak.
2. (Opsi 2) Tambahkan/konfirmasi opsi chroot agar dompdf mengizinkan akses ke folder project:
   - `$options->setChroot('/Applications/XAMPP/xamppfiles/htdocs/NINGNONG2');`
3. (Opsi 3) Verifikasi path absolute logo di view sudah benar persis: `FCPATH . 'assets/img/LOGO.png'` (sudah cocok dan file eksis).
4. (Opsi 4) Jika tetap tidak tampil, baru ganti src ke `base_url('assets/img/LOGO.png')` dan set `$options->set('isRemoteEnabled', true);`.
5. Jalankan generate ulang PDF dan konfirmasi logo tampil proporsional.

## Dependent Files to be edited
- `application/controllers/Admin/Laporan.php`
- `application/views/admin/laporan_pdf.php` (hanya bila langkah 4 diperlukan)

## Followup steps
- Generate ulang PDF untuk satu periode.
- Pastikan logo tampil dan ukurannya tidak terdistorsi.

