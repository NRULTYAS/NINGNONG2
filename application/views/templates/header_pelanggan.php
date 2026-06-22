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
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-delay': 'float 6s ease-in-out 2s infinite',
                        'pulse-soft': 'pulse-soft 3s ease-in-out infinite',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
        @keyframes pulse-soft { 0%, 100% { opacity: 0.6; } 50% { opacity: 1; } }
        .glass { background: rgba(255,255,255,0.8); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
        .nav-link { position: relative; }
        .nav-link::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 0; height: 2px; background: #5D4037; border-radius: 2px; transition: width 0.3s; }
        .nav-link:hover::after { width: 100%; }
        .card-hover { transition: all 0.3s cubic-bezier(0.4,0,0.2,1); }
        .card-hover:hover { transform: translateY(-6px); }
        .blob { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
    </style>
</head>
<body class="bg-krem text-gray-800 overflow-x-hidden">
    <!-- Page Loader -->
    <div id="page-loader" style="position:fixed;inset:0;z-index:9999;background:#FFF8E7;display:flex;align-items:center;justify-content:center;transition:opacity .4s">
        <div style="text-align:center">
            <div style="width:48px;height:48px;border:4px solid #D7CCC8;border-top-color:#5D4037;border-radius:50%;animation:spin 1s linear infinite;margin:0 auto"></div>
            <p style="margin-top:16px;color:#5D4037;font-weight:500;font-family:sans-serif">Loading...</p>
        </div>
    </div>
    <style>@keyframes spin{to{transform:rotate(360deg)}}</style>
    <script>(function(){function h(){var l=document.getElementById('page-loader');if(l){l.style.opacity='0';setTimeout(function(){l.remove()},400)}}window.addEventListener('load',h);setTimeout(h,2000)})()</script>

    <!-- Navbar -->
    <nav class="glass shadow-sm sticky top-0 z-50 border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-18 items-center py-3">
                <a href="<?php echo base_url('home'); ?>" class="flex items-center gap-2.5 group">
                    <div class="w-11 h-11 bg-gradient-to-br from-coklat-tua to-coklat rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-coklat-tua/20 group-hover:shadow-coklat-tua/40 transition">N</div>
                    <div>
                        <span class="text-xl font-bold text-coklat-tua leading-none">NINGNONG</span>
                        <span class="block text-[10px] text-coklat font-medium -mt-0.5 tracking-wider">KUE BASAH</span>
                    </div>
                </a>
                <div class="hidden md:flex items-center gap-8">
                    <a href="<?php echo base_url('home'); ?>" class="nav-link text-gray-600 hover:text-coklat-tua font-medium transition text-sm">Beranda</a>
                    <a href="<?php echo base_url('produk'); ?>" class="nav-link text-gray-600 hover:text-coklat-tua font-medium transition text-sm">Produk</a>
                    <a href="<?php echo base_url('catering'); ?>" class="nav-link text-gray-600 hover:text-coklat-tua font-medium transition text-sm">Catering</a>
                    <?php if($id_user): ?>
                    <a href="<?php echo base_url('riwayat'); ?>" class="nav-link text-gray-600 hover:text-coklat-tua font-medium transition text-sm">Riwayat</a>
                    <?php endif; ?>
                </div>
                <div class="flex items-center gap-3">
                    <?php if($id_user && $role != 'admin'): ?>
                    <a href="<?php echo base_url('keranjang'); ?>" class="relative p-2.5 text-gray-500 hover:text-coklat-tua transition rounded-xl hover:bg-coklat-muda/20">
                        <i class="fas fa-shopping-bag text-lg"></i>
                        <?php if($jumlah_keranjang > 0): ?>
                        <span class="absolute -top-0.5 -right-0.5 bg-gradient-to-r from-oranye to-oranye-pastel text-white text-[10px] rounded-full w-5 h-5 flex items-center justify-center font-bold shadow-md animate-pulse-soft"><?php echo $jumlah_keranjang; ?></span>
                        <?php endif; ?>
                    </a>
                    <?php endif; ?>
                    <?php if($id_user): ?>
                    <div class="relative group">
                        <button class="flex items-center gap-2 text-gray-600 hover:text-coklat-tua font-medium transition rounded-xl px-3 py-2 hover:bg-coklat-muda/20">
                            <div class="w-8 h-8 bg-gradient-to-br from-coklat-muda to-coklat-muda/60 rounded-lg flex items-center justify-center text-coklat-tua">
                                <i class="fas fa-user text-xs"></i>
                            </div>
                            <span class="hidden sm:inline text-sm"><?php echo $nama_user; ?></span>
                            <i class="fas fa-chevron-down text-[10px] text-gray-400 hidden sm:inline"></i>
                        </button>
                        <div class="absolute right-0 mt-1 w-52 bg-white rounded-2xl shadow-xl py-2 hidden group-hover:block border border-coklat-muda/20 overflow-hidden">
                            <div class="px-4 py-3 border-b border-coklat-muda/20">
                                <p class="font-semibold text-sm text-gray-800"><?php echo $nama_user; ?></p>
                                <p class="text-xs text-gray-500 capitalize"><?php echo $role; ?></p>
                            </div>
                            <?php if($role == 'admin'): ?>
                            <a href="<?php echo base_url('admin/dashboard'); ?>" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-krem transition"><i class="fas fa-tachometer-alt w-4 text-coklat"></i>Dashboard Admin</a>
                            <?php endif; ?>
                            <a href="<?php echo base_url('riwayat'); ?>" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-krem transition"><i class="fas fa-receipt w-4 text-coklat"></i>Riwayat Pesanan</a>
                            <div class="border-t border-coklat-muda/20 my-1"></div>
                            <a href="<?php echo base_url('auth/logout'); ?>" class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition"><i class="fas fa-sign-out-alt w-4"></i>Logout</a>
                        </div>
                    </div>
                    <?php else: ?>
                    <a href="<?php echo base_url('auth/login'); ?>" class="px-5 py-2 text-coklat-tua font-medium hover:bg-coklat-muda/20 rounded-xl transition text-sm">Masuk</a>
                    <a href="<?php echo base_url('auth/register'); ?>" class="px-5 py-2 bg-gradient-to-r from-coklat-tua to-coklat text-white font-medium rounded-xl hover:shadow-lg hover:shadow-coklat-tua/25 transition text-sm">Daftar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <?php if($this->session->flashdata('success')): ?>
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-3.5 rounded-2xl flex items-center justify-between shadow-sm">
            <span class="flex items-center gap-2"><i class="fas fa-check-circle"></i> <?php echo $this->session->flashdata('success'); ?></span>
            <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900"><i class="fas fa-times"></i></button>
        </div>
    </div>
    <?php endif; ?>
    <?php if($this->session->flashdata('error')): ?>
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-3.5 rounded-2xl flex items-center justify-between shadow-sm">
            <span class="flex items-center gap-2"><i class="fas fa-exclamation-circle"></i> <?php echo $this->session->flashdata('error'); ?></span>
            <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900"><i class="fas fa-times"></i></button>
        </div>
    </div>
    <?php endif; ?>
