<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-12 bg-krem min-h-screen relative overflow-hidden">
    <div class="absolute top-10 right-0 w-72 h-72 bg-oranye-pastel/15 blob opacity-30"></div>
    <div class="absolute bottom-10 left-0 w-72 h-72 bg-coklat-muda/15 blob opacity-30"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-8">
            <a href="<?php echo base_url('home'); ?>" class="hover:text-coklat-tua transition">Beranda</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="<?php echo base_url('catering'); ?>" class="hover:text-coklat-tua transition">Catering</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-coklat-tua font-medium">Checkout Catering</span>
        </div>

        <!-- Header -->
        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-oranye-pastel/40 text-coklat-tua rounded-full text-sm font-medium mb-3 border border-oranye/20">
                <i class="fas fa-shopping-cart text-oranye text-xs"></i> Checkout Catering
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-coklat-tua mb-2">Lengkapi Data Pengiriman</h1>
            <p class="text-gray-500 max-w-xl mx-auto">Isi data diri dan detail pengiriman untuk pesanan catering Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            <?php echo form_open('catering_checkout/proses', ['class' => 'contents']); ?>

            <!-- Ringkasan Pesanan -->
            <div class="lg:col-span-2 order-2 lg:order-1">
                <div class="bg-white rounded-2xl border border-coklat-muda/20 shadow-sm p-5 sticky top-24">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-clipboard-list text-coklat"></i>
                        Ringkasan Pesanan
                    </h3>
                    <?php $harga_per_box = $catering_order['harga_per_box']; ?>
                    <?php $default_jumlah = 25; ?>

                    <div class="p-4 bg-krem rounded-xl mb-4">
                        <p class="font-bold text-gray-800"><?php echo $catering_order['nama_paket']; ?></p>
                        <p class="text-sm text-gray-500 mt-1">Harga Paket: <span class="font-semibold text-coklat-tua">Rp <?php echo number_format($catering_order['harga_paket'], 0, ',', '.'); ?></span></p>
                        <p class="text-sm text-gray-500">Biaya Tambahan: <span class="font-semibold text-coklat-tua">Rp <?php echo number_format($catering_order['total_tambahan'], 0, ',', '.'); ?></span></p>
                        <p class="text-sm text-gray-500 mt-1">Harga Per Box: <span class="font-semibold text-coklat-tua">Rp <?php echo number_format($harga_per_box, 0, ',', '.'); ?></span></p>
                    </div>

                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Kustomisasi Menu:</p>
                    <div class="space-y-2 mb-4">
                        <?php 
                        $kat_sekarang = '';
                        foreach ($catering_order['items'] as $item): 
                            if ($item['kategori'] != $kat_sekarang):
                                $kat_sekarang = $item['kategori'];
                        ?>
                        <div class="pt-2 first:pt-0">
                            <p class="text-xs font-semibold text-coklat uppercase"><?php echo $item['kategori']; ?></p>
                        </div>
                        <?php endif; ?>
                        <div class="flex items-center justify-between text-sm pl-3">
                            <span class="text-gray-700">• <?php echo $item['nama_item']; ?></span>
                            <?php if ($item['harga'] > 0): ?>
                            <span class="text-xs text-coklat">+Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></span>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="border-t border-coklat-muda/20 pt-4 mt-4 space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Harga Per Box</span>
                            <span class="font-semibold text-coklat-tua">Rp <?php echo number_format($harga_per_box, 0, ',', '.'); ?></span>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Jumlah Box <span class="text-red-500">*</span></label>
                            <input type="number" id="jumlah-box" name="jumlah_box" min="25" value="<?php echo $default_jumlah; ?>" class="w-full px-4 py-2.5 border border-coklat-muda/30 rounded-xl focus:ring-2 focus:ring-coklat-tua/20 focus:border-coklat-tua outline-none transition text-center font-semibold" required>
                            <p id="error-jumlah-box" class="text-xs text-red-500 mt-1 hidden">Minimal pemesanan catering adalah 25 box.</p>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Total Box</span>
                            <span class="font-bold text-gray-800" id="total-box"><?php echo $default_jumlah; ?></span>
                        </div>
                        <div class="flex justify-between items-center pt-2 border-t border-coklat-muda/20">
                            <span class="text-sm font-semibold text-gray-700">Total Pembayaran</span>
                            <span class="font-extrabold text-xl text-coklat-tua" id="total-pembayaran">Rp <?php echo number_format($harga_per_box * $default_jumlah, 0, ',', '.'); ?></span>
                        </div>
                    </div>

                    <input type="hidden" name="harga_per_box" id="harga-per-box" value="<?php echo $harga_per_box; ?>">
                    <input type="hidden" name="total_harga" id="total-harga-hidden" value="<?php echo $harga_per_box * $default_jumlah; ?>">
                </div>
            </div>

            <!-- Form Checkout -->
            <div class="lg:col-span-3 order-1 lg:order-2">
                <!-- Data Penerima -->
                <div class="bg-white rounded-2xl border border-coklat-muda/20 shadow-sm p-5">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-user text-coklat"></i>
                        Data Penerima
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_penerima" value="<?php echo set_value('nama_penerima', $user->nama ?? ''); ?>" class="w-full px-4 py-2.5 border border-coklat-muda/30 rounded-xl focus:ring-2 focus:ring-coklat-tua/20 focus:border-coklat-tua outline-none transition" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. HP <span class="text-red-500">*</span></label>
                            <input type="tel" name="no_hp" value="<?php echo set_value('no_hp', $user->no_hp ?? ''); ?>" class="w-full px-4 py-2.5 border border-coklat-muda/30 rounded-xl focus:ring-2 focus:ring-coklat-tua/20 focus:border-coklat-tua outline-none transition" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Pengiriman <span class="text-red-500">*</span></label>
                            <textarea name="alamat" rows="3" class="w-full px-4 py-2.5 border border-coklat-muda/30 rounded-xl focus:ring-2 focus:ring-coklat-tua/20 focus:border-coklat-tua outline-none transition resize-none" required><?php echo set_value('alamat', $user->alamat ?? ''); ?></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kirim <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_kirim" class="w-full px-4 py-2.5 border border-coklat-muda/30 rounded-xl focus:ring-2 focus:ring-coklat-tua/20 focus:border-coklat-tua outline-none transition" required>
                        </div>
                    </div>
                </div>

                <!-- Pembayaran -->
                <div class="bg-white rounded-2xl border border-coklat-muda/20 shadow-sm p-5">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-credit-card text-coklat"></i>
                        Metode Pembayaran
                    </h3>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 p-3 border border-coklat-muda/30 rounded-xl cursor-pointer hover:bg-krem/50 transition">
                            <input type="radio" name="metode_pembayaran" value="transfer" class="accent-coklat-tua" checked>
                            <div>
                                <p class="font-medium text-gray-800 text-sm">Transfer Bank</p>
                                <p class="text-xs text-gray-400">BCA / Mandiri / BRI / BNI</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-3 border border-coklat-muda/30 rounded-xl cursor-pointer hover:bg-krem/50 transition">
                            <input type="radio" name="metode_pembayaran" value="qris" class="accent-coklat-tua">
                            <div>
                                <p class="font-medium text-gray-800 text-sm">QRIS</p>
                                <p class="text-xs text-gray-400">Scan QR via GoPay, OVO, Dana, dsb.</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Catatan -->
                <div class="bg-white rounded-2xl border border-coklat-muda/20 shadow-sm p-5">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-sticky-note text-coklat"></i>
                        Catatan (Opsional)
                    </h3>
                    <textarea name="catatan" rows="2" placeholder="Contoh: Tolong tambah sambal terpisah..." class="w-full px-4 py-2.5 border border-coklat-muda/30 rounded-xl focus:ring-2 focus:ring-coklat-tua/20 focus:border-coklat-tua outline-none transition resize-none"><?php echo set_value('catatan'); ?></textarea>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-semibold text-base hover:shadow-lg hover:shadow-coklat-tua/25 transition-all hover:scale-[1.01] flex items-center justify-center gap-2">
                    <i class="fas fa-paper-plane"></i>
                    Buat Pesanan Catering
                </button>

            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hargaPerBox = <?php echo $harga_per_box; ?>;
    const inputJumlah = document.getElementById('jumlah-box');
    const totalBoxEl = document.getElementById('total-box');
    const totalPembayaranEl = document.getElementById('total-pembayaran');
    const totalHidden = document.getElementById('total-harga-hidden');
    const errorEl = document.getElementById('error-jumlah-box');
    const btnSubmit = document.querySelector('button[type="submit"]');

    function updateTotal() {
        const jumlah = parseInt(inputJumlah.value) || 0;
        const total = hargaPerBox * jumlah;

        totalBoxEl.textContent = jumlah;
        totalPembayaranEl.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        totalHidden.value = total;

        if (jumlah < 25) {
            errorEl.classList.remove('hidden');
            inputJumlah.classList.add('border-red-400');
            btnSubmit.disabled = true;
            btnSubmit.classList.add('opacity-50', 'cursor-not-allowed');
        } else {
            errorEl.classList.add('hidden');
            inputJumlah.classList.remove('border-red-400');
            btnSubmit.disabled = false;
            btnSubmit.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    }

    if (inputJumlah) {
        inputJumlah.addEventListener('input', updateTotal);
        updateTotal();
    }
});
</script>

<?php $this->load->view('templates/footer_pelanggan'); ?>