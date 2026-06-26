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
                        'primary': '#7C8C6C',
                        'primary-hover': '#6A7A5C',
                        'primary-light': '#E8EDE5',
                        'secondary': '#A8B29A',
                        'secondary-hover': '#96A289',
                        'secondary-light': '#F0F2EC',
                        'background': '#F7F6F2',
                        'surface': '#FFFFFF',
                        'text-main': '#2C2C2C',
                        'text-muted': '#6E6E6E',
                        'text-subtle': '#9A9A9A',
                        'accent': '#D6B56C',
                        'accent-hover': '#C4A45C',
                        'accent-light': '#F7F3E6',
                        'border-subtle': '#E5E3DE',
                        'primary-dark': '#5F6E54',
                    },
                    fontFamily: {
                        'heading': ['"Plus Jakarta Sans"', 'sans-serif'],
                        'body': ['Inter', 'sans-serif'],
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
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap');
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Plus Jakarta Sans', sans-serif; }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
        @keyframes pulse-soft { 0%, 100% { opacity: 0.6; } 50% { opacity: 1; } }
        .glass { background: rgba(255,255,255,0.85); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); }
        .nav-link { position: relative; }
        .nav-link::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 0; height: 2px; background: #7C8C6C; border-radius: 2px; transition: width 0.3s; }
        .nav-link:hover::after { width: 100%; }
        .card-hover { transition: all 0.3s cubic-bezier(0.4,0,0.2,1); }
        .card-hover:hover { transform: translateY(-6px); }
        .blob { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
        .organic-shape { border-radius: 63% 37% 54% 46% / 55% 48% 52% 45%; }
        /* Product card grid alignment */
        .product-grid { align-items: stretch; }

        /* Hilangkan spinner native browser untuk input qty (type=number) agar konsisten dengan tombol +/- kustom */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }

        /* ===== Konsistensi Gambar Produk di Card ===== */
        /* Pastikan semua gambar produk di card memiliki tinggi seragam dengan object-fit: cover */
        .product-card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
        /* Container gambar produk di card — pastikan aspect ratio konsisten */
        .product-card-image-wrapper {
            aspect-ratio: 4 / 3;
            overflow: hidden;
            position: relative;
        }

        /* ===== Custom Select Styling (Filter Kategori) ===== */
        .select-filter {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='%23A8B29A' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 18px;
            padding-right: 44px;
            cursor: pointer;
        }
        .select-filter:focus {
            border-color: #7C8C6C;
            box-shadow: 0 0 0 3px rgba(124,140,108,0.15);
        }
    </style>
</head>

<body class="bg-background text-text-main overflow-x-hidden">
    <!-- Page Loader -->
    <div id="page-loader" style="position:fixed;inset:0;z-index:9999;background:#F7F6F2;display:flex;align-items:center;justify-content:center;transition:opacity .4s">
        <div style="text-align:center">
            <div style="width:48px;height:48px;border:4px solid #E5E3DE;border-top-color:#7C8C6C;border-radius:50%;animation:spin 1s linear infinite;margin:0 auto"></div>
            <p style="margin-top:16px;color:#2C2C2C;font-weight:500;font-family:Inter,sans-serif">Loading...</p>
        </div>
    </div>
    <style>@keyframes spin{to{transform:rotate(360deg)}}</style>
    <script>(function(){function h(){var l=document.getElementById('page-loader');if(l){l.style.opacity='0';setTimeout(function(){l.remove()},400)}}window.addEventListener('load',h);setTimeout(h,2000)})()</script>

    <!-- Navbar -->
    <nav class="glass shadow-sm sticky top-0 z-50 border-b border-border-subtle/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-18 items-center py-3">
                <a href="<?php echo base_url('home'); ?>" class="flex items-center gap-2.5 group">
                    <div class="w-11 h-11 bg-primary rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-primary/20 group-hover:shadow-primary/40 transition-all duration-200">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="white"/><circle cx="12" cy="12" r="3" fill="white"/></svg>
                    </div>
                    <div>
                        <span class="text-xl font-bold text-text-main leading-none font-heading">NINGNONG</span>
                        <span class="block text-[10px] text-secondary font-medium -mt-0.5 tracking-wider">KUE BASAH</span>
                    </div>
                </a>
                <div class="hidden md:flex items-center gap-8">
                    <a href="<?php echo base_url('home'); ?>" class="nav-link text-text-muted hover:text-primary font-medium transition-colors duration-200 text-sm">Beranda</a>
                    <a href="<?php echo base_url('produk'); ?>" class="nav-link text-text-muted hover:text-primary font-medium transition-colors duration-200 text-sm">Aneka Kue</a>
                </div>
                <div class="flex items-center gap-3">
                    <?php if($id_user && $role != 'admin'): ?>
                    <a href="<?php echo base_url('keranjang'); ?>" class="relative p-2.5 text-text-muted hover:text-primary transition-colors duration-200 rounded-xl hover:bg-secondary-light">
                        <i class="fas fa-shopping-bag text-lg"></i>
                        <?php if($jumlah_keranjang > 0): ?>
                        <span class="absolute -top-0.5 -right-0.5 bg-accent text-white text-[10px] rounded-full w-5 h-5 flex items-center justify-center font-bold shadow-md"><?php echo $jumlah_keranjang; ?></span>
                        <?php endif; ?>
                    </a>
                    <?php endif; ?>

                    <?php if($id_user): ?>
                    <div class="relative" id="profileDropdown">
                        <button id="profileBtn" class="flex items-center gap-2 text-text-muted hover:text-primary font-medium transition-colors duration-200 rounded-xl px-3 py-2 hover:bg-secondary-light">
                            <div class="w-8 h-8 bg-secondary-light rounded-lg flex items-center justify-center text-primary">
                                <i class="fas fa-user text-xs"></i>
                            </div>
                            <span class="hidden sm:inline text-sm"><?php echo $nama_user; ?></span>
                            <i class="fas fa-chevron-down text-[10px] text-text-subtle hidden sm:inline transition-transform duration-200" id="profileChevron"></i>
                        </button>
                        <div id="profileMenu" class="absolute right-0 mt-2 w-52 bg-surface rounded-2xl shadow-lg border border-border-subtle py-2 hidden overflow-hidden z-50">
                            <div class="px-4 py-3 border-b border-border-subtle">
                                <p class="font-semibold text-sm text-text-main"><?php echo $nama_user; ?></p>
                                <p class="text-xs text-text-subtle capitalize"><?php echo $role; ?></p>
                            </div>
                            <?php if($role == 'admin'): ?>
                            <a href="<?php echo base_url('admin/dashboard'); ?>" class="flex items-center gap-3 px-4 py-2.5 text-sm text-text-muted hover:bg-background transition-colors duration-200"><i class="fas fa-tachometer-alt w-4 text-primary"></i>Dashboard Admin</a>
                            <?php endif; ?>
                            <a href="<?php echo base_url('riwayat'); ?>" class="flex items-center gap-3 px-4 py-2.5 text-sm text-text-muted hover:bg-background transition-colors duration-200"><i class="fas fa-receipt w-4 text-primary"></i>Riwayat Pesanan</a>
                            <div class="border-t border-border-subtle my-1"></div>
                            <a href="<?php echo base_url('auth/logout'); ?>" class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200"><i class="fas fa-sign-out-alt w-4"></i>Logout</a>
                        </div>
                    </div>
                    <script>
                    (function() {
                        var btn = document.getElementById('profileBtn');
                        var menu = document.getElementById('profileMenu');
                        var chevron = document.getElementById('profileChevron');
                        if (!btn || !menu) return;

                        function openMenu() {
                            menu.classList.remove('hidden');
                            if (chevron) chevron.style.transform = 'rotate(180deg)';
                        }
                        function closeMenu() {
                            menu.classList.add('hidden');
                            if (chevron) chevron.style.transform = 'rotate(0deg)';
                        }
                        function toggleMenu(e) {
                            e.stopPropagation();
                            if (menu.classList.contains('hidden')) {
                                openMenu();
                            } else {
                                closeMenu();
                            }
                        }
                        btn.addEventListener('click', toggleMenu);

                        // Klik di luar dropdown → tutup
                        document.addEventListener('click', function(e) {
                            var dd = document.getElementById('profileDropdown');
                            if (dd && !dd.contains(e.target)) {
                                closeMenu();
                            }
                        });

                        // Escape key → tutup
                        document.addEventListener('keydown', function(e) {
                            if (e.key === 'Escape') closeMenu();
                        });
                    })();
                    </script>
                    <?php else: ?>
                    <a href="<?php echo base_url('auth/login'); ?>" class="px-5 py-2 text-primary font-medium hover:bg-secondary-light rounded-xl transition-colors duration-200 text-sm">Masuk</a>
                    <a href="<?php echo base_url('auth/register'); ?>" class="px-5 py-2 bg-primary text-white font-medium rounded-full hover:bg-primary-hover transition-all duration-200 shadow-md shadow-primary/20 text-sm">Daftar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <script>
    (function() {
        var nav = document.querySelector('nav');
        if (!nav) return;
        function updateShadow() {
            if (window.scrollY > 10) {
                nav.classList.add('shadow-md', 'border-border-subtle');
                nav.classList.remove('shadow-sm');
            } else {
                nav.classList.add('shadow-sm');
                nav.classList.remove('shadow-md', 'border-border-subtle');
            }
        }
        window.addEventListener('scroll', updateShadow, { passive: true });
        updateShadow();
    })();
    </script>

    <?php if($this->session->flashdata('success')): ?>
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <div class="bg-primary-light border border-primary/30 text-primary px-5 py-3.5 rounded-2xl flex items-center justify-between shadow-sm">
            <span class="flex items-center gap-2"><i class="fas fa-check-circle"></i> <?php echo $this->session->flashdata('success'); ?></span>
            <button onclick="this.parentElement.remove()" class="text-primary hover:text-primary-hover"><i class="fas fa-times"></i></button>
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
