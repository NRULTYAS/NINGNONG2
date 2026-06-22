-- Migration: Tambah kategori Nyiru/Tampah dan produk dengan 3 varian ukuran

INSERT INTO tbl_kategori (nama_kategori, deskripsi) VALUES ('Nyiru / Tampah', 'Paket nyiru/tampah untuk acara dengan berbagai ukuran');

INSERT INTO tbl_produk (nama_produk, id_kategori, rasa, harga, stok, deskripsi, gambar) VALUES
('Nyiru Kecil (50 kue)', 7, 'Campur', 15000, 20, 'Nyiru ukuran kecil untuk acara sederhana, isi 50 kue', 'nyiru_kecil.jpg'),
('Nyiru Sedang (100 kue)', 7, 'Campur', 25000, 15, 'Nyiru ukuran sedang untuk acara menengah, isi 100 kue', 'nyiru_sedang.jpg'),
('Nyiru Besar (150 kue)', 7, 'Campur', 35000, 10, 'Nyiru ukuran besar untuk acara besar, isi 150 kue', 'nyiru_besar.jpg');
