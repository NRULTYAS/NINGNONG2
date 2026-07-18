<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Auth Routes
$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['logout'] = 'auth/logout';
$route['auth/proses_login'] = 'auth/proses_login';
$route['auth/proses_register'] = 'auth/proses_register';
$route['auth/google'] = 'auth/google';
$route['auth/google_callback'] = 'auth/google_callback';
$route['lupa-password'] = 'auth/forgot_password';
$route['auth/forgot_password'] = 'auth/forgot_password';
$route['auth/send_reset_link'] = 'auth/send_reset_link';
$route['auth/reset_password'] = 'auth/reset_password';
$route['auth/proses_reset_password'] = 'auth/proses_reset_password';

// Produk Routes
$route['produk'] = 'produk';
$route['produk/(:num)'] = 'produk/index/$1';
$route['produk/detail/(:num)'] = 'produk/detail/$1';
$route['produk/pesan/(:num)'] = 'produk/pesan/$1';

// Keranjang Routes
$route['keranjang'] = 'keranjang';
$route['keranjang/tambah'] = 'keranjang/tambah';
$route['keranjang/update/(:num)'] = 'keranjang/update/$1';
$route['keranjang/hapus/(:num)'] = 'keranjang/hapus/$1';

// Checkout Umum Routes
$route['checkout_umum'] = 'checkout_umum';
$route['checkout_umum/proses'] = 'checkout_umum/proses';

// Checkout Routes
$route['checkout'] = 'checkout';
$route['checkout/proses'] = 'checkout/proses';

// Catering Routes (Pelanggan)
$route['catering'] = 'catering';
$route['catering_kustom/index/(:num)'] = 'catering_kustom/index/$1';
$route['catering_kustom/proses'] = 'catering_kustom/proses';
$route['catering_checkout'] = 'catering_checkout';
$route['catering_checkout/proses'] = 'catering_checkout/proses';

// Admin Routes
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/catering'] = 'admin/catering';
$route['admin/catering/tambah'] = 'admin/catering/tambah';
$route['admin/catering/edit/(:num)'] = 'admin/catering/edit/$1';
$route['admin/catering/hapus/(:num)'] = 'admin/catering/hapus/$1';
$route['admin/catering/item/(:num)'] = 'admin/catering_item/index/$1';
$route['admin/catering/item/tambah/(:num)'] = 'admin/catering_item/tambah/$1';
$route['admin/catering/item/edit/(:num)'] = 'admin/catering_item/edit/$1';
$route['admin/catering/item/hapus/(:num)'] = 'admin/catering_item/hapus/$1';
$route['admin/catering/item/set_default/(:num)/(:num)'] = 'admin/catering_item/set_default/$1/$2';
$route['admin/produk'] = 'admin/produk';
$route['admin/produk/(:num)'] = 'admin/produk/index/$1';
$route['admin/produk/tambah'] = 'admin/produk/tambah';

$route['admin/produk/edit/(:num)'] = 'admin/produk/edit/$1';
$route['admin/produk/hapus/(:num)'] = 'admin/produk/hapus/$1';
$route['admin/kategori'] = 'admin/kategori';
$route['admin/kategori/tambah'] = 'admin/kategori/tambah';
$route['admin/kategori/edit/(:num)'] = 'admin/kategori/edit/$1';
$route['admin/kategori/hapus/(:num)'] = 'admin/kategori/hapus/$1';
$route['admin/pesanan'] = 'admin/pesanan';
$route['admin/pesanan/update_status/(:num)'] = 'admin/pesanan/update_status/$1';

$route['admin/laporan'] = 'admin/laporan';

// Box Checkout Routes
$route['box_checkout'] = 'box_checkout';
$route['box_checkout/proses'] = 'box_checkout/proses';
$route['box_checkout/sukses/(:num)'] = 'box_checkout/sukses/$1';

// Nyiru Routes
$route['nyiru'] = 'nyiru';
$route['nyiru/proses'] = 'nyiru/proses';

// Riwayat Routes
$route['riwayat'] = 'riwayat';
$route['riwayat/detail/(:num)'] = 'riwayat/detail/$1';

