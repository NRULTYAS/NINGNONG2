<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-12 bg-krem min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
            <a href="<?php echo base_url('riwayat'); ?>" class="hover:text-coklat-tua">Riwayat</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-coklat-tua">Detail Pesanan</span>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-coklat-muda/20 mb-6">
            <div class="flex flex-wrap justify-between items-start gap-4 mb-4">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Kode Pesanan</p>
                    <p class="font-bold text-xl text-coklat-tua"><?php echo $pesanan->kode_pesanan; ?></p>
                    <p class="text-sm text-gray-400 mt-1"><?php echo date('d M Y H:i', strtotime($pesanan->created_at)); ?></p>
                </div>
                <div class="text-right">
                    <span class="inline-block px-4 py-1 rounded-full text-sm font-medium
                        <?php 
                        switch($pesanan->status) {
                            case 'pending': echo 'bg-yellow-100 text-yellow-700'; break;
                            case 'diproses': echo 'bg-blue-100 text-blue-700'; break;
                            case 'dikirim': echo 'bg-purple-100 text-purple-700'; break;
                            case 'selesai': echo 'bg-green-100 text-green-700'; break;
                            case 'dibatalkan': echo 'bg-red-100 text-red-700'; break;
                        }
                        ?>">
                        <?php echo ucfirst($pesanan->status); ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-coklat-muda/20 mb-6">
            <h3 class="font-bold text-coklat-tua mb-4">Item Pesanan</h3>
            <div class="space-y-4">
                <?php foreach($detail as $d): ?>
                <div class="flex items-center gap-4 pb-4 border-b border-coklat-muda/20 last:border-0">
                    <div class="w-16 h-16 bg-coklat-muda/20 rounded-xl flex items-center justify-center flex-shrink-0 overflow-hidden">
                        <?php if($d->gambar && file_exists(FCPATH . 'assets/upload/'.$d->gambar)): ?>
                        <img src="<?php echo base_url('assets/upload/'.$d->gambar); ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                        <i class="fas fa-cookie-bite text-xl text-coklat-tua/30"></i>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-coklat-tua"><?php echo $d->nama_produk; ?></p>
                        <p class="text-sm text-gray-500"><?php echo $d->jumlah; ?> x Rp <?php echo number_format($d->harga_satuan,0,',','.'); ?></p>
                    </div>
                    <p class="font-bold text-coklat-tua">Rp <?php echo number_format($d->subtotal,0,',','.'); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="border-t border-coklat-muda/30 pt-4 mt-4 flex justify-between items-center">
                <span class="font-bold text-coklat-tua">Total</span>
                <span class="font-bold text-xl text-coklat-tua">Rp <?php echo number_format($pesanan->total_harga,0,',','.'); ?></span>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-coklat-muda/20 mb-6">
            <h3 class="font-bold text-coklat-tua mb-4">Data Pengiriman</h3>
            <div class="space-y-2 text-sm">
                <p><span class="text-gray-500 w-24 inline-block">Nama</span> <?php echo $pesanan->nama_penerima; ?></p>
                <p><span class="text-gray-500 w-24 inline-block">No HP</span> <?php echo $pesanan->no_hp_penerima; ?></p>
                <p><span class="text-gray-500 w-24 inline-block">Alamat</span> <?php echo $pesanan->alamat_pengiriman; ?></p>
                <p><span class="text-gray-500 w-24 inline-block">Pembayaran</span> <?php echo ucfirst($pesanan->metode_pembayaran); ?></p>
                <?php if($pesanan->catatan): ?>
                <p><span class="text-gray-500 w-24 inline-block">Catatan</span> <?php echo $pesanan->catatan; ?></p>
                <?php endif; ?>
            </div>
        </div>

        <?php if($pesanan->status == 'pending'): ?>
        <a href="https://wa.me/<?php echo NOMOR_WA_PENJUAL; ?>?text=Halo%20NINGNONG%2C%20saya%20ingin%20konfirmasi%20pesanan%20<?php echo urlencode($pesanan->kode_pesanan); ?>" target="_blank" class="block w-full text-center px-6 py-3 bg-green-600 text-white rounded-xl font-medium hover:bg-green-700 transition">
            <i class="fab fa-whatsapp mr-2"></i>Konfirmasi via WhatsApp
        </a>
        <?php endif; ?>
    </div>
</section>

<?php $this->load->view('templates/footer_pelanggan'); ?>
