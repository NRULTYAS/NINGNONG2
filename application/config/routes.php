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

// Produk Routes
$route['produk'] = 'produk';
$route['produk/detail/(:num)'] = 'produk/detail/$1';

// Keranjang Routes
$route['keranjang'] = 'keranjang';
$route['keranjang/tambah'] = 'keranjang/tambah';
$route['keranjang/update/(:num)'] = 'keranjang/update/$1';
$route['keranjang/hapus/(:num)'] = 'keranjang/hapus/$1';

// Checkout Routes
$route['checkout'] = 'checkout';
$route['checkout/proses'] = 'checkout/proses';

// Admin Routes
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/produk'] = 'admin/produk';
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

// Riwayat Routes
$route['riwayat'] = 'riwayat';
$route['riwayat/detail/(:num)'] = 'riwayat/detail/$1';
