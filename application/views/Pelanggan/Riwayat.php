<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-12 bg-background min-h-screen relative overflow-hidden">
    <div class="absolute top-0 right-0 w-72 h-72 bg-secondary-light/15 blob opacity-30"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-secondary-light/40 text-primary rounded-full text-sm font-medium mb-3 border border-secondary/20">
                <i class="fas fa-receipt text-accent text-xs"></i> Pesanan
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-text-main mb-2 font-heading">Riwayat Pesanan</h1>
            <p class="text-text-muted">Lacak dan kelola semua pesananmu</p>
        </div>

        <?php if(empty($pesanan)): ?>
        <div class="bg-surface/80 backdrop-blur-sm rounded-3xl p-16 text-center border border-border-subtle/20 max-w-xl mx-auto">
            <div class="w-28 h-28 bg-gradient-to-br from-primary/10 to-secondary-light/30 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-receipt text-4xl text-primary/30"></i>
            </div>
            <h3 class="text-xl font-semibold text-text-main mb-2">Belum Ada Pesanan</h3>
            <p class="text-text-muted mb-8">Yuk, pesan kue favoritmu sekarang!</p>
            <a href="<?php echo base_url('produk'); ?>" class="px-8 py-3.5 bg-primary text-white rounded-full font-medium hover:bg-primary-hover transition-all duration-200 inline-flex items-center gap-2 shadow-md shadow-primary/20">
                <i class="fas fa-arrow-right text-sm"></i> Lihat Produk
            </a>
        </div>
        <?php else: ?>
        <div class="space-y-4">
            <?php foreach($pesanan as $p): ?>
            <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-6 border border-border-subtle/20 shadow-sm hover:shadow-md transition-all duration-200 group">
                <div class="flex flex-wrap justify-between items-start gap-4 mb-5">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary to-primary-hover rounded-xl flex items-center justify-center text-white shadow-md shadow-primary/20 flex-shrink-0">
                            <i class="fas fa-shopping-bag text-sm"></i>
                        </div>
                        <div>
                            <p class="font-bold text-lg text-primary"><?php echo $p->kode_pesanan; ?></p>
                            <p class="text-sm text-text-muted"><?php echo date('d M Y H:i', strtotime($p->created_at)); ?></p>
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
                        <p class="font-extrabold text-primary mt-2 text-lg">Rp <?php echo number_format($p->total_harga,0,',','.'); ?></p>
                    </div>
                </div>
                <div class="border-t border-border-subtle/30 pt-4 flex flex-wrap justify-between items-center gap-4">
                    <div class="flex items-center gap-6 text-sm text-text-muted">
                        <span class="flex items-center gap-2"><i class="fas fa-user text-primary"></i> <?php echo $p->nama_penerima; ?></span>
                        <span class="flex items-center gap-2"><i class="fas fa-map-marker-alt text-primary"></i> <?php echo $p->alamat_pengiriman; ?></span>
                        <span class="flex items-center gap-2"><i class="fas fa-credit-card text-primary"></i> <?php echo $p->metode_pembayaran; ?></span>
                    </div>
                    <a href="<?php echo base_url('riwayat/detail/'.$p->id_pesanan); ?>" class="inline-flex items-center gap-2 px-5 py-2 bg-background text-primary rounded-xl font-medium hover:bg-primary hover:text-white transition-all duration-200 text-sm">
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
