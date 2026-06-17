<?php $this->load->view('templates/header_admin'); ?>

<div class="mb-8">
    <h1 class="text-2xl font-bold text-coklat-tua">Dashboard</h1>
    <p class="text-gray-500">Ringkasan data toko hari ini</p>
</div>

<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 border border-coklat-muda/20">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-coklat-tua/10 rounded-xl flex items-center justify-center text-coklat-tua">
                <i class="fas fa-cookie text-xl"></i>
            </div>
            <span class="text-sm text-green-600 font-medium">Total</span>
        </div>
        <p class="text-3xl font-bold text-coklat-tua"><?php echo $total_produk; ?></p>
        <p class="text-gray-500 text-sm">Produk</p>
    </div>
    <div class="bg-white rounded-2xl p-6 border border-coklat-muda/20">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600">
                <i class="fas fa-receipt text-xl"></i>
            </div>
            <span class="text-sm text-blue-600 font-medium">Total</span>
        </div>
        <p class="text-3xl font-bold text-coklat-tua"><?php echo $total_pesanan; ?></p>
        <p class="text-gray-500 text-sm">Pesanan</p>
    </div>
    <div class="bg-white rounded-2xl p-6 border border-coklat-muda/20">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-green-600">
                <i class="fas fa-users text-xl"></i>
            </div>
            <span class="text-sm text-green-600 font-medium">Total</span>
        </div>
        <p class="text-3xl font-bold text-coklat-tua"><?php echo $total_pelanggan; ?></p>
        <p class="text-gray-500 text-sm">Pelanggan</p>
    </div>
    <div class="bg-white rounded-2xl p-6 border border-coklat-muda/20">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-oranye-pastel rounded-xl flex items-center justify-center text-coklat-tua">
                <i class="fas fa-wallet text-xl"></i>
            </div>
            <span class="text-sm text-oranye font-medium">Total</span>
        </div>
        <p class="text-3xl font-bold text-coklat-tua">Rp <?php echo number_format($total_penjualan,0,',','.'); ?></p>
        <p class="text-gray-500 text-sm">Penjualan</p>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 border border-coklat-muda/20">
        <h3 class="font-semibold text-lg text-gray-800 mb-4">Status Pesanan</h3>
        <div class="space-y-4">
            <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-xl">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center text-yellow-600"><i class="fas fa-clock"></i></div>
                    <span class="font-medium">Pending</span>
                </div>
                <span class="text-xl font-bold text-yellow-600"><?php echo $pesanan_pending; ?></span>
            </div>
            <div class="flex items-center justify-between p-4 bg-blue-50 rounded-xl">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600"><i class="fas fa-cog"></i></div>
                    <span class="font-medium">Diproses</span>
                </div>
                <span class="text-xl font-bold text-blue-600"><?php echo $pesanan_diproses; ?></span>
            </div>
            <div class="flex items-center justify-between p-4 bg-purple-50 rounded-xl">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600"><i class="fas fa-shipping-fast"></i></div>
                    <span class="font-medium">Dikirim</span>
                </div>
                <span class="text-xl font-bold text-purple-600"><?php echo $pesanan_dikirim; ?></span>
            </div>
            <div class="flex items-center justify-between p-4 bg-green-50 rounded-xl">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-green-600"><i class="fas fa-check-circle"></i></div>
                    <span class="font-medium">Selesai</span>
                </div>
                <span class="text-xl font-bold text-green-600"><?php echo $pesanan_selesai; ?></span>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-6 border border-coklat-muda/20">
        <h3 class="font-semibold text-lg text-gray-800 mb-4">Menu Cepat</h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="<?php echo base_url('admin/produk/tambah'); ?>" class="p-6 bg-krem rounded-xl text-center hover:bg-coklat-muda/20 transition border border-coklat-muda/20">
                <i class="fas fa-plus-circle text-3xl text-coklat-tua mb-3"></i>
                <p class="font-medium text-gray-800">Tambah Produk</p>
            </a>
            <a href="<?php echo base_url('admin/kategori/tambah'); ?>" class="p-6 bg-krem rounded-xl text-center hover:bg-coklat-muda/20 transition border border-coklat-muda/20">
                <i class="fas fa-tag text-3xl text-coklat-tua mb-3"></i>
                <p class="font-medium text-gray-800">Tambah Kategori</p>
            </a>
            <a href="<?php echo base_url('admin/pesanan'); ?>" class="p-6 bg-krem rounded-xl text-center hover:bg-coklat-muda/20 transition border border-coklat-muda/20">
                <i class="fas fa-clipboard-list text-3xl text-coklat-tua mb-3"></i>
                <p class="font-medium text-gray-800">Kelola Pesanan</p>
            </a>
            <a href="<?php echo base_url('admin/laporan'); ?>" class="p-6 bg-krem rounded-xl text-center hover:bg-coklat-muda/20 transition border border-coklat-muda/20">
                <i class="fas fa-chart-bar text-3xl text-coklat-tua mb-3"></i>
                <p class="font-medium text-gray-800">Laporan Penjualan</p>
            </a>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer_admin'); ?>
