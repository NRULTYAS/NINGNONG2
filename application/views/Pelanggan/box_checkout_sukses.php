<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-20 bg-krem min-h-screen relative overflow-hidden">
    <div class="absolute top-10 right-0 w-72 h-72 bg-green-100/30 blob opacity-30"></div>
    <div class="absolute bottom-10 left-0 w-72 h-72 bg-coklat-muda/15 blob opacity-30"></div>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center mx-auto mb-5 shadow-lg shadow-green-500/30">
                <i class="fas fa-check-circle text-4xl text-white"></i>
            </div>
            <h1 class="text-3xl font-extrabold text-coklat-tua mb-2">Pesanan Berhasil Dibuat!</h1>
            <p class="text-gray-500">Terima kasih, pesanan Anda telah tercatat di sistem kami.</p>
        </div>

        <?php if ($this->session->flashdata('success_box')): ?>
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm flex items-center gap-2">
            <i class="fas fa-check-circle"></i> <?php echo $this->session->flashdata('success_box'); ?>
        </div>
        <?php endif; ?>

        <!-- Ringkasan Pesanan -->
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-6 md:p-8 border border-coklat-muda/20 shadow-lg shadow-coklat-muda/10 mb-6">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 bg-gradient-to-br from-oranye to-kuning rounded-xl flex items-center justify-center text-white shadow-md">
                    <i class="fas fa-receipt text-sm"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Detail Pesanan</h3>
                    <p class="text-xs text-gray-400">Kode: <?php echo $pesanan->kode_pesanan; ?></p>
                </div>
            </div>

            <div class="bg-krem/40 rounded-xl p-4 mb-4 border border-coklat-muda/20 grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-gray-500 mb-1">Nama Penerima</p>
                    <p class="font-semibold text-gray-800"><?php echo $pesanan->nama_penerima; ?></p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">No. Telepon</p>
                    <p class="font-semibold text-gray-800"><?php echo $pesanan->no_hp_penerima; ?></p>
                </div>
                <div class="col-span-2">
                    <p class="text-xs text-gray-500 mb-1">Alamat</p>
                    <p class="font-semibold text-gray-800"><?php echo $pesanan->alamat_pengiriman; ?></p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Tanggal Kirim</p>
                    <p class="font-semibold text-gray-800"><?php echo date('d/m/Y', strtotime($pesanan->tanggal_kirim)); ?></p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Status</p>
                    <span class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">
                        <?php echo ucfirst($pesanan->status); ?>
                    </span>
                </div>
            </div>

            <!-- Produk -->
            <div class="space-y-2 mb-4">
                <?php if (is_array($detail) && isset($detail['items']) && is_array($detail['items'])): ?>
                <?php foreach ($detail['items'] as $item): ?>
                <div class="flex justify-between text-sm items-center pb-2 border-b border-coklat-muda/10 last:border-0">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-krem rounded-lg flex items-center justify-center">
                            <i class="fas fa-cookie-bite text-coklat-tua/30 text-xs"></i>
                        </div>
                        <span class="text-gray-600"><?php echo is_array($item) ? $item['nama_produk'] : $item->nama_produk; ?></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-400">x<?php echo is_array($item) ? $item['quantity'] : $item->jumlah; ?></span>
                        <span class="font-medium text-gray-700">Rp <?php echo number_format(is_array($item) ? $item['subtotal'] : $item->subtotal, 0, ',', '.'); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="border-t border-coklat-muda/30 pt-4">
                <div class="flex justify-between items-center">
                    <span class="font-bold text-lg text-gray-800">Total Pembayaran</span>
                    <span class="font-extrabold text-2xl text-coklat-tua">Rp <?php echo number_format($pesanan->total_harga, 0, ',', '.'); ?></span>
                </div>
            </div>
        </div>

        <!-- Informasi Penting -->
        <div class="bg-blue-50/80 backdrop-blur-sm rounded-3xl p-6 border border-blue-200/40 shadow-sm mb-6">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center text-white flex-shrink-0 shadow-md">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-blue-800 mb-2">Informasi Penting</h4>
                    <ul class="text-sm text-blue-700 space-y-1.5 list-disc list-inside">
                        <li>Silakan tunggu konfirmasi dari admin untuk verifikasi pesanan.</li>
                        <li>Jika sudah melakukan transfer, pastikan sudah upload bukti pembayaran.</li>
                        <li>Pesanan akan diproses setelah pembayaran terkonfirmasi.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="<?php echo base_url('riwayat'); ?>" class="px-8 py-3 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-semibold shadow-lg shadow-coklat-tua/25 hover:shadow-xl hover:shadow-coklat-tua/30 hover:scale-[1.02] transition-all flex items-center gap-2">
                <i class="fas fa-history"></i> Lihat Riwayat Pesanan
            </a>
            <a href="<?php echo base_url('home'); ?>" class="px-8 py-3 border border-coklat-muda/40 text-gray-600 rounded-xl font-medium hover:bg-krem/50 hover:border-coklat-muda transition flex items-center gap-2">
                <i class="fas fa-home"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

<?php $this->load->view('templates/footer_pelanggan'); ?>