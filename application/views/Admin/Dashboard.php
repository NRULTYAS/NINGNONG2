<?php $this->load->view('templates/header_admin'); ?>

<div class="mb-8">
    <h1 class="text-2xl font-bold text-coklat-tua">Dashboard</h1>
    <p class="text-gray-400">Ringkasan data toko hari ini</p>
</div>

<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-coklat-muda/20 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-gradient-to-br from-coklat-tua to-coklat rounded-xl flex items-center justify-center text-white shadow-md shadow-coklat-tua/20">
                <i class="fas fa-cookie text-lg"></i>
            </div>
            <span class="text-xs text-gray-400 font-medium bg-krem px-2 py-1 rounded-lg">Total</span>
        </div>
        <p class="text-3xl font-extrabold text-coklat-tua"><?php echo $total_produk; ?></p>
        <p class="text-gray-400 text-sm">Produk</p>
    </div>
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-coklat-muda/20 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-400 rounded-xl flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                <i class="fas fa-receipt text-lg"></i>
            </div>
            <span class="text-xs text-gray-400 font-medium bg-krem px-2 py-1 rounded-lg">Total</span>
        </div>
        <p class="text-3xl font-extrabold text-coklat-tua"><?php echo $total_pesanan; ?></p>
        <p class="text-gray-400 text-sm">Pesanan</p>
    </div>
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-coklat-muda/20 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-400 rounded-xl flex items-center justify-center text-white shadow-md shadow-green-500/20">
                <i class="fas fa-users text-lg"></i>
            </div>
            <span class="text-xs text-gray-400 font-medium bg-krem px-2 py-1 rounded-lg">Total</span>
        </div>
        <p class="text-3xl font-extrabold text-coklat-tua"><?php echo $total_pelanggan; ?></p>
        <p class="text-gray-400 text-sm">Pelanggan</p>
    </div>
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-coklat-muda/20 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-gradient-to-br from-oranye to-oranye-pastel rounded-xl flex items-center justify-center text-white shadow-md shadow-oranye/20">
                <i class="fas fa-wallet text-lg"></i>
            </div>
            <span class="text-xs text-gray-400 font-medium bg-krem px-2 py-1 rounded-lg">Total</span>
        </div>
        <p class="text-3xl font-extrabold text-coklat-tua">Rp <?php echo number_format($total_penjualan,0,',','.'); ?></p>
        <p class="text-gray-400 text-sm">Penjualan</p>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-coklat-muda/20 shadow-sm">
        <h3 class="font-bold text-gray-800 mb-5 text-lg">Status Pesanan</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-xl border border-yellow-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center text-yellow-600"><i class="fas fa-clock text-sm"></i></div>
                    <span class="font-medium text-gray-700">Pending</span>
                </div>
                <span class="text-xl font-bold text-yellow-600"><?php echo $pesanan_pending; ?></span>
            </div>
            <div class="flex items-center justify-between p-4 bg-blue-50 rounded-xl border border-blue-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600"><i class="fas fa-cog text-sm"></i></div>
                    <span class="font-medium text-gray-700">Diproses</span>
                </div>
                <span class="text-xl font-bold text-blue-600"><?php echo $pesanan_diproses; ?></span>
            </div>
            <div class="flex items-center justify-between p-4 bg-purple-50 rounded-xl border border-purple-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600"><i class="fas fa-shipping-fast text-sm"></i></div>
                    <span class="font-medium text-gray-700">Dikirim</span>
                </div>
                <span class="text-xl font-bold text-purple-600"><?php echo $pesanan_dikirim; ?></span>
            </div>
            <div class="flex items-center justify-between p-4 bg-green-50 rounded-xl border border-green-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-green-600"><i class="fas fa-check-circle text-sm"></i></div>
                    <span class="font-medium text-gray-700">Selesai</span>
                </div>
                <span class="text-xl font-bold text-green-600"><?php echo $pesanan_selesai; ?></span>
            </div>
        </div>
    </div>
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-coklat-muda/20 shadow-sm">
        <h3 class="font-bold text-gray-800 mb-5 text-lg">Menu Cepat</h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="<?php echo base_url('admin/produk/tambah'); ?>" class="p-6 bg-gradient-to-br from-krem to-white rounded-xl text-center hover:shadow-md transition border border-coklat-muda/20 group">
                <div class="w-12 h-12 bg-gradient-to-br from-coklat-tua to-coklat rounded-xl flex items-center justify-center text-white mx-auto mb-3 shadow-md shadow-coklat-tua/20 group-hover:shadow-lg transition">
                    <i class="fas fa-plus text-lg"></i>
                </div>
                <p class="font-semibold text-gray-800 text-sm">Tambah Produk</p>
            </a>
            <a href="<?php echo base_url('admin/kategori/tambah'); ?>" class="p-6 bg-gradient-to-br from-krem to-white rounded-xl text-center hover:shadow-md transition border border-coklat-muda/20 group">
                <div class="w-12 h-12 bg-gradient-to-br from-oranye to-oranye-pastel rounded-xl flex items-center justify-center text-white mx-auto mb-3 shadow-md shadow-oranye/20 group-hover:shadow-lg transition">
                    <i class="fas fa-tag text-lg"></i>
                </div>
                <p class="font-semibold text-gray-800 text-sm">Tambah Kategori</p>
            </a>
            <a href="<?php echo base_url('admin/pesanan'); ?>" class="p-6 bg-gradient-to-br from-krem to-white rounded-xl text-center hover:shadow-md transition border border-coklat-muda/20 group">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-400 rounded-xl flex items-center justify-center text-white mx-auto mb-3 shadow-md shadow-blue-500/20 group-hover:shadow-lg transition">
                    <i class="fas fa-clipboard-list text-lg"></i>
                </div>
                <p class="font-semibold text-gray-800 text-sm">Kelola Pesanan</p>
            </a>
            <a href="<?php echo base_url('admin/laporan'); ?>" class="p-6 bg-gradient-to-br from-krem to-white rounded-xl text-center hover:shadow-md transition border border-coklat-muda/20 group">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-400 rounded-xl flex items-center justify-center text-white mx-auto mb-3 shadow-md shadow-green-500/20 group-hover:shadow-lg transition">
                    <i class="fas fa-chart-bar text-lg"></i>
                </div>
                <p class="font-semibold text-gray-800 text-sm">Laporan Penjualan</p>
            </a>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer_admin'); ?>
