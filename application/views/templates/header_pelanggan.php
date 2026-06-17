<?php
$nama_user = $this->session->userdata('nama');
$role = $this->session->userdata('role');
$id_user = $this->session->userdata('id_user');
$jumlah_keranjang = isset($jumlah_keranjang) ? $jumlah_keranjang : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NINGNONG Kue Basah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'krem': '#FFF8E7',
                        'krem-tua': '#F5E6CA',
                        'coklat-muda': '#D7CCC8',
                        'coklat': '#8D6E63',
                        'coklat-tua': '#5D4037',
                        'oranye-pastel': '#FFCCBC',
                        'oranye': '#FFAB91',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-krem text-gray-800">
    <!-- Page Loader -->
    <div id="page-loader" style="position:fixed;inset:0;z-index:9999;background:#FFF8E7;display:flex;align-items:center;justify-content:center;transition:opacity .4s">
        <div style="text-align:center">
            <div style="width:48px;height:48px;border:4px solid #D7CCC8;border-top-color:#5D4037;border-radius:50%;animation:spin 1s linear infinite;margin:0 auto"></div>
            <p style="margin-top:16px;color:#5D4037;font-weight:500;font-family:sans-serif">Loading...</p>
        </div>
    </div>
    <style>@keyframes spin{to{transform:rotate(360deg)}}</style>
    <script>window.addEventListener('load',function(){var l=document.getElementById('page-loader');if(l){l.style.opacity='0';setTimeout(function(){l.remove()},400)}})</script>
    <!-- Navbar -->
    <nav class="bg-white/95 backdrop-blur-sm shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="<?php echo base_url('home'); ?>" class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-coklat-tua rounded-full flex items-center justify-center text-white font-bold text-lg">N</div>
                    <span class="text-xl font-bold text-coklat-tua">NINGNONG</span>
                </a>
                <div class="hidden md:flex items-center gap-8">
                    <a href="<?php echo base_url('home'); ?>" class="text-gray-600 hover:text-coklat-tua font-medium transition">Beranda</a>
                    <a href="<?php echo base_url('produk'); ?>" class="text-gray-600 hover:text-coklat-tua font-medium transition">Produk</a>
                    <?php if($id_user): ?>
                    <a href="<?php echo base_url('riwayat'); ?>" class="text-gray-600 hover:text-coklat-tua font-medium transition">Riwayat</a>
                    <?php endif; ?>
                </div>
                <div class="flex items-center gap-4">
                    <?php if($id_user && $role != 'admin'): ?>
                    <a href="<?php echo base_url('keranjang'); ?>" class="relative p-2 text-gray-600 hover:text-coklat-tua transition">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <?php if($jumlah_keranjang > 0): ?>
                        <span class="absolute -top-1 -right-1 bg-oranye text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold"><?php echo $jumlah_keranjang; ?></span>
                        <?php endif; ?>
                    </a>
                    <?php endif; ?>
                    <?php if($id_user): ?>
                    <div class="relative group">
                        <button class="flex items-center gap-2 text-gray-600 hover:text-coklat-tua font-medium">
                            <div class="w-8 h-8 bg-coklat-muda rounded-full flex items-center justify-center text-coklat-tua">
                                <i class="fas fa-user text-sm"></i>
                            </div>
                            <span class="hidden sm:inline"><?php echo $nama_user; ?></span>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 hidden group-hover:block border border-coklat-muda/30">
                            <?php if($role == 'admin'): ?>
                            <a href="<?php echo base_url('admin/dashboard'); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-krem">Dashboard Admin</a>
                            <?php endif; ?>
                            <a href="<?php echo base_url('riwayat'); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-krem">Riwayat Pesanan</a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <a href="<?php echo base_url('auth/logout'); ?>" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</a>
                        </div>
                    </div>
                    <?php else: ?>
                    <a href="<?php echo base_url('auth/login'); ?>" class="px-5 py-2 text-coklat-tua font-medium hover:bg-coklat-muda/20 rounded-lg transition">Masuk</a>
                    <a href="<?php echo base_url('auth/register'); ?>" class="px-5 py-2 bg-coklat-tua text-white font-medium rounded-lg hover:bg-coklat transition">Daftar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <?php if($this->session->flashdata('success')): ?>
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center justify-between">
            <span><?php echo $this->session->flashdata('success'); ?></span>
            <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900"><i class="fas fa-times"></i></button>
        </div>
    </div>
    <?php endif; ?>
    <?php if($this->session->flashdata('error')): ?>
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg flex items-center justify-between">
            <span><?php echo $this->session->flashdata('error'); ?></span>
            <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900"><i class="fas fa-times"></i></button>
        </div>
    </div>
    <?php endif; ?>
