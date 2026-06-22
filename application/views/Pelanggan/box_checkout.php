<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-12 bg-krem min-h-screen relative overflow-hidden">
    <div class="absolute top-10 right-0 w-72 h-72 bg-oranye-pastel/15 blob opacity-30"></div>
    <div class="absolute bottom-10 left-0 w-72 h-72 bg-coklat-muda/15 blob opacity-30"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-8">
            <a href="<?php echo base_url('home'); ?>" class="hover:text-coklat-tua transition">Beranda</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="<?php echo base_url('pesanan/pilih_jenis'); ?>" class="hover:text-coklat-tua transition">Pesan Sekarang</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="<?php echo base_url('pesanan/snack_box_builder'); ?>" class="hover:text-coklat-tua transition">SNACK BOX</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-coklat-tua font-medium">Checkout</span>
        </div>

        <?php if ($this->session->flashdata('error')): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-5 text-sm flex items-center gap-2">
            <i class="fas fa-exclamation-circle"></i> <?php echo $this->session->flashdata('error'); ?>
        </div>
        <?php endif; ?>

        <?php echo validation_errors('<div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-5 text-sm flex items-center gap-2"><i class="fas fa-exclamation-circle"></i>', '</div>'); ?>

        <?php echo form_open('box_checkout/proses', ['class' => 'contents', 'enctype' => 'multipart/form-data']); ?>
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Form Pemesanan -->
            <div class="lg:col-span-2 space-y-6">
                    <!-- Informasi Pengiriman -->
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-coklat-muda/20 shadow-sm">
                        <h3 class="font-bold text-gray-800 mb-5 text-lg flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-coklat-tua to-coklat rounded-xl flex items-center justify-center text-white shadow-md shadow-coklat-tua/20">
                                <i class="fas fa-truck text-sm"></i>
                            </div>
                            Informasi Pengiriman
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Penerima <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    <input type="text" name="nama_penerima" value="<?php echo set_value('nama_penerima', $user->nama); ?>" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <i class="fas fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    <input type="text" name="no_hp" value="<?php echo set_value('no_hp', $user->no_hp); ?>" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <textarea name="alamat" required rows="3" class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition"><?php echo set_value('alamat', $user->alamat); ?></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengiriman <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-calendar-alt absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="date" name="tanggal_kirim" value="<?php echo set_value('tanggal_kirim'); ?>" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition" min="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Minimal hari ini (<?php echo date('d/m/Y'); ?>)</p>
                        </div>
                    </div>

                    <!-- Pembayaran QRIS -->
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-coklat-muda/20 shadow-sm">
                        <h3 class="font-bold text-gray-800 mb-5 text-lg flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center text-white shadow-md shadow-green-500/20">
                                <i class="fas fa-qrcode text-sm"></i>
                            </div>
                            Pembayaran QRIS
                        </h3>
                        <div class="flex flex-col md:flex-row items-start gap-6">
                            <div class="bg-white p-4 rounded-2xl border border-coklat-muda/20 shadow-sm">
                                <img src="<?php echo base_url('assets/img/qris.png'); ?>" alt="QRIS NINGNONG Kue Basah" class="w-48 h-48 object-contain" onerror="this.outerHTML='<div class=\'w-48 h-48 bg-krem rounded-2xl flex items-center justify-center text-gray-400\'><i class=\'fas fa-qrcode text-6xl opacity-50\'></i><p class=\'text-xs mt-2\'></p></div>'">
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 mb-2">Scan QRIS untuk membayar</p>
                                <p class="text-sm text-gray-500 mb-3">Gunakan aplikasi GoPay, OVO, DANA, atau M-Banking untuk scan QR code di samping.</p>
                                <div class="bg-krem/60 rounded-xl p-4 border border-coklat-muda/20">
                                    <p class="text-xs text-gray-500 mb-1">Total Pembayaran:</p>
                                    <p class="font-extrabold text-2xl text-coklat-tua">Rp <?php echo number_format($total_box, 0, ',', '.'); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Bukti Pembayaran <span class="text-gray-400 text-xs">(opsional)</span></label>
                            <div class="relative">
                                <input type="file" name="bukti_pembayaran" accept="image/*" class="w-full px-4 py-3 rounded-xl border border-dashed border-coklat-muda/40 focus:outline-none focus:border-coklat-tua bg-krem/20 hover:bg-krem/40 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-coklat-tua file:text-white file:cursor-pointer">
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, WEBP (maks. 2MB). Upload setelah transfer.</p>
                        </div>
                    </div>

                    <!-- Catatan -->
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-coklat-muda/20 shadow-sm">
                        <h3 class="font-bold text-gray-800 mb-5 text-lg flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-violet-500 rounded-xl flex items-center justify-center text-white shadow-md shadow-purple-500/20">
                                <i class="fas fa-sticky-note text-sm"></i>
                            </div>
                            Catatan Tambahan
                        </h3>
                        <textarea name="catatan" rows="2" class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition" placeholder="Catatan untuk pesanan (opsional)"><?php echo set_value('catatan'); ?></textarea>
                    </div>
            </div>

            <!-- Sidebar Ringkasan -->
            <div class="lg:col-span-1">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-coklat-muda/20 sticky top-24 shadow-sm">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 bg-gradient-to-br from-oranye to-kuning rounded-xl flex items-center justify-center text-white shadow-md shadow-oranye/20">
                            <i class="fas fa-receipt text-sm"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">Ringkasan Pesanan</h3>
                            <p class="text-xs text-gray-400"><?php echo count($items); ?> produk dalam box</p>
                        </div>
                    </div>

                    <!-- Kode Pesanan -->
                    <div class="bg-krem/40 rounded-xl p-3 mb-4 border border-coklat-muda/20">
                        <p class="text-xs text-gray-500 mb-1">Kode Pesanan</p>
                        <p class="font-bold text-coklat-tua"><?php echo $kode_pesanan; ?></p>
                    </div>

                    <!-- Harga per Dus & Jumlah Dus -->
                    <div class="bg-krem/40 rounded-xl p-3 mb-4 border border-coklat-muda/20 space-y-3">
                        <input type="hidden" name="harga_per_dus" id="harga-per-dus" value="<?php echo $harga_per_dus ?? $total_box; ?>">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Harga per Dus</span>
                            <span class="font-semibold text-coklat-tua">Rp <?php echo number_format($harga_per_dus ?? $total_box, 0, ',', '.'); ?></span>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Jumlah Dus <span class="text-red-500">*</span></label>
                            <input type="number" id="jumlah-dus" name="jumlah_dus" min="15" value="15" class="w-full px-4 py-2.5 border border-coklat-muda/30 rounded-xl focus:ring-2 focus:ring-coklat-tua/20 focus:border-coklat-tua outline-none transition text-center font-semibold" required>
                            <p id="error-jumlah-dus" class="text-xs text-red-500 mt-1 hidden">Minimal pemesanan adalah 15 dus.</p>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Total Dus</span>
                            <span class="font-bold text-gray-800" id="total-dus">15</span>
                        </div>
                    </div>

                    <div class="space-y-3 mb-5 max-h-60 overflow-y-auto pr-1">
                        <?php foreach ($items as $item): ?>
                        <div class="flex justify-between text-sm items-center pb-3 border-b border-coklat-muda/10 last:border-0">
                            <div class="flex items-center gap-2 min-w-0">
                                <div class="w-8 h-8 bg-krem rounded-lg flex items-center justify-center flex-shrink-0">
                                    <?php if ($item['gambar'] && file_exists(FCPATH . 'assets/upload/' . $item['gambar'])): ?>
                                    <img src="<?php echo base_url('assets/upload/' . $item['gambar']); ?>" class="w-full h-full object-cover rounded-lg">
                                    <?php else: ?>
                                    <i class="fas fa-cookie-bite text-coklat-tua/40 text-xs"></i>
                                    <?php endif; ?>
                                </div>
                                <span class="text-gray-600 truncate max-w-[100px]"><?php echo $item['nama_produk']; ?></span>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="text-xs text-gray-400">x<?php echo $item['quantity']; ?></span>
                                <span class="font-medium text-gray-700 text-xs">Rp <?php echo number_format($item['subtotal'], 0, ',', '.'); ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="border-t border-coklat-muda/30 pt-4 mb-2">
                        <div class="flex justify-between text-sm text-gray-500 mb-2">
                            <span>Harga per Dus</span>
                            <span>Rp <?php echo number_format($total_box, 0, ',', '.'); ?></span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-500 mb-2">
                            <span>Jumlah Dus</span>
                            <span class="font-semibold text-gray-800" id="total-dus-footer">15</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-500 mb-4">
                            <span>Ongkir</span>
                            <span class="text-green-600 font-medium">Gratis</span>
                        </div>
                    </div>
                    <div class="border-t border-coklat-muda/30 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-lg text-gray-800">Total Pembayaran</span>
                            <span class="font-extrabold text-2xl text-coklat-tua" id="total-pembayaran">Rp <?php echo number_format($total_box * 15, 0, ',', '.'); ?></span>
                        </div>
                    </div>
                    <button type="submit" class="block w-full py-3.5 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-medium hover:shadow-xl hover:shadow-coklat-tua/25 transition text-center flex items-center justify-center gap-2">
                        <i class="fas fa-check-circle text-sm"></i> Konfirmasi Pesanan
                    </button>
                    <a href="<?php echo base_url('pesanan/snack_box_builder'); ?>" class="block w-full py-3 text-coklat-tua rounded-xl font-medium hover:bg-krem/80 transition text-center mt-2 text-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Box Builder
                    </a>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hargaPerDus = <?php echo $harga_per_dus ?? $total_box; ?>;
    const inputJumlah = document.getElementById('jumlah-dus');
    const totalDusEl = document.getElementById('total-dus');
    const totalDusFooter = document.getElementById('total-dus-footer');
    const totalPembayaranEl = document.getElementById('total-pembayaran');
    const errorEl = document.getElementById('error-jumlah-dus');
    const btnSubmit = document.querySelector('button[type="submit"]');

    function updateTotal() {
        const jumlah = parseInt(inputJumlah.value) || 0;
        const total = hargaPerDus * jumlah;

        totalDusEl.textContent = jumlah;
        totalDusFooter.textContent = jumlah;
        totalPembayaranEl.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);

        if (jumlah < 15) {
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