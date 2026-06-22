<?php $this->load->view('templates/header_pelanggan'); ?>

<!-- Breadcrumb -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
    <nav class="flex items-center gap-2 text-sm text-gray-500">
        <a href="<?php echo base_url('home'); ?>" class="hover:text-coklat-tua transition">Beranda</a>
        <span class="text-gray-400">/</span>
        <a href="<?php echo base_url('pesanan/pilih_jenis'); ?>" class="hover:text-coklat-tua transition">Pesan Sekarang</a>
        <span class="text-gray-400">/</span>
        <span class="text-gray-700 font-medium">Nyiru / Tampah</span>
    </nav>
</div>

<section class="py-12 bg-krem min-h-screen relative overflow-hidden">
    <div class="absolute top-10 right-0 w-72 h-72 bg-oranye-pastel/15 blob opacity-30"></div>
    <div class="absolute bottom-10 left-0 w-72 h-72 bg-coklat-muda/15 blob opacity-30"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-oranye-pastel/40 text-coklat-tua rounded-full text-sm font-medium mb-4 border border-oranye/20">
                <i class="fas fa-bowl-food text-oranye text-xs"></i> Paket Nyiru
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-coklat-tua mb-3">Pilih Ukuran Nyiru</h1>
            <p class="text-gray-500 max-w-lg mx-auto">Pilih ukuran sesuai kebutuhan acara. Setiap ukuran memiliki kapasitas dan harga yang berbeda.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6 mb-10">
            <?php foreach ($ukuran_list as $idx => $u): ?>
            <label class="cursor-pointer">
                <input type="radio" name="id_produk" value="<?php echo $u->id_produk; ?>" class="hidden ukuran-radio" <?php echo $idx === 1 ? 'checked' : ''; ?> data-harga="<?php echo $u->harga; ?>" data-nama="<?php echo $u->nama_produk; ?>">
                <div class="ukuran-card bg-white rounded-2xl border-2 border-coklat-muda/20 p-6 shadow-sm hover:border-coklat-tua/40 transition-all text-center h-full flex flex-col">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-oranye-pastel/40 to-krem flex items-center justify-center text-coklat-tua mx-auto mb-4 shadow-md">
                        <i class="fas fa-bowl-food text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg mb-1"><?php echo $u->nama_produk; ?></h3>
                    <p class="text-xs text-gray-400 mb-3"><?php echo $u->deskripsi; ?></p>
                    <p class="text-xl font-extrabold text-coklat-tua mb-2">Rp <?php echo number_format($u->harga, 0, ',', '.'); ?></p>
                    <span class="text-xs font-medium text-gray-500 bg-krem px-3 py-1 rounded-full inline-block">Tersedia: <?php echo $u->stok; ?> unit</span>
                </div>
            </label>
            <?php endforeach; ?>
        </div>

        <div class="max-w-xl mx-auto">
            <form action="<?php echo base_url('checkout_umum'); ?>" method="get" id="form-ke-checkout">
                <input type="hidden" name="type" value="nyiru">
                <div class="bg-white rounded-2xl border border-coklat-muda/20 shadow-sm p-6 md:p-8">
                    <h3 class="font-bold text-gray-800 mb-5 text-lg flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-500 rounded-xl flex items-center justify-center text-white shadow-md shadow-green-500/20">
                            <i class="fas fa-shopping-cart text-sm"></i>
                        </div>
                        Konfirmasi Pilihan
                    </h3>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ukuran / Varian <span class="text-red-500">*</span></label>
                        <p class="text-lg font-bold text-coklat-tua" id="selected-nama"><?php echo $ukuran_list[1]->nama_produk; ?></p>
                        <p class="text-sm text-gray-500" id="selected-harga">Rp <?php echo number_format($ukuran_list[1]->harga, 0, ',', '.'); ?></p>
                        <input type="hidden" name="id_produk" id="id-produk" value="<?php echo $ukuran_list[1]->id_produk; ?>">
                    </div>
                    <div class="grid md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah <span class="text-red-500">*</span></label>
                            <input type="number" name="jumlah" value="1" min="1" required class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition">
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-coklat-tua/25 transition-all hover:scale-[1.02] flex items-center justify-center gap-2">
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
