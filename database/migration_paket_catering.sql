-- Migration: Membuat tabel paket_catering untuk fitur Catering Nasi Kotak
-- Serta data contoh untuk pengecekan

CREATE TABLE IF NOT EXISTS paket_catering (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_paket VARCHAR(200) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    isi_paket TEXT NOT NULL,
    porsi INT(11) NOT NULL DEFAULT 1,
    foto VARCHAR(255) DEFAULT NULL,
    status ENUM('aktif', 'nonaktif') DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data contoh paket catering (4 paket)
INSERT INTO paket_catering (nama_paket, harga, isi_paket, porsi, foto, status) VALUES
('Paket Hemat', 18000, 'Nasi, Ayam Goreng, Tumis Sayur, Kerupuk, Sambal', 1, 'default.jpg', 'aktif'),
('Paket Standar', 25000, 'Nasi, Ayam Bakar, Sayur Lodeh, Tahu/Tempe, Kerupuk, Buah, Air Mineral', 1, 'default.jpg', 'aktif'),
('Paket Spesial', 35000, 'Nasi, Ayam/Daging Sapi, Sayur, Telur Dadar/Pindang, Kerupuk, Buah, Puding, Air Mineral', 1, 'default.jpg', 'aktif'),
('Paket Premium', 45000, 'Nasi, Pilihan Daging (Ayam/Sapi), Sayur, Telur, Kerupuk, Buah Potong, Dessert, Air Mineral', 1, 'default.jpg', 'aktif');