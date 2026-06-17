-- Database: ningnong_kue_basah
-- UMKM NINGNONG Kue Basah

CREATE DATABASE IF NOT EXISTS ningnong_kue_basah CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE ningnong_kue_basah;

-- Tabel User (Pelanggan & Admin)
CREATE TABLE tbl_user (
    id_user INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    no_hp VARCHAR(20),
    alamat TEXT,
    role ENUM('admin','pelanggan') DEFAULT 'pelanggan',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Kategori Kue
CREATE TABLE tbl_kategori (
    id_kategori INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Produk Kue
CREATE TABLE tbl_produk (
    id_produk INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(150) NOT NULL,
    id_kategori INT(11) NOT NULL,
    rasa VARCHAR(100) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    stok INT(11) NOT NULL DEFAULT 0,
    deskripsi TEXT,
    gambar VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_kategori) REFERENCES tbl_kategori(id_kategori) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Pesanan
CREATE TABLE tbl_pesanan (
    id_pesanan INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_user INT(11) NOT NULL,
    kode_pesanan VARCHAR(50) NOT NULL UNIQUE,
    nama_penerima VARCHAR(100) NOT NULL,
    no_hp_penerima VARCHAR(20) NOT NULL,
    alamat_pengiriman TEXT NOT NULL,
    total_harga DECIMAL(12,2) NOT NULL,
    status ENUM('pending','diproses','dikirim','selesai','dibatalkan') DEFAULT 'pending',
    metode_pembayaran VARCHAR(50),
    bukti_pembayaran VARCHAR(255),
    catatan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES tbl_user(id_user) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Detail Pesanan
CREATE TABLE tbl_detail_pesanan (
    id_detail INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_pesanan INT(11) NOT NULL,
    id_produk INT(11) NOT NULL,
    jumlah INT(11) NOT NULL,
    harga_satuan DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(12,2) NOT NULL,
    FOREIGN KEY (id_pesanan) REFERENCES tbl_pesanan(id_pesanan) ON DELETE CASCADE,
    FOREIGN KEY (id_produk) REFERENCES tbl_produk(id_produk) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Keranjang (opsional, bisa juga pakai session)
CREATE TABLE tbl_keranjang (
    id_keranjang INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_user INT(11) NOT NULL,
    id_produk INT(11) NOT NULL,
    jumlah INT(11) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES tbl_user(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_produk) REFERENCES tbl_produk(id_produk) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Awal Admin
INSERT INTO tbl_user (nama, email, password, no_hp, alamat, role) VALUES
('Admin Ningnong', 'admin@ningnong.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '081234567890', 'Jl. Kue Basah No. 1, Jakarta', 'admin');

-- Data Kategori
INSERT INTO tbl_kategori (nama_kategori, deskripsi) VALUES
('Bolu', 'Berbagai macam bolu basah tradisional'),
('Kue Lapis', 'Kue lapis legit dan tradisional'),
('Brownies', 'Brownies kukus dan panggang'),
('Donat', 'Donat kentang dan donat jadul'),
('Pukis', 'Kue pukis dengan berbagai rasa'),
(' Lumpur', 'Kue lumpur tradisional');

-- Data Produk
INSERT INTO tbl_produk (nama_produk, id_kategori, rasa, harga, stok, deskripsi, gambar) VALUES
('Bolu Pandan', 1, 'Pandan', 25000, 20, 'Bolu pandan lembut dengan aroma pandan alami', 'bolu_pandan.jpg'),
('Bolu Coklat', 1, 'Coklat', 28000, 15, 'Bolu coklat manis dengan taburan meses', 'bolu_coklat.jpg'),
('Kue Lapis Rainbow', 2, 'Rainbow', 35000, 10, 'Kue lapis rainbow warna-warni dengan rasa manis legit', 'lapis_rainbow.jpg'),
('Kue Lapis Pandan', 2, 'Pandan', 32000, 12, 'Kue lapis pandan dengan santan kelapa asli', 'lapis_pandan.jpg'),
('Brownies Coklat', 3, 'Coklat', 30000, 18, 'Brownies coklat lembut dan lumer di mulut', 'brownies_coklat.jpg'),
('Brownies Keju', 3, 'Keju', 32000, 15, 'Brownies keju dengan taburan keju parut melimpah', 'brownies_keju.jpg'),
('Donat Kentang Coklat', 4, 'Coklat', 4000, 50, 'Donat kentang empuk dengan glaze coklat', 'donat_coklat.jpg'),
('Donat Kentang Keju', 4, 'Keju', 4500, 45, 'Donat kentang dengan taburan keju parut', 'donat_keju.jpg'),
('Pukis Coklat', 5, 'Coklat', 3000, 60, 'Pukis coklat manis dengan tekstur lembut', 'pukis_coklat.jpg'),
('Pukis Keju', 5, 'Keju', 3500, 55, 'Pukis keju gurih dengan taburan keju di atasnya', 'pukis_keju.jpg'),
('Kue Lumpur Pandan', 6, 'Pandan', 4000, 40, 'Kue lumpur pandan tradisional dengan tekstur lembut', 'lumpur_pandan.jpg'),
('Kue Lumpur Coklat', 6, 'Coklat', 4000, 40, 'Kue lumpur coklat manis dengan isian coklat', 'lumpur_coklat.jpg');
