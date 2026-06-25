<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-12 bg-background min-h-screen relative overflow-hidden">
    <div class="absolute top-10 right-0 w-72 h-72 bg-secondary-light/15 blob opacity-30"></div>
    <div class="absolute bottom-10 left-0 w-72 h-72 bg-primary/10 blob opacity-30"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-text-muted mb-8">
            <a href="<?php echo base_url('home'); ?>" class="hover:text-primary transition-colors duration-200">Beranda</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="<?php echo base_url('catering'); ?>" class="hover:text-primary transition-colors duration-200">Catering</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-primary font-medium">Kustomisasi</span>
        </div>

        <!-- Header -->
        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-secondary-light/40 text-primary rounded-full text-sm font-medium mb-3 border border-secondary/20">
                <i class="fas fa-pen text-accent text-xs"></i> Kustomisasi Paket
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-text-main mb-2 font-heading"><?php echo $paket->nama_paket; ?></h1>
            <p class="text-text-muted max-w-xl mx-auto">Sesuaikan menu sesuai keinginan Anda.</p>
        </div>

        <!-- Budget Info -->
        <div class="max-w-3xl mx-auto mb-8">
            <div class="bg-surface rounded-2xl border border-border-subtle/20 shadow-sm p-4 sm:p-6">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
                    <div class="p-3 bg-background rounded-xl">
                        <p class="text-xs text-text-subtle font-medium uppercase tracking-wider">Harga Paket Dasar</p>
                        <p class="text-xl font-extrabold text-primary" id="harga-paket">Rp <?php echo number_format($paket->harga, 0, ',', '.'); ?></p>
                    </div>
                    <div class="p-3 bg-background rounded-xl">
                        <p class="text-xs text-text-subtle font-medium uppercase tracking-wider">Biaya Tambahan</p>
                        <p class="text-xl font-extrabold text-primary" id="biaya-tambahan">Rp 0</p>
                    </div>
                    <div class="p-3 bg-background rounded-xl">
                        <p class="text-xs text-text-subtle font-medium uppercase tracking-wider">Total Pesanan</p>
                        <p class="text-xl font-extrabold text-primary" id="total-pesanan">Rp <?php echo number_format($paket->harga, 0, ',', '.'); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <?php echo form_open('catering_kustom/proses', ['id' => 'form-kustom']); ?>
        <input type="hidden" name="paket_id" value="<?php echo $paket->id; ?>">

        <div class="max-w-7xl mx-auto space-y-6 lg:space-y-0 lg:grid lg:grid-cols-2 lg:gap-6">
            <?php foreach ($kategori_list as $kat):
                $kategori = $kat->kategori;
                $items = $items_by_kategori[$kategori];
            ?>
            <div class="bg-surface rounded-2xl border border-border-subtle/20 shadow-sm overflow-hidden">
                <div class="px-5 py-4 bg-gradient-to-r from-primary/5 to-primary-hover/5 border-b border-border-subtle/20">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary to-primary-hover flex items-center justify-center text-white text-xs font-bold shadow-sm">
                            <?php
                            $icons = ['Nasi' => 'fa-utensils', 'Lauk' => 'fa-drumstick-bite', 'Sayur' => 'fa-carrot', 'Tambahan' => 'fa-plus-circle'];
                            echo '<i class="fas ' . ($icons[$kategori] ?? 'fa-box') . '"></i>';
                            ?>
                        </div>
                        <h3 class="font-bold text-text-main font-heading"><?php echo $kategori; ?></h3>
                        <span class="text-xs text-text-subtle ml-auto">Pilih 1 item</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="grid sm:grid-cols-2 xl:grid-cols-2 gap-5">
                        <?php foreach ($items as $item):
                            $is_default = $item->is_default == 1;
                        ?>
                        <label class="item-option relative block cursor-pointer <?php echo $is_default ? 'ring-2 ring-accent' : ''; ?> bg-surface border <?php echo $is_default ? 'border-accent' : 'border-border-subtle/30'; ?> rounded-2xl p-4 shadow-sm card-hover" data-harga="<?php echo $item->harga; ?>" data-kategori="<?php echo $kategori; ?>">
                            <input type="radio" name="selected_items[<?php echo $kategori; ?>]" value="<?php echo $item->id; ?>" class="hidden item-radio" <?php echo $is_default ? 'checked' : ''; ?> data-harga="<?php echo $item->harga; ?>">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary/10 to-background flex items-center justify-center flex-shrink-0 border border-border-subtle/20">
                                    <i class="fas fa-utensils text-primary/50"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-text-main text-sm"><?php echo $item->nama_item; ?></h3>
                                    <?php if ($item->harga > 0): ?>
                                    <p class="text-xs text-primary font-medium mt-1">+ Rp <?php echo number_format($item->harga, 0, ',', '.'); ?></p>
                                    <?php else: ?>
                                    <p class="text-xs text-green-600 font-medium mt-1">✓ Termasuk paket</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Tombol Submit -->
        <div class="max-w-7xl mx-auto mt-10 flex flex-col sm:flex-row items-center justify-between gap-4 p-5 bg-surface rounded-2xl border border-border-subtle/20 shadow-sm">
            <div>
                <p class="text-xs text-text-subtle">Total Pesanan</p>
                <p class="text-2xl font-extrabold text-primary" id="total-footer">Rp <?php echo number_format($paket->harga, 0, ',', '.'); ?></p>
            </div>
            <button type="submit" id="btn-lanjut" class="w-full sm:w-auto px-8 py-3 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-200 hover:scale-[1.02] flex items-center gap-2 shadow-md shadow-primary/20">
                <i class="fas fa-arrow-right text-sm"></i> Lanjut ke Pembayaran
            </button>
        </div>

        <?php echo form_close(); ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hargaPaket = <?php echo $paket->harga; ?>;
    const kategoriRadios = {};

    // Group radios by kategori
    document.querySelectorAll('.item-radio').forEach(function(radio) {
        const kat = radio.closest('.item-option').dataset.kategori;
        if (!kategoriRadios[kat]) kategoriRadios[kat] = [];
        kategoriRadios[kat].push(radio);
    });

    function hitungBiayaTambahan() {
        let tambahan = 0;
        document.querySelectorAll('.item-radio:checked').forEach(function(r) {
            tambahan += parseFloat(r.dataset.harga);
        });
        return tambahan;
    }

    function updateUI() {
        const tambahan = hitungBiayaTambahan();
        const total = hargaPaket + tambahan;

        document.getElementById('biaya-tambahan').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(tambahan);
        document.getElementById('total-pesanan').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        document.getElementById('total-footer').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
    }

    // Update style saat radio berubah
    document.querySelectorAll('.item-radio').forEach(function(radio) {
        radio.addEventListener('change', function() {
            const kat = this.closest('.item-option').dataset.kategori;
            // Reset semua option di kategori ini
            document.querySelectorAll('.item-option[data-kategori="' + kat + '"]').forEach(function(opt) {
                opt.classList.remove('ring-2', 'ring-accent', 'border-accent');
                opt.classList.add('border-border-subtle/30');
            });

            // Highlight yang dipilih
            const parent = this.closest('.item-option');
            parent.classList.remove('border-border-subtle/30');
            parent.classList.add('ring-2', 'ring-accent', 'border-accent');

            updateUI();
        });
    });

    // Initial UI update
    updateUI();
});
</script>

<?php $this->load->view('templates/footer_pelanggan'); ?>
