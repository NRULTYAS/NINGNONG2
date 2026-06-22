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
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #D7CCC8; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #8D6E63; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Mobile Backdrop -->
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden backdrop-blur-sm transition-opacity" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside id="admin-sidebar" class="fixed left-0 top-0 h-screen w-64 bg-gradient-to-b from-coklat-tua to-[#4E342E] text-white z-50 flex flex-col shadow-2xl shadow-coklat-tua/30 transition-transform duration-300 -translate-x-full lg:translate-x-0">
        <!-- Logo -->
        <div class="h-16 flex items-center gap-3 px-6 border-b border-white/10 flex-shrink-0">
            <div class="w-9 h-9 bg-white rounded-lg flex items-center justify-center text-coklat-tua font-bold shadow-md">N</div>
            <div>
                <span class="font-bold text-sm leading-tight block">NINGNONG</span>
                <span class="text-[10px] text-coklat-muda tracking-wider uppercase">Admin Panel</span>
            </div>
            <button onclick="toggleSidebar()" class="ml-auto lg:hidden text-white/70 hover:text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-0.5">
            <a href="<?php echo base_url('admin/dashboard'); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition text-sm <?php echo $this->uri->segment(2) == 'dashboard' ? 'bg-white/15 font-medium' : 'text-white/80'; ?>">
                <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-chart-pie text-xs"></i></div>
                <span>Dashboard</span>
            </a>
            <a href="<?php echo base_url('admin/catering'); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition text-sm <?php echo $this->uri->segment(2) == 'catering' ? 'bg-white/15 font-medium' : 'text-white/80'; ?>">
                <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-box-open text-xs"></i></div>
                <span>Catering</span>
            </a>
            <a href="<?php echo base_url('admin/produk'); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition text-sm <?php echo $this->uri->segment(2) == 'produk' ? 'bg-white/15 font-medium' : 'text-white/80'; ?>">
                <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-cookie text-xs"></i></div>
                <span>Produk</span>
            </a>
            <a href="<?php echo base_url('admin/kategori'); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition text-sm <?php echo $this->uri->segment(2) == 'kategori' ? 'bg-white/15 font-medium' : 'text-white/80'; ?>">
                <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-tags text-xs"></i></div>
                <span>Kategori</span>
            </a>
            <a href="<?php echo base_url('admin/pesanan'); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition text-sm <?php echo $this->uri->segment(2) == 'pesanan' ? 'bg-white/15 font-medium' : 'text-white/80'; ?>">
                <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-receipt text-xs"></i></div>
                <span>Pesanan</span>
            </a>
            <a href="<?php echo base_url('admin/laporan'); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition text-sm <?php echo $this->uri->segment(2) == 'laporan' ? 'bg-white/15 font-medium' : 'text-white/80'; ?>">
                <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-file-invoice-dollar text-xs"></i></div>
                <span>Laporan</span>
            </a>
        </nav>

        <!-- Bottom Actions -->
        <div class="p-3 border-t border-white/10 space-y-0.5 flex-shrink-0">
            <a href="<?php echo base_url('home'); ?>" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10 transition text-sm text-white/80">
                <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-store text-xs"></i></div>
                <span>Lihat Website</span>
            </a>
            <a href="<?php echo base_url('auth/logout'); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-red-500/20 transition text-sm text-red-300">
                <div class="w-8 h-8 bg-red-500/20 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-sign-out-alt text-xs"></i></div>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <!-- Main Wrapper -->
    <div class="lg:ml-64 min-h-screen flex flex-col">
        <!-- Topbar -->
        <header class="h-16 bg-white border-b border-gray-200 px-6 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="lg:hidden text-gray-500 hover:text-coklat-tua p-1">
                    <i class="fas fa-bars text-lg"></i>
                </button>
                <h2 class="text-lg font-bold text-coklat-tua hidden sm:block">
                    <?php
                    $seg = $this->uri->segment(2);
                    $titles = ['dashboard'=>'Dashboard','catering'=>'Kelola Catering','produk'=>'Kelola Produk','kategori'=>'Kelola Kategori','pesanan'=>'Kelola Pesanan','laporan'=>'Laporan Penjualan'];
                    echo isset($titles[$seg]) ? $titles[$seg] : 'Admin Panel';
                    ?>
                </h2>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="font-semibold text-sm text-gray-800 leading-tight"><?php echo $nama_user; ?></p>
                    <p class="text-[11px] text-gray-400">Administrator</p>
                </div>
                <div class="w-9 h-9 bg-gradient-to-br from-coklat-tua to-coklat rounded-lg flex items-center justify-center text-white shadow-sm">
                    <i class="fas fa-user-shield text-xs"></i>
                </div>
            </div>
        </header>

        <!-- Flash Messages -->
        <div class="px-6 pt-5">
            <?php if($this->session->flashdata('success')): ?>
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center justify-between mb-4">
                <span class="flex items-center gap-2 text-sm"><i class="fas fa-check-circle"></i> <?php echo $this->session->flashdata('success'); ?></span>
                <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900"><i class="fas fa-times"></i></button>
            </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center justify-between mb-4">
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
