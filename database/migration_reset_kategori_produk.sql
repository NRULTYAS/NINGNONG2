-- Migration: Reset Total Sistem Kategori Produk
-- 1. Nonaktifkan/hapus semua kategori lama
-- 2. Buat 4 kategori baru (Kue Asin, Kue Manis, Kue Kering, Minuman)
-- 3. Set semua produk menjadi id_kategori = NULL

-- Pastikan foreign key check dimatikan sementara
SET FOREIGN_KEY_CHECKS = 0;

-- 1. Buat kolom id_kategori di tbl_produk bisa NULL (jika masih NOT NULL)
ALTER TABLE tbl_produk MODIFY COLUMN id_kategori INT(11) NULL;

-- 2. Set semua produk ke NULL (tidak ada kategori)
UPDATE tbl_produk SET id_kategori = NULL;

-- 3. Hapus semua kategori lama (termasuk Nyiru/Tampah)
DELETE FROM tbl_kategori;

-- 4. Insert 4 kategori baru dengan status aktif
INSERT INTO tbl_kategori (nama_kategori, deskripsi, status) VALUES
('Kue Asin', 'Kue dengan rasa asin dan gurih seperti risoles, pastel, dan lain-lain', 'aktif'),
('Kue Manis', 'Kue dengan rasa manis tradisional seperti bolu, lapis, dan lumpur', 'aktif'),
('Kue Kering', 'Kue kering, cookies, dan wafer yang renyah', 'aktif'),
('Minuman', 'Berbagai minuman untuk menemani kue', 'aktif');

-- 5. Pastikan auto increment reset setelah delete-all
ALTER TABLE tbl_kategori AUTO_INCREMENT = 1;

-- 6. Kembalikan foreign key check
SET FOREIGN_KEY_CHECKS = 1;
