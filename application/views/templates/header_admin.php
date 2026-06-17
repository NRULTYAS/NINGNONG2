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
                        'krem': '#FFF8E7',
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

    <div class="min-h-screen flex">
        <!-- Mobile Backdrop -->
        <div id="sidebar-backdrop" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <aside id="admin-sidebar" class="w-64 bg-coklat-tua text-white flex-shrink-0 flex flex-col fixed md:relative z-50 h-full transition-transform duration-300 -translate-x-full md:translate-x-0">
            <div class="p-6 flex items-center gap-3 border-b border-coklat/30">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-coklat-tua font-bold">N</div>
                <span class="font-bold text-lg">NINGNONG</span>
                <button onclick="toggleSidebar()" class="ml-auto md:hidden text-white/70 hover:text-white">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="<?php echo base_url('admin/dashboard'); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition <?php echo $this->uri->segment(2) == 'dashboard' ? 'bg-white/10' : ''; ?>">
                    <i class="fas fa-chart-pie w-5"></i> Dashboard
                </a>
                <a href="<?php echo base_url('admin/produk'); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition <?php echo $this->uri->segment(2) == 'produk' ? 'bg-white/10' : ''; ?>">
                    <i class="fas fa-cookie w-5"></i> Produk
                </a>
                <a href="<?php echo base_url('admin/kategori'); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition <?php echo $this->uri->segment(2) == 'kategori' ? 'bg-white/10' : ''; ?>">
                    <i class="fas fa-tags w-5"></i> Kategori
                </a>
                <a href="<?php echo base_url('admin/pesanan'); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition <?php echo $this->uri->segment(2) == 'pesanan' ? 'bg-white/10' : ''; ?>">
                    <i class="fas fa-receipt w-5"></i> Pesanan
                </a>
                <a href="<?php echo base_url('admin/laporan'); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition <?php echo $this->uri->segment(2) == 'laporan' ? 'bg-white/10' : ''; ?>">
                    <i class="fas fa-file-invoice-dollar w-5"></i> Laporan
                </a>
            </nav>
            <div class="p-4 border-t border-coklat/30">
                <a href="<?php echo base_url('home'); ?>" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition">
                    <i class="fas fa-store w-5"></i> Lihat Website
                </a>
                <a href="<?php echo base_url('auth/logout'); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition text-red-300">
                    <i class="fas fa-sign-out-alt w-5"></i> Logout
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 min-h-screen">
            <!-- Topbar -->
            <header class="bg-white shadow-sm px-6 py-4 flex items-center justify-between sticky top-0 z-30">
                <button onclick="toggleSidebar()" class="md:hidden text-gray-600 p-2 -ml-2">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <h2 class="text-xl font-bold text-coklat-tua hidden md:block">Admin Panel</h2>
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="font-medium text-sm"><?php echo $nama_user; ?></p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                    <div class="w-10 h-10 bg-coklat-muda rounded-full flex items-center justify-center text-coklat-tua">
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
            </header>

            <!-- Flash Messages -->
            <div class="px-6 pt-4">
                <?php if($this->session->flashdata('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center justify-between">
                    <span><?php echo $this->session->flashdata('success'); ?></span>
                    <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900"><i class="fas fa-times"></i></button>
                </div>
                <?php endif; ?>
                <?php if($this->session->flashdata('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg flex items-center justify-between">
                    <span><?php echo $this->session->flashdata('error'); ?></span>
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
