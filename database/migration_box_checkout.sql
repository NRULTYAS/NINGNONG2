-- Migration: Menambahkan kolom untuk fitur Box Checkout
-- Menambahkan kolom tanggal_kirim, status_pembayaran, detail_box pada tabel tbl_pesanan

ALTER TABLE tbl_pesanan
ADD COLUMN tanggal_kirim DATE NULL AFTER catatan,
ADD COLUMN status_pembayaran VARCHAR(50) DEFAULT 'Menunggu Konfirmasi' AFTER status,
ADD COLUMN detail_box TEXT NULL AFTER status_pembayaran;