<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-12 bg-krem min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-coklat-tua mb-8">Riwayat Pesanan</h1>

        <?php if(empty($pesanan)): ?>
        <div class="bg-white rounded-2xl p-16 text-center border border-coklat-muda/20">
            <div class="w-24 h-24 bg-coklat-muda/30 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-receipt text-4xl text-coklat-tua/40"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Pesanan</h3>
            <p class="text-gray-500 mb-6">Yuk, pesan kue favoritmu sekarang!</p>
            <a href="<?php echo base_url('produk'); ?>" class="px-8 py-3 bg-coklat-tua text-white rounded-xl font-medium hover:bg-coklat transition">Lihat Produk</a>
        </div>
        <?php else: ?>
        <div class="space-y-4">
            <?php foreach($pesanan as $p): ?>
            <div class="bg-white rounded-2xl p-6 border border-coklat-muda/20">
                <div class="flex flex-wrap justify-between items-start gap-4 mb-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Kode Pesanan</p>
                        <p class="font-bold text-lg text-coklat-tua"><?php echo $p->kode_pesanan; ?></p>
                        <p class="text-sm text-gray-400 mt-1"><?php echo date('d M Y H:i', strtotime($p->created_at)); ?></p>
                    </div>
                    <div class="text-right">
                        <span class="inline-block px-4 py-1 rounded-full text-sm font-medium
                            <?php 
                            switch($p->status) {
                                case 'pending': echo 'bg-yellow-100 text-yellow-700'; break;
                                case 'diproses': echo 'bg-blue-100 text-blue-700'; break;
                                case 'dikirim': echo 'bg-purple-100 text-purple-700'; break;
                                case 'selesai': echo 'bg-green-100 text-green-700'; break;
                                case 'dibatalkan': echo 'bg-red-100 text-red-700'; break;
                            }
                            ?>">
                            <?php echo ucfirst($p->status); ?>
                        </span>
                        <p class="font-bold text-coklat-tua mt-2">Rp <?php echo number_format($p->total_harga,0,',','.'); ?></p>
                    </div>
                </div>
                <div class="border-t border-coklat-muda/30 pt-4 flex flex-wrap justify-between items-center gap-4">
                    <div class="text-sm text-gray-500">
                        <p><i class="fas fa-user mr-2"></i><?php echo $p->nama_penerima; ?></p>
                        <p><i class="fas fa-map-marker-alt mr-2"></i><?php echo $p->alamat_pengiriman; ?></p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="text-sm text-gray-500">
                            <p><i class="fas fa-credit-card mr-2"></i><?php echo $p->metode_pembayaran; ?></p>
                        </div>
                        <a href="<?php echo base_url('riwayat/detail/'.$p->id_pesanan); ?>" class="text-coklat-tua hover:text-coklat font-medium text-sm">Detail <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php $this->load->view('templates/footer_pelanggan'); ?>
