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

<section class="py-12 bg-background min-h-screen relative overflow-hidden pb-20 md:pb-12">
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

        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-6 mb-10">
            <?php foreach ($ukuran_list as $idx => $u): ?>
            <?php if ($idx === 2): ?>
            <!-- Card ketiga (Nyiru Besar) - center -->
            <div class="col-span-2 flex justify-center">
                <label class="cursor-pointer w-full max-w-[calc(50%-0.375rem)]">
                    <input type="radio" name="id_produk" value="<?php echo $u->id_produk; ?>" class="hidden ukuran-radio" <?php echo $idx === 1 ? 'checked' : ''; ?> data-harga="<?php echo $u->harga; ?>" data-nama="<?php echo $u->nama_produk; ?>" data-deskripsi="<?php echo $u->deskripsi; ?>">
                    <div class="ukuran-card bg-surface rounded-2xl border-2 border-border-subtle/20 p-4 shadow-sm hover:border-primary/40 transition-all duration-200 text-center h-full flex flex-col">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-secondary-light/40 to-background flex items-center justify-center text-primary mx-auto mb-3 shadow-md">
                            <i class="fas fa-bowl-food text-xl"></i>
                        </div>
                        <h3 class="font-semibold text-base text-text-main mb-2 font-heading"><?php echo $u->nama_produk; ?></h3>
                        <p class="text-xs text-text-muted mb-2 line-clamp-2"><?php echo $u->deskripsi; ?></p>
                        <p class="text-lg font-extrabold text-primary mb-2">Rp <?php echo number_format($u->harga, 0, ',', '.'); ?></p>
                        <span class="text-xs px-2 py-1 rounded-full inline-block bg-background">Tersedia: <?php echo $u->stok; ?> unit</span>
                    </div>
                </label>
            </div>
            <?php else: ?>
            <label class="cursor-pointer">
                <input type="radio" name="id_produk" value="<?php echo $u->id_produk; ?>" class="hidden ukuran-radio" <?php echo $idx === 1 ? 'checked' : ''; ?> data-harga="<?php echo $u->harga; ?>" data-nama="<?php echo $u->nama_produk; ?>" data-deskripsi="<?php echo $u->deskripsi; ?>">
                <div class="ukuran-card bg-surface rounded-2xl border-2 border-border-subtle/20 p-4 shadow-sm hover:border-primary/40 transition-all duration-200 text-center h-full flex flex-col">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-secondary-light/40 to-background flex items-center justify-center text-primary mx-auto mb-3 shadow-md">
                        <i class="fas fa-bowl-food text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-base text-text-main mb-2 font-heading"><?php echo $u->nama_produk; ?></h3>
                    <p class="text-xs text-text-muted mb-2 line-clamp-2"><?php echo $u->deskripsi; ?></p>
                    <p class="text-lg font-extrabold text-primary mb-2">Rp <?php echo number_format($u->harga, 0, ',', '.'); ?></p>
                    <span class="text-xs px-2 py-1 rounded-full inline-block bg-background">Tersedia: <?php echo $u->stok; ?> unit</span>
                </div>
            </label>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Mobile Bottom Bar (Konfirmasi Pilihan) -->
        <div id="mobileBottomBar" class="fixed bottom-0 left-0 right-0 bg-white border-t border-border-subtle/30 shadow-[0_-2px_10px_rgba(0,0,0,0.1)] p-3 flex items-center justify-between z-50 md:hidden">
            <div class="flex-1 cursor-pointer" onclick="toggleModal()">
                <div class="text-xs text-text-subtle">Terpilih</div>
                <div class="font-semibold text-sm" id="mobileSummary"><?php echo $ukuran_list[1]->nama_produk; ?> • Rp <?php echo number_format($ukuran_list[1]->harga, 0, ',', '.'); ?></div>
            </div>
            <button type="submit" form="form-ke-checkout" class="px-4 py-2 bg-primary text-white rounded-lg font-semibold text-sm hover:bg-primary-hover transition">
                Checkout
            </button>
        </div>

        <!-- Mobile Modal (Detail Konfirmasi) -->
        <div id="mobileModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
            <div class="bg-white rounded-2xl w-full max-w-sm max-h-[80vh] flex flex-col">
                <div class="p-4 border-b border-border-subtle/20">
                    <div class="flex items-center justify-between">
                        <h3 class="font-bold text-lg">Konfirmasi Pilihan</h3>
                        <button onclick="toggleModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="p-4 flex-1 overflow-auto">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-text-main mb-2">Ukuran / Varian</label>
                        <p class="text-lg font-bold text-primary" id="modal-selected-nama"><?php echo $ukuran_list[1]->nama_produk; ?></p>
                        <p class="text-sm text-text-muted" id="modal-selected-harga">Rp <?php echo number_format($ukuran_list[1]->harga, 0, ',', '.'); ?></p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-text-main mb-2">Jumlah</label>
                        <input type="number" name="jumlah" value="1" min="1" id="modal-jumlah" class="w-full px-3 py-2 rounded-lg border border-border-subtle/30 focus:outline-none focus:border-primary">
                    </div>
                </div>
                <div class="p-4 border-t border-border-subtle/20">
                    <div class="flex gap-2">
                        <button onclick="toggleModal()" class="flex-1 px-3 py-2 border border-border-subtle/20 rounded-lg text-sm">Tutup</button>
                        <button type="submit" form="form-ke-checkout" class="flex-1 px-3 py-2 bg-primary text-white rounded-lg font-semibold text-sm hover:bg-primary-hover transition">
                            Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form (hidden on mobile, used by both desktop and mobile) -->
        <form action="<?php echo base_url('checkout_umum'); ?>" method="get" id="form-ke-checkout" class="hidden">
            <input type="hidden" name="type" value="nyiru">
            <input type="hidden" name="id_produk" id="id-produk" value="<?php echo $ukuran_list[1]->id_produk; ?>">
            <input type="hidden" name="jumlah" id="hidden-jumlah" value="1">
        </form>

        <!-- Desktop: Card Konfirmasi Pilihan -->
        <div class="max-w-xl mx-auto hidden md:block">
            <div class="bg-surface rounded-2xl border border-border-subtle/20 shadow-sm p-4 md:p-6">
                <h3 class="font-bold text-text-main mb-3 md:mb-5 text-base md:text-lg flex items-center gap-2 md:gap-3 font-heading">
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-gradient-to-br from-green-400 to-green-500 rounded-lg md:rounded-xl flex items-center justify-center text-white shadow-md shadow-green-500/20">
                        <i class="fas fa-shopping-cart text-xs md:text-sm"></i>
                    </div>
                    Konfirmasi Pilihan
                </h3>
                <div class="mb-3 md:mb-4">
                    <label class="block text-xs md:text-sm font-medium text-text-main mb-1 md:mb-2">Ukuran / Varian <span class="text-red-500">*</span></label>
                    <p class="text-sm md:text-lg font-bold text-primary" id="selected-nama"><?php echo $ukuran_list[1]->nama_produk; ?></p>
                    <p class="text-xs md:text-sm text-text-muted" id="selected-harga">Rp <?php echo number_format($ukuran_list[1]->harga, 0, ',', '.'); ?></p>
                </div>
                <div class="grid md:grid-cols-2 gap-3 md:gap-4 mb-4 md:mb-6">
                    <div>
                        <label class="block text-xs md:text-sm font-medium text-text-main mb-1 md:mb-2">Jumlah <span class="text-red-500">*</span></label>
                        <input type="number" name="jumlah" value="1" min="1" id="desktop-jumlah" required class="w-full px-3 md:px-4 py-2 md:py-3 rounded-lg md:rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200">
                    </div>
                </div>

                <button type="submit" form="form-ke-checkout" class="w-full py-2 md:py-3.5 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-200 flex items-center justify-center gap-1 md:gap-2 shadow-md shadow-primary/20">
                    <i class="fas fa-arrow-right text-xs md:text-sm"></i> Lanjut ke Checkout
                </button>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const radios = document.querySelectorAll('.ukuran-radio');
    const namaEl = document.getElementById('selected-nama');
    const hargaEl = document.getElementById('selected-harga');
    const hiddenId = document.getElementById('id-produk');
    const hiddenJumlah = document.getElementById('hidden-jumlah');
    const desktopJumlah = document.getElementById('desktop-jumlah');
    const modalJumlah = document.getElementById('modal-jumlah');
    const mobileSummary = document.getElementById('mobileSummary');
    const modalSelectedNama = document.getElementById('modal-selected-nama');
    const modalSelectedHarga = document.getElementById('modal-selected-harga');

    function updateSelection() {
        const selected = document.querySelector('.ukuran-radio:checked');
        if (!selected) return;
        const hargaFormatted = 'Rp ' + new Intl.NumberFormat('id-ID').format(parseInt(selected.dataset.harga) || 0);
        
        // Update desktop
        if (namaEl) namaEl.textContent = selected.dataset.nama;
        if (hargaEl) hargaEl.textContent = hargaFormatted;
        
        // Update mobile
        if (mobileSummary) mobileSummary.textContent = selected.dataset.nama + ' • ' + hargaFormatted;
        if (modalSelectedNama) modalSelectedNama.textContent = selected.dataset.nama;
        if (modalSelectedHarga) modalSelectedHarga.textContent = hargaFormatted;
        
        // Update hidden form inputs
        if (hiddenId) hiddenId.value = selected.value;
    }

    // Sync jumlah input
    if (desktopJumlah) {
        desktopJumlah.addEventListener('input', function() {
            if (hiddenJumlah) hiddenJumlah.value = this.value;
        });
    }
    
    if (modalJumlah) {
        modalJumlah.addEventListener('input', function() {
            if (hiddenJumlah) hiddenJumlah.value = this.value;
            if (desktopJumlah) desktopJumlah.value = this.value;
        });
    }

    radios.forEach(r => r.addEventListener('change', updateSelection));
    
    // Initialize
    updateSelection();
});

// Mobile modal functions
function toggleModal() {
    const modal = document.getElementById('mobileModal');
    if(modal) {
        modal.classList.toggle('hidden');
        modal.classList.toggle('flex');
    }
}
</script>

<?php $this->load->view('templates/footer_pelanggan'); ?>