-- Migration: Tabel item kustomisasi per paket catering
-- Setiap paket memiliki item per kategori (Nasi, Lauk, Sayur, Tambahan)
-- is_default=1 artinya item bawaan/default yang otomatis terpilih

CREATE TABLE IF NOT EXISTS item_paket_catering (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    paket_id INT(11) NOT NULL,
    kategori VARCHAR(50) NOT NULL COMMENT 'Nasi, Lauk, Sayur, Tambahan',
    nama_item VARCHAR(200) NOT NULL,
    harga DECIMAL(10,2) NOT NULL DEFAULT 0,
    is_default TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (paket_id) REFERENCES paket_catering(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data contoh untuk "Paket Hemat" (id=1)
-- Kategori Nasi
INSERT INTO item_paket_catering (paket_id, kategori, nama_item, harga, is_default) VALUES
(1, 'Nasi', 'Nasi Putih', 0, 1),
(1, 'Nasi', 'Nasi Liwet', 2000, 0);

-- Kategori Lauk
INSERT INTO item_paket_catering (paket_id, kategori, nama_item, harga, is_default) VALUES
(1, 'Lauk', 'Ayam Goreng', 0, 1),
(1, 'Lauk', 'Ayam Bakar', 3000, 0),
(1, 'Lauk', 'Ayam Geprek', 4000, 0);

-- Kategori Sayur
INSERT INTO item_paket_catering (paket_id, kategori, nama_item, harga, is_default) VALUES
(1, 'Sayur', 'Capcay', 0, 1),
(1, 'Sayur', 'Kangkung', 0, 0),
(1, 'Sayur', 'Tumis Buncis', 1000, 0);

-- Kategori Tambahan
INSERT INTO item_paket_catering (paket_id, kategori, nama_item, harga, is_default) VALUES
(1, 'Tambahan', 'Kerupuk', 0, 1),
(1, 'Tambahan', 'Sambal', 0, 1),
(1, 'Tambahan', 'Telur Dadar', 3000, 0),
(1, 'Tambahan', 'Perkedel', 2000, 0);

-- Data contoh untuk "Paket Standar" (id=2)
INSERT INTO item_paket_catering (paket_id, kategori, nama_item, harga, is_default) VALUES
(2, 'Nasi', 'Nasi Putih', 0, 1),
(2, 'Nasi', 'Nasi Uduk', 2000, 0);

INSERT INTO item_paket_catering (paket_id, kategori, nama_item, harga, is_default) VALUES
(2, 'Lauk', 'Ayam Bakar', 0, 1),
(2, 'Lauk', 'Ayam Goreng', 3000, 0),
(2, 'Lauk', 'Ikan Goreng', 5000, 0);

INSERT INTO item_paket_catering (paket_id, kategori, nama_item, harga, is_default) VALUES
(2, 'Sayur', 'Sayur Lodeh', 0, 1),
(2, 'Sayur', 'Capcay', 0, 0),
(2, 'Sayur', 'Tumis Kangkung', 1000, 0);

INSERT INTO item_paket_catering (paket_id, kategori, nama_item, harga, is_default) VALUES
(2, 'Tambahan', 'Tahu/Tempe', 0, 1),
(2, 'Tambahan', 'Kerupuk', 0, 1),
(2, 'Tambahan', 'Buah', 0, 1),
(2, 'Tambahan', 'Air Mineral', 0, 1),
(2, 'Tambahan', 'Telur Dadar', 3000, 0);

-- Data contoh untuk "Paket Spesial" (id=3)
INSERT INTO item_paket_catering (paket_id, kategori, nama_item, harga, is_default) VALUES
(3, 'Nasi', 'Nasi Putih', 0, 1),
(3, 'Nasi', 'Nasi Liwet', 2000, 0);

INSERT INTO item_paket_catering (paket_id, kategori, nama_item, harga, is_default) VALUES
(3, 'Lauk', 'Ayam Bakar', 0, 1),
(3, 'Lauk', 'Daging Sapi Lada Hitam', 5000, 0),
(3, 'Lauk', 'Ayam Geprek', 2000, 0);

INSERT INTO item_paket_catering (paket_id, kategori, nama_item, harga, is_default) VALUES
(3, 'Sayur', 'Sayur Asem', 0, 1),
(3, 'Sayur', 'Sayur Lodeh', 0, 0),
(3, 'Sayur', 'Capcay', 0, 0);

INSERT INTO item_paket_catering (paket_id, kategori, nama_item, harga, is_default) VALUES
(3, 'Tambahan', 'Telur Dadar', 0, 1),
(3, 'Tambahan', 'Telur Pindang', 0, 1),
(3, 'Tambahan', 'Kerupuk', 0, 1),
(3, 'Tambahan', 'Buah', 0, 1),
(3, 'Tambahan', 'Puding', 0, 1),
(3, 'Tambahan', 'Air Mineral', 0, 1);

-- Data contoh untuk "Paket Premium" (id=4)
INSERT INTO item_paket_catering (paket_id, kategori, nama_item, harga, is_default) VALUES
(4, 'Nasi', 'Nasi Putih', 0, 1),
(4, 'Nasi', 'Nasi Liwet', 2000, 0),
(4, 'Nasi', 'Nasi Uduk', 3000, 0);

INSERT INTO item_paket_catering (paket_id, kategori, nama_item, harga, is_default) VALUES
(4, 'Lauk', 'Ayam Bakar', 0, 1),
(4, 'Lauk', 'Daging Sapi', 0, 1),
(4, 'Lauk', 'Ayam Goreng', 2000, 0),
(4, 'Lauk', 'Ikan Gurame Bakar', 5000, 0);

INSERT INTO item_paket_catering (paket_id, kategori, nama_item, harga, is_default) VALUES
(4, 'Sayur', 'Sayur Asem', 0, 1),
(4, 'Sayur', 'Sayur Lodeh', 0, 0),
(4, 'Sayur', 'Capcay', 0, 0),
(4, 'Sayur', 'Tumis Kangkung', 1000, 0);

INSERT INTO item_paket_catering (paket_id, kategori, nama_item, harga, is_default) VALUES
(4, 'Tambahan', 'Telur', 0, 1),
(4, 'Tambahan', 'Kerupuk', 0, 1),
(4, 'Tambahan', 'Buah Potong', 0, 1),
(4, 'Tambahan', 'Dessert', 0, 1),
(4, 'Tambahan', 'Air Mineral', 0, 1);