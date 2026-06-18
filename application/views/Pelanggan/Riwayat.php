<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-12 bg-krem min-h-screen relative overflow-hidden">
    <div class="absolute top-0 right-0 w-72 h-72 bg-oranye-pastel/15 blob opacity-30"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-oranye-pastel/40 text-coklat-tua rounded-full text-sm font-medium mb-3 border border-oranye/20">
                <i class="fas fa-receipt text-oranye text-xs"></i> Pesanan
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-coklat-tua mb-2">Riwayat Pesanan</h1>
            <p class="text-gray-400">Lacak dan kelola semua pesananmu</p>
        </div>

        <?php if(empty($pesanan)): ?>
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-16 text-center border border-coklat-muda/20 max-w-xl mx-auto">
            <div class="w-28 h-28 bg-gradient-to-br from-coklat-muda/30 to-coklat-muda/10 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-receipt text-4xl text-coklat-tua/30"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Pesanan</h3>
            <p class="text-gray-400 mb-8">Yuk, pesan kue favoritmu sekarang!</p>
            <a href="<?php echo base_url('produk'); ?>" class="px-8 py-3.5 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-medium hover:shadow-xl hover:shadow-coklat-tua/25 transition inline-flex items-center gap-2">
                <i class="fas fa-arrow-right text-sm"></i> Lihat Produk
            </a>
        </div>
        <?php else: ?>
        <div class="space-y-4">
            <?php foreach($pesanan as $p): ?>
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-coklat-muda/20 shadow-sm hover:shadow-md transition group">
                <div class="flex flex-wrap justify-between items-start gap-4 mb-5">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-coklat-tua to-coklat rounded-xl flex items-center justify-center text-white shadow-md shadow-coklat-tua/20 flex-shrink-0">
                            <i class="fas fa-shopping-bag text-sm"></i>
                        </div>
                        <div>
                            <p class="font-bold text-lg text-coklat-tua"><?php echo $p->kode_pesanan; ?></p>
                            <p class="text-sm text-gray-400"><?php echo date('d M Y H:i', strtotime($p->created_at)); ?></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-sm font-medium
                            <?php 
                            switch($p->status) {
                                case 'pending': echo 'bg-yellow-50 text-yellow-700 border border-yellow-200'; break;
                                case 'diproses': echo 'bg-blue-50 text-blue-700 border border-blue-200'; break;
                                case 'dikirim': echo 'bg-purple-50 text-purple-700 border border-purple-200'; break;
                                case 'selesai': echo 'bg-green-50 text-green-700 border border-green-200'; break;
                                case 'dibatalkan': echo 'bg-red-50 text-red-700 border border-red-200'; break;
                            }
                            ?>">
                            <span class="w-2 h-2 rounded-full <?php echo $p->status == 'pending' ? 'bg-yellow-500' : ($p->status == 'diproses' ? 'bg-blue-500' : ($p->status == 'dikirim' ? 'bg-purple-500' : ($p->status == 'selesai' ? 'bg-green-500' : 'bg-red-500'))); ?> animate-pulse"></span>
                            <?php echo ucfirst($p->status); ?>
                        </span>
                        <p class="font-extrabold text-coklat-tua mt-2 text-lg">Rp <?php echo number_format($p->total_harga,0,',','.'); ?></p>
                    </div>
                </div>
                <div class="border-t border-coklat-muda/30 pt-4 flex flex-wrap justify-between items-center gap-4">
                    <div class="flex items-center gap-6 text-sm text-gray-500">
                        <span class="flex items-center gap-2"><i class="fas fa-user text-coklat-muda"></i> <?php echo $p->nama_penerima; ?></span>
                        <span class="flex items-center gap-2"><i class="fas fa-map-marker-alt text-coklat-muda"></i> <?php echo $p->alamat_pengiriman; ?></span>
                        <span class="flex items-center gap-2"><i class="fas fa-credit-card text-coklat-muda"></i> <?php echo $p->metode_pembayaran; ?></span>
                    </div>
                    <a href="<?php echo base_url('riwayat/detail/'.$p->id_pesanan); ?>" class="inline-flex items-center gap-2 px-5 py-2 bg-krem text-coklat-tua rounded-xl font-medium hover:bg-coklat-tua hover:text-white transition text-sm">
                        Detail <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php $this->load->view('templates/footer_pelanggan'); ?>
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
