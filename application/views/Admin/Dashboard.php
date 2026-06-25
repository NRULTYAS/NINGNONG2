<?php $this->load->view('templates/header_admin'); ?>

<div class="py-6">
    <h1 class="text-2xl font-bold text-primary font-heading">Dashboard</h1>
    <p class="text-text-subtle">Ringkasan data toko hari ini</p>
</div>

<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-surface rounded-2xl shadow-sm border border-border-subtle p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center text-white shadow-md shadow-primary/20">
                <i class="fas fa-cookie text-lg"></i>
            </div>
            <span class="text-xs text-text-muted font-medium bg-accent-light px-2 py-1 rounded-lg">Total</span>
        </div>
        <p class="text-3xl font-extrabold text-primary"><?php echo $total_produk; ?></p>
        <p class="text-text-subtle text-sm">Produk</p>
    </div>
    <div class="bg-surface rounded-2xl shadow-sm border border-border-subtle p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-secondary rounded-xl flex items-center justify-center text-white shadow-md shadow-secondary/20">
                <i class="fas fa-receipt text-lg"></i>
            </div>
            <span class="text-xs text-text-muted font-medium bg-accent-light px-2 py-1 rounded-lg">Total</span>
        </div>
        <p class="text-3xl font-extrabold text-primary"><?php echo $total_pesanan; ?></p>
        <p class="text-text-subtle text-sm">Pesanan</p>
    </div>
    <div class="bg-surface rounded-2xl shadow-sm border border-border-subtle p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-secondary rounded-xl flex items-center justify-center text-white shadow-md shadow-secondary/20">
                <i class="fas fa-users text-lg"></i>
            </div>
            <span class="text-xs text-text-muted font-medium bg-accent-light px-2 py-1 rounded-lg">Total</span>
        </div>
        <p class="text-3xl font-extrabold text-primary"><?php echo $total_pelanggan; ?></p>
        <p class="text-text-subtle text-sm">Pelanggan</p>
    </div>
    <div class="bg-surface rounded-2xl shadow-sm border border-border-subtle p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-accent rounded-xl flex items-center justify-center text-white shadow-md shadow-accent/20">
                <i class="fas fa-wallet text-lg"></i>
            </div>
            <span class="text-xs text-text-muted font-medium bg-accent-light px-2 py-1 rounded-lg">Total</span>
        </div>
        <p class="text-3xl font-extrabold text-primary">Rp <?php echo number_format($total_penjualan,0,',','.'); ?></p>
        <p class="text-text-subtle text-sm">Penjualan</p>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-6 mb-8">
    <div class="bg-surface rounded-2xl shadow-sm border border-border-subtle p-6">
        <h3 class="font-bold text-text-main mb-5 text-lg font-heading">Status Pesanan</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between p-4 bg-accent-light rounded-xl border border-border-subtle">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-accent/10 rounded-lg flex items-center justify-center text-accent"><i class="fas fa-clock text-sm"></i></div>
                    <span class="font-medium text-text-main">Pending</span>
                </div>
                <span class="text-xl font-bold text-accent"><?php echo $pesanan_pending; ?></span>
            </div>
            <div class="flex items-center justify-between p-4 bg-secondary-light rounded-xl border border-border-subtle">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-secondary/10 rounded-lg flex items-center justify-center text-secondary"><i class="fas fa-cog text-sm"></i></div>
                    <span class="font-medium text-text-main">Diproses</span>
                </div>
                <span class="text-xl font-bold text-secondary"><?php echo $pesanan_diproses; ?></span>
            </div>
            <div class="flex items-center justify-between p-4 bg-purple-50 rounded-xl border border-purple-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600"><i class="fas fa-shipping-fast text-sm"></i></div>
                    <span class="font-medium text-text-main">Dikirim</span>
                </div>
                <span class="text-xl font-bold text-purple-600"><?php echo $pesanan_dikirim; ?></span>
            </div>
            <div class="flex items-center justify-between p-4 bg-secondary-light rounded-xl border border-border-subtle">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-secondary/10 rounded-lg flex items-center justify-center text-secondary"><i class="fas fa-check-circle text-sm"></i></div>
                    <span class="font-medium text-text-main">Selesai</span>
                </div>
                <span class="text-xl font-bold text-secondary"><?php echo $pesanan_selesai; ?></span>
            </div>
        </div>
    </div>
    <div class="bg-surface rounded-2xl shadow-sm border border-border-subtle p-6">
        <h3 class="font-bold text-text-main mb-5 text-lg font-heading">Menu Cepat</h3>
        <div class="grid grid-cols-2 gap-6">
            <a href="<?php echo base_url('admin/produk/tambah'); ?>" class="p-6 bg-secondary-light rounded-xl text-center hover:shadow-md transition border border-border-subtle group">
                <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center text-white mx-auto mb-3 shadow-md shadow-primary/20 group-hover:shadow-lg transition">
                    <i class="fas fa-plus text-lg"></i>
                </div>
                <p class="font-semibold text-text-main text-sm">Tambah Produk</p>
            </a>
            <a href="<?php echo base_url('admin/kategori/tambah'); ?>" class="p-6 bg-accent-light rounded-xl text-center hover:shadow-md transition border border-border-subtle group">
                <div class="w-12 h-12 bg-accent rounded-xl flex items-center justify-center text-white mx-auto mb-3 shadow-md shadow-accent/20 group-hover:shadow-lg transition">
                    <i class="fas fa-tag text-lg"></i>
                </div>
                <p class="font-semibold text-text-main text-sm">Tambah Kategori</p>
            </a>
            <a href="<?php echo base_url('admin/pesanan'); ?>" class="p-6 bg-secondary-light rounded-xl text-center hover:shadow-md transition border border-border-subtle group">
                <div class="w-12 h-12 bg-secondary rounded-xl flex items-center justify-center text-white mx-auto mb-3 shadow-md shadow-secondary/20 group-hover:shadow-lg transition">
                    <i class="fas fa-clipboard-list text-lg"></i>
                </div>
                <p class="font-semibold text-text-main text-sm">Kelola Pesanan</p>
            </a>
            <a href="<?php echo base_url('admin/laporan'); ?>" class="p-6 bg-secondary-light rounded-xl text-center hover:shadow-md transition border border-border-subtle group">
                <div class="w-12 h-12 bg-secondary rounded-xl flex items-center justify-center text-white mx-auto mb-3 shadow-md shadow-secondary/20 group-hover:shadow-lg transition">
                    <i class="fas fa-chart-bar text-lg"></i>
                </div>
                <p class="font-semibold text-text-main text-sm">Laporan Penjualan</p>
            </a>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer_admin'); ?>
