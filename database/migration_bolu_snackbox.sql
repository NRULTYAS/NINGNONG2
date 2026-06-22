-- Migration: Tambah kolom snack_box untuk memisahkan produk per loyang dan per potong di Snack Box

ALTER TABLE tbl_produk
ADD COLUMN snack_box TINYINT(1) DEFAULT 1 AFTER updated_at;

-- Update produk bolu loyang agar tidak muncul di Snack Box
UPDATE tbl_produk SET snack_box = 0 WHERE id_produk IN (1, 2);

-- Tambah produk bolu versi potong untuk Snack Box
INSERT INTO tbl_produk (nama_produk, id_kategori, rasa, harga, stok, deskripsi, gambar, snack_box) VALUES
('Bolu Pandan (Potong)', 1, 'Pandan', 2500, 100, 'Bolu pandan per potong untuk Snack Box', 'bolu_pandan.jpg', 1),
('Bolu Coklat (Potong)', 1, 'Coklat', 2500, 100, 'Bolu coklat per potong untuk Snack Box', 'bolu_coklat.jpg', 1);
