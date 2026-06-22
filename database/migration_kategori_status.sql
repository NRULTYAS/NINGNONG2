-- Migration: Menambahkan kolom status pada tabel tbl_kategori
-- Menambahkan kolom status (enum: aktif/nonaktif) untuk manajemen kategori admin

ALTER TABLE tbl_kategori 
ADD COLUMN status ENUM('aktif', 'nonaktif') DEFAULT 'aktif' AFTER deskripsi;

-- Update semua kategori yang sudah ada menjadi aktif
UPDATE tbl_kategori SET status = 'aktif' WHERE status IS NULL OR status = '';