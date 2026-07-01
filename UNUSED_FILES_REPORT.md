# Laporan Analisis File Tidak Terpakai
## Project: NINGNONG2 (CodeIgniter 3)
### Tanggal: 29 Juni 2026

---

## 🔴 KEMUNGKINAN TIDAK TERPAKAI

| File Path | Kategori | Alasan | Rekomendasi |
|-----------|----------|--------|-------------|
| `application/controllers/Welcome.php` | Controller | Tidak terdaftar di routes.php. Default controller adalah `home`, bukan `welcome`. Tidak ada view/controller lain yang me-refer class ini. | Hapus |
| `application/views/welcome_message.php` | View | Hanya di-load oleh Welcome.php (controller tidak terpakai). Tidak ada referensi lain. | Hapus |
| `application/views/admin/laporan.php` | View (Duplikat) | Duplikat dari `application/views/Admin/Laporan.php` (lowercase vs uppercase). Isi file identik (sama 5850 bytes, timestamp sama). Controller `Admin/Laporan.php` me-load `admin/laporan` (lowercase), jadi file lowercase yang dipakai. | Hapus file uppercase: `application/views/Admin/Laporan.php` |
| `assets/img/images-40.jpeg` | Gambar | Tidak ada referensi di view, CSS, atau controller manapun. Hanya `images-40-2.jpeg` yang dirujuk di Home.php. | Hapus |
| `test_upload.png` | File Test | File test di root direktori. Tidak dirujuk oleh kode manapun. | Hapus |

---

## 🟡 PERLU CEK MANUAL

| File Path | Kategori | Alasan | Rekomendasi |
|-----------|----------|--------|-------------|
| `application/controllers/Pesanan.php` | Controller | Tidak ada route eksplisit di routes.php untuk controller `Pesanan`. Namun view `Home.php` dan `pilih_jenis_pesanan.php` menggunakan URL `pesanan/pilih_jenis` dan `pesanan/snack_box_builder` yang mengandalkan routing default CI (segment-based). Controller ini masih berfungsi via URL langsung. | TETAPKAN - masih dipakai via URL langsung |
| `assets/upload/*` (file gambar) | Gambar | File gambar dirujuk secara **dinamis** dari database (field `gambar`/`foto` di tabel produk/paket_catering). Tidak bisa diverifikasi hanya dari kode. | Cek database untuk memastikan file mana yang masih tercatat di tabel |
| `assets/img/qris.png` | Gambar | Beberapa view (checkout_umum, Checkout, catering_checkout, box_checkout) mengecek `file_exists('assets/img/qris.png')` tapi file ini **tidak ada** di folder assets/img/. | Buat file qris.png atau hapus referensi dari view |

---

## 🟢 AKTIF DIGUNAKAN

### Controllers (19 file)
| File Path | Route / Referensi |
|-----------|-------------------|
| `application/controllers/Home.php` | Default controller (`$route['default_controller'] = 'home'`) |
| `application/controllers/Auth.php` | `$route['login'], ['register'], ['logout'], ['auth/proses_login'], ['auth/proses_register']` |
| `application/controllers/Produk.php` | `$route['produk'], ['produk/(:num)'], ['produk/detail/(:num)'], ['produk/pesan/(:num)']` |
| `application/controllers/Keranjang.php` | `$route['keranjang'], ['keranjang/tambah'], ['keranjang/update/(:num)'], ['keranjang/hapus/(:num)']` |
| `application/controllers/Checkout.php` | `$route['checkout'], ['checkout/proses']` |
| `application/controllers/Checkout_umum.php` | `$route['checkout_umum'], ['checkout_umum/proses']` |
| `application/controllers/Catering.php` | `$route['catering']` |
| `application/controllers/Catering_kustom.php` | `$route['catering_kustom/index/(:num)'], ['catering_kustom/proses']` |
| `application/controllers/Catering_checkout.php` | `$route['catering_checkout'], ['catering_checkout/proses']` |
| `application/controllers/Box_checkout.php` | `$route['box_checkout'], ['box_checkout/proses'], ['box_checkout/sukses/(:num)']` |
| `application/controllers/Nyiru.php` | `$route['nyiru'], ['nyiru/proses']` |
| `application/controllers/Riwayat.php` | `$route['riwayat'], ['riwayat/detail/(:num)']` |
| `application/controllers/Pesanan.php` | Via URL langsung dari view (pilih_jenis, snack_box_builder) |
| `application/controllers/Admin/Dashboard.php` | `$route['admin/dashboard']` |
| `application/controllers/Admin/Catering.php` | `$route['admin/catering'], ...` |
| `application/controllers/Admin/Catering_item.php` | `$route['admin/catering/item/...']` |
| `application/controllers/Admin/Kategori.php` | `$route['admin/kategori'], ...` |
| `application/controllers/Admin/Pesanan.php` | `$route['admin/pesanan'], ['admin/pesanan/update_status/(:num)']` |
| `application/controllers/Admin/Produk.php` | `$route['admin/produk'], ...` |
| `application/controllers/Admin/Laporan.php` | `$route['admin/laporan']` |

### Models (9 file)
| File Path | Controller yang Me-load |
|-----------|------------------------|
| `application/models/Auth_model.php` | Auth.php |
| `application/models/Item_paket_model.php` | Admin/Catering_item.php, Catering_checkout.php, Catering_kustom.php |
| `application/models/Kategori_model.php` | Admin/Dashboard.php, Admin/Kategori.php, Admin/Produk.php, Home.php, Keranjang.php, Pesanan.php, Produk.php, Riwayat.php, Checkout.php |
| `application/models/Keranjang_model.php` | Catering.php, Catering_checkout.php, Catering_kustom.php, Checkout.php, Home.php, Keranjang.php, Riwayat.php |
| `application/models/Paket_catering_model.php` | Admin/Catering.php, Admin/Catering_item.php, Catering.php, Catering_checkout.php, Catering_kustom.php |
| `application/models/Pesanan_model.php` | Admin/Dashboard.php, Admin/Laporan.php, Admin/Pesanan.php, Box_checkout.php, Catering_checkout.php, Catering_kustom.php, Checkout.php, Checkout_umum.php, Nyiru.php, Riwayat.php |
| `application/models/Produk_model.php` | Admin/Dashboard.php, Admin/Produk.php, Box_checkout.php, Checkout.php, Checkout_umum.php, Home.php, Keranjang.php, Nyiru.php, Pesanan.php, Produk.php |
| `application/models/Rekomendasi.php` | Produk.php |
| `application/models/User_model.php` | Admin/Dashboard.php, Auth.php, Catering_checkout.php, Catering_kustom.php, Checkout.php, Checkout_umum.php, Nyiru.php |

### Views (semua aktif)
| File Path | Loaded By |
|-----------|-----------|
| `application/views/templates/header_pelanggan.php` | Di-include oleh semua view Pelanggan/* |
| `application/views/templates/footer_pelanggan.php` | Di-include oleh semua view Pelanggan/* |
| `application/views/templates/header_admin.php` | Di-include oleh semua view Admin/* |
| `application/views/templates/footer_admin.php` | Di-include oleh semua view Admin/* |
| `application/views/Auth/Login.php` | Auth.php |
| `application/views/Auth/Register.php` | Auth.php |
| `application/views/Pelanggan/Home.php` | Home.php |
| `application/views/Pelanggan/Produk.php` | Produk.php |
| `application/views/Pelanggan/Detail_produk.php` | Produk.php |
| `application/views/Pelanggan/Keranjang.php` | Keranjang.php |
| `application/views/Pelanggan/Checkout.php` | Checkout.php |
| `application/views/Pelanggan/checkout_umum.php` | Checkout_umum.php |
| `application/views/Pelanggan/Catering.php` | Catering.php |
| `application/views/Pelanggan/catering_checkout.php` | Catering_checkout.php |
| `application/views/Pelanggan/catering_kustom.php` | Catering_kustom.php |
| `application/views/Pelanggan/box_checkout.php` | Box_checkout.php |
| `application/views/Pelanggan/box_checkout_sukses.php` | Box_checkout.php |
| `application/views/Pelanggan/nyiru.php` | Nyiru.php |
| `application/views/Pelanggan/Riwayat.php` | Riwayat.php |
| `application/views/Pelanggan/Detail_pesanan.php` | Riwayat.php |
| `application/views/Pelanggan/pilih_jenis_pesanan.php` | Pesanan.php |
| `application/views/Pelanggan/snack_box_builder.php` | Pesanan.php |
| `application/views/Admin/Dashboard.php` | Admin/Dashboard.php |
| `application/views/Admin/Kategori_list.php` | Admin/Kategori.php |
| `application/views/Admin/Kategori_tambah.php` | Admin/Kategori.php |
| `application/views/Admin/Kategori_edit.php` | Admin/Kategori.php |
| `application/views/Admin/Produk_list.php` | Admin/Produk.php |
| `application/views/Admin/Produk_tambah.php` | Admin/Produk.php |
| `application/views/Admin/Produk_edit.php` | Admin/Produk.php |
| `application/views/Admin/Catering_list.php` | Admin/Catering.php |
| `application/views/Admin/Catering_tambah.php` | Admin/Catering.php |
| `application/views/Admin/Catering_edit.php` | Admin/Catering.php |
| `application/views/Admin/catering_item_list.php` | Admin/Catering_item.php |
| `application/views/Admin/catering_item_tambah.php` | Admin/Catering_item.php |
| `application/views/Admin/catering_item_edit.php` | Admin/Catering_item.php |
| `application/views/Admin/Pesanan_list.php` | Admin/Pesanan.php |
| `application/views/Admin/Laporan.php` | Admin/Laporan.php |
| `application/views/Admin/laporan.php` | Admin/Laporan.php (lowercase - yang dipakai) |
| `application/views/errors/*` | System CI - jangan hapus |

### Database Migrations (8 file - semua dianggap penting)
| File Path |
|-----------|
| `database/migration_bolu_snackbox.sql` |
| `database/migration_box_checkout.sql` |
| `database/migration_item_paket_catering.sql` |
| `database/migration_kategori_status.sql` |
| `database/migration_nyiru_tampah.sql` |
| `database/migration_paket_catering.sql` |
| `database/migration_reset_kategori_produk.sql` |
| `database/nignong_kue_basah.sql` |

### File Konfigurasi (JANGAN SENTUH)
`.editorconfig`, `.gitignore`, `.htaccess`, `composer.json`, `index.php`, `license.txt`, `readme.rst`, `application/config/*`, `application/.htaccess`

---

## RINGKASAN

| Kategori | Jumlah |
|----------|--------|
| 🔴 Tidak Terpakai (siap hapus) | **5 file** |
| 🟡 Perlu Cek Manual | **2 item** (gambar upload + qris.png) |
| 🟢 Aktif Digunakan | **~60+ file** |

### 🔴 File yang siap dihapus (setelah konfirmasi Anda):
1. `application/controllers/Welcome.php`
2. `application/views/welcome_message.php`
3. `application/views/Admin/Laporan.php` (duplikat uppercase - file lowercase yang dipakai)
4. `assets/img/images-40.jpeg`
5. `test_upload.png`

### 🟡 Yang perlu dicek manual:
1. **File di `assets/upload/`** - Cek database tabel `produk` (field `gambar`) dan `paket_catering` (field `foto`) untuk mengetahui file mana yang masih terdaftar
2. **`assets/img/qris.png`** - Tidak ada file, tapi beberapa view mengecek keberadaannya. Perlu dibuatkan file QRIS atau hapus referensi dari view.

---

> **Catatan:** Saya TIDAK menghapus apapun. Silakan review laporan ini dan beri tahu file mana yang ingin dihapus.