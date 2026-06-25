<?php
$nama_user = $this->session->userdata('nama');
$role = $this->session->userdata('role');
if($role != 'admin') redirect('auth/login');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - NINGNONG Kue Basah</title>
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
                    },
                    fontFamily: {
                        'heading': ['"Plus Jakarta Sans"', 'sans-serif'],
                        'body': ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap');
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Plus Jakarta Sans', sans-serif; }
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #E5E3DE; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #7C8C6C; }
    </style>
</head>
<body class="bg-background text-text-main">

    <!-- Mobile Backdrop -->
    <div id="sidebar-backdrop" class="fixed inset-0 bg-text-main/40 z-40 hidden lg:hidden backdrop-blur-sm transition-opacity" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside id="admin-sidebar" class="fixed left-0 top-0 h-screen w-64 bg-primary text-white z-50 flex flex-col shadow-xl shadow-primary/20 transition-transform duration-300 -translate-x-full lg:translate-x-0">
        <div class="h-16 flex items-center gap-3 px-6 border-b border-white/10 flex-shrink-0">
            <div class="w-9 h-9 bg-white rounded-xl flex items-center justify-center text-primary font-bold shadow-lg">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="#7C8C6C"/><circle cx="12" cy="12" r="3" fill="#7C8C6C"/></svg>
            </div>
            <div>
                <span class="font-bold text-sm leading-tight block font-heading">NINGNONG</span>
                <span class="text-[10px] text-secondary tracking-wider uppercase">Admin Panel</span>
            </div>
            <button onclick="toggleSidebar()" class="ml-auto lg:hidden text-white/70 hover:text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <a href="<?php echo base_url('admin/dashboard'); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/10 transition-colors duration-200 text-sm <?php echo $this->uri->segment(2) == 'dashboard' ? 'bg-white/15 font-medium' : 'text-white/80'; ?>">
                <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-chart-pie text-xs"></i></div>
                <span>Dashboard</span>
            </a>
            <a href="<?php echo base_url('admin/catering'); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/10 transition-colors duration-200 text-sm <?php echo $this->uri->segment(2) == 'catering' ? 'bg-white/15 font-medium' : 'text-white/80'; ?>">
                <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-box-open text-xs"></i></div>
                <span>Catering</span>
            </a>
            <a href="<?php echo base_url('admin/produk'); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/10 transition-colors duration-200 text-sm <?php echo $this->uri->segment(2) == 'produk' ? 'bg-white/15 font-medium' : 'text-white/80'; ?>">
                <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-cookie text-xs"></i></div>
                <span>Produk</span>
            </a>
            <a href="<?php echo base_url('admin/kategori'); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/10 transition-colors duration-200 text-sm <?php echo $this->uri->segment(2) == 'kategori' ? 'bg-white/15 font-medium' : 'text-white/80'; ?>">
                <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-tags text-xs"></i></div>
                <span>Kategori</span>
            </a>
            <a href="<?php echo base_url('admin/pesanan'); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/10 transition-colors duration-200 text-sm <?php echo $this->uri->segment(2) == 'pesanan' ? 'bg-white/15 font-medium' : 'text-white/80'; ?>">
                <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-receipt text-xs"></i></div>
                <span>Pesanan</span>
            </a>
            <a href="<?php echo base_url('admin/laporan'); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/10 transition-colors duration-200 text-sm <?php echo $this->uri->segment(2) == 'laporan' ? 'bg-white/15 font-medium' : 'text-white/80'; ?>">
                <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-file-invoice-dollar text-xs"></i></div>
                <span>Laporan</span>
            </a>
        </nav>

        <!-- Bottom Actions -->
        <div class="p-3 border-t border-white/10 space-y-1 flex-shrink-0">
            <a href="<?php echo base_url('home'); ?>" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/10 transition-colors duration-200 text-sm text-white/80">
                <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-store text-xs"></i></div>
                <span>Lihat Website</span>
            </a>
            <a href="<?php echo base_url('auth/logout'); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-red-500/20 transition-colors duration-200 text-sm text-red-200">
                <div class="w-8 h-8 bg-red-500/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-sign-out-alt text-xs"></i></div>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <!-- Main Wrapper -->
    <div class="lg:ml-64 min-h-screen flex flex-col">
        <!-- Topbar -->
        <header class="h-16 bg-surface border-b border-border-subtle px-6 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="lg:hidden text-text-muted hover:text-primary p-1 transition-colors duration-200">
                    <i class="fas fa-bars text-lg"></i>
                </button>
                <h2 class="text-lg font-bold text-primary font-heading hidden sm:block">
                    <?php
                    $seg = $this->uri->segment(2);
                    $titles = ['dashboard'=>'Dashboard','catering'=>'Kelola Catering','produk'=>'Kelola Produk','kategori'=>'Kelola Kategori','pesanan'=>'Kelola Pesanan','laporan'=>'Laporan Penjualan'];
                    echo isset($titles[$seg]) ? $titles[$seg] : 'Admin Panel';
                    ?>
                </h2>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="font-semibold text-sm text-text-main leading-tight"><?php echo $nama_user; ?></p>
                    <p class="text-[11px] text-text-subtle">Administrator</p>
                </div>
                <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center text-white shadow-md">
                    <i class="fas fa-user-shield text-xs"></i>
                </div>
            </div>
        </header>

        <!-- Flash Messages -->
        <div class="px-6 pt-5">
            <?php if($this->session->flashdata('success')): ?>
            <div class="bg-primary-light border border-primary/30 text-primary px-4 py-3 rounded-xl flex items-center justify-between mb-4 shadow-sm">
                <span class="flex items-center gap-2 text-sm"><i class="fas fa-check-circle"></i> <?php echo $this->session->flashdata('success'); ?></span>
                <button onclick="this.parentElement.remove()" class="text-primary hover:text-primary-hover"><i class="fas fa-times"></i></button>
            </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center justify-between mb-4 shadow-sm">
                <span class="flex items-center gap-2 text-sm"><i class="fas fa-exclamation-circle"></i> <?php echo $this->session->flashdata('error'); ?></span>
                <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900"><i class="fas fa-times"></i></button>
            </div>
            <?php endif; ?>
        </div>

        <main class="flex-1 p-6">

<script>
function toggleSidebar() {
    var sidebar = document.getElementById('admin-sidebar');
    var backdrop = document.getElementById('sidebar-backdrop');
    var isHidden = sidebar.classList.contains('-translate-x-full');
    if (isHidden) {
        sidebar.classList.remove('-translate-x-full');
        backdrop.classList.remove('hidden');
    } else {
        sidebar.classList.add('-translate-x-full');
        backdrop.classList.add('hidden');
    }
}
</script>
