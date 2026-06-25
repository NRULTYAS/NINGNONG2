<?php $this->load->view('templates/header_pelanggan'); ?>

<!-- Breadcrumb -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
    <nav class="flex items-center gap-2 text-sm text-text-muted">
        <a href="<?php echo base_url('home'); ?>" class="hover:text-primary transition-colors duration-200">Beranda</a>
        <span class="text-text-subtle">/</span>
        <a href="<?php echo base_url('pesanan/pilih_jenis'); ?>" class="hover:text-primary transition-colors duration-200">Pesan Sekarang</a>
        <span class="text-text-subtle">/</span>
        <span class="text-text-main font-medium">Nyiru / Tampah</span>
    </nav>
</div>

<section class="py-12 bg-background min-h-screen relative overflow-hidden">
    <div class="absolute top-10 right-0 w-72 h-72 bg-secondary-light/15 blob opacity-30"></div>
    <div class="absolute bottom-10 left-0 w-72 h-72 bg-primary/10 blob opacity-30"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-secondary-light/50 text-primary rounded-full text-sm font-medium mb-4 border border-secondary/20">
                <i class="fas fa-bowl-food text-accent text-xs"></i> Paket Nyiru
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-text-main mb-3 font-heading">Pilih Ukuran Nyiru</h1>
            <p class="text-text-muted max-w-lg mx-auto">Pilih ukuran sesuai kebutuhan acara. Setiap ukuran memiliki kapasitas dan harga yang berbeda.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6 mb-10">
            <?php foreach ($ukuran_list as $idx => $u): ?>
            <label class="cursor-pointer">
                <input type="radio" name="id_produk" value="<?php echo $u->id_produk; ?>" class="hidden ukuran-radio" <?php echo $idx === 1 ? 'checked' : ''; ?> data-harga="<?php echo $u->harga; ?>" data-nama="<?php echo $u->nama_produk; ?>">
                <div class="ukuran-card bg-surface rounded-2xl border-2 border-border-subtle/20 p-6 shadow-sm hover:border-primary/40 transition-all duration-200 text-center h-full flex flex-col">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-secondary-light/40 to-background flex items-center justify-center text-primary mx-auto mb-4 shadow-md">
                        <i class="fas fa-bowl-food text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-text-main text-lg mb-1 font-heading"><?php echo $u->nama_produk; ?></h3>
                    <p class="text-xs text-text-muted mb-3"><?php echo $u->deskripsi; ?></p>
                    <p class="text-xl font-extrabold text-primary mb-2">Rp <?php echo number_format($u->harga, 0, ',', '.'); ?></p>
                    <span class="text-xs font-medium text-text-subtle bg-background px-3 py-1 rounded-full inline-block">Tersedia: <?php echo $u->stok; ?> unit</span>
                </div>
            </label>
            <?php endforeach; ?>
        </div>

        <div class="max-w-xl mx-auto">
            <form action="<?php echo base_url('checkout_umum'); ?>" method="get" id="form-ke-checkout">
                <input type="hidden" name="type" value="nyiru">
                <div class="bg-surface rounded-2xl border border-border-subtle/20 shadow-sm p-6 md:p-8">
                    <h3 class="font-bold text-text-main mb-5 text-lg flex items-center gap-3 font-heading">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-500 rounded-xl flex items-center justify-center text-white shadow-md shadow-green-500/20">
                            <i class="fas fa-shopping-cart text-sm"></i>
                        </div>
                        Konfirmasi Pilihan
                    </h3>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-text-main mb-2">Ukuran / Varian <span class="text-red-500">*</span></label>
                        <p class="text-lg font-bold text-primary" id="selected-nama"><?php echo $ukuran_list[1]->nama_produk; ?></p>
                        <p class="text-sm text-text-muted" id="selected-harga">Rp <?php echo number_format($ukuran_list[1]->harga, 0, ',', '.'); ?></p>
                        <input type="hidden" name="id_produk" id="id-produk" value="<?php echo $ukuran_list[1]->id_produk; ?>">
                    </div>
                    <div class="grid md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-2">Jumlah <span class="text-red-500">*</span></label>
                            <input type="number" name="jumlah" value="1" min="1" required class="w-full px-4 py-3 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200">
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-200 flex items-center justify-center gap-2 shadow-md shadow-primary/20">
                        <i class="fas fa-arrow-right text-sm"></i> Lanjut ke Checkout
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const radios = document.querySelectorAll('.ukuran-radio');
    const namaEl = document.getElementById('selected-nama');
    const hargaEl = document.getElementById('selected-harga');
    const hiddenId = document.getElementById('id-produk');

    function updateSelection() {
        const selected = document.querySelector('.ukuran-radio:checked');
        if (!selected) return;
        namaEl.textContent = selected.dataset.nama;
        hargaEl.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(parseInt(selected.dataset.harga) || 0);
        hiddenId.value = selected.value;
    }

    radios.forEach(r => r.addEventListener('change', updateSelection));
});
</script>

<?php $this->load->view('templates/footer_pelanggan'); ?>
