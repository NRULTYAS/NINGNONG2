-- Migration: Menambahkan kolom jumlah_dus pada tabel tbl_pesanan
-- Digunakan untuk fitur checkout dengan minimal pemesanan 15 dus

ALTER TABLE tbl_pesanan
ADD COLUMN jumlah_dus INT(11) NOT NULL DEFAULT 1 AFTER alamat_pengiriman;