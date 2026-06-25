<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-12 bg-background min-h-screen relative overflow-hidden">
    <div class="absolute top-0 right-0 w-72 h-72 bg-secondary-light/15 blob opacity-30"></div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-text-muted mb-6">
            <a href="<?php echo base_url('riwayat'); ?>" class="hover:text-primary transition-colors duration-200 flex items-center gap-1"><i class="fas fa-arrow-left text-xs"></i> Riwayat</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-primary font-medium">Detail Pesanan</span>
        </div>

        <!-- Order Header -->
        <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-6 border border-border-subtle/20 shadow-sm mb-6">
            <div class="flex flex-wrap justify-between items-start gap-4 mb-4">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-primary to-primary-hover rounded-xl flex items-center justify-center text-white shadow-md shadow-primary/20">
                        <i class="fas fa-shopping-bag text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm text-text-subtle mb-1">Kode Pesanan</p>
                        <p class="font-bold text-xl text-primary"><?php echo $pesanan->kode_pesanan; ?></p>
                        <p class="text-sm text-text-subtle mt-1"><?php echo date('d M Y H:i', strtotime($pesanan->created_at)); ?></p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-sm font-medium
                        <?php
                        switch($pesanan->status) {
                            case 'pending': echo 'bg-yellow-50 text-yellow-700 border border-yellow-200'; break;
                            case 'diproses': echo 'bg-blue-50 text-blue-700 border border-blue-200'; break;
                            case 'dikirim': echo 'bg-purple-50 text-purple-700 border border-purple-200'; break;
                            case 'selesai': echo 'bg-green-50 text-green-700 border border-green-200'; break;
                            case 'dibatalkan': echo 'bg-red-50 text-red-700 border border-red-200'; break;
                        }
                        ?>">
                        <span class="w-2 h-2 rounded-full <?php echo $pesanan->status == 'pending' ? 'bg-yellow-500' : ($pesanan->status == 'diproses' ? 'bg-blue-500' : ($pesanan->status == 'dikirim' ? 'bg-purple-500' : ($pesanan->status == 'selesai' ? 'bg-green-500' : 'bg-red-500'))); ?> animate-pulse"></span>
                        <?php echo ucfirst($pesanan->status); ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-6 border border-border-subtle/20 shadow-sm mb-6">
            <h3 class="font-bold text-text-main mb-5 text-lg flex items-center gap-2 font-heading">
                <div class="w-8 h-8 bg-background rounded-lg flex items-center justify-center"><i class="fas fa-cookie-bite text-primary text-xs"></i></div>
                Item Pesanan
            </h3>
            <div class="space-y-4">
                <?php foreach($detail as $d): ?>
                <div class="flex items-center gap-4 pb-4 border-b border-border-subtle/20 last:border-0 last:pb-0">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary/10 to-background rounded-xl flex items-center justify-center flex-shrink-0 overflow-hidden">
                        <?php if($d->gambar && file_exists(FCPATH . 'assets/upload/'.$d->gambar)): ?>
                        <img src="<?php echo base_url('assets/upload/'.$d->gambar); ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                        <i class="fas fa-cookie-bite text-xl text-primary/20"></i>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-text-main"><?php echo $d->nama_produk; ?></p>
                        <p class="text-sm text-text-muted"><?php echo $d->jumlah; ?> x Rp <?php echo number_format($d->harga_satuan,0,',','.'); ?></p>
                    </div>
                    <p class="font-bold text-primary">Rp <?php echo number_format($d->subtotal,0,',','.'); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="border-t border-border-subtle/30 pt-4 mt-4 flex justify-between items-center">
                <span class="font-bold text-text-main">Total Pembayaran</span>
                <span class="font-extrabold text-2xl text-primary">Rp <?php echo number_format($pesanan->total_harga,0,',','.'); ?></span>
            </div>
        </div>

        <!-- Shipping Info -->
        <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-6 border border-border-subtle/20 shadow-sm mb-6">
            <h3 class="font-bold text-text-main mb-5 text-lg flex items-center gap-2 font-heading">
                <div class="w-8 h-8 bg-background rounded-lg flex items-center justify-center"><i class="fas fa-truck text-primary text-xs"></i></div>
                Data Pengiriman
            </h3>
            <div class="space-y-3 text-sm">
                <div class="flex items-start gap-4">
                    <span class="text-text-subtle w-28 flex-shrink-0 flex items-center gap-2"><i class="fas fa-user w-4 text-primary"></i> Nama</span>
                    <span class="font-medium text-text-main"><?php echo $pesanan->nama_penerima; ?></span>
                </div>
                <div class="flex items-start gap-4">
                    <span class="text-text-subtle w-28 flex-shrink-0 flex items-center gap-2"><i class="fas fa-phone w-4 text-primary"></i> No HP</span>
                    <span class="font-medium text-text-main"><?php echo $pesanan->no_hp_penerima; ?></span>
                </div>
                <div class="flex items-start gap-4">
                    <span class="text-text-subtle w-28 flex-shrink-0 flex items-center gap-2"><i class="fas fa-map-marker-alt w-4 text-primary"></i> Alamat</span>
                    <span class="font-medium text-text-main"><?php echo $pesanan->alamat_pengiriman; ?></span>
                </div>
                <div class="flex items-start gap-4">
                    <span class="text-text-subtle w-28 flex-shrink-0 flex items-center gap-2"><i class="fas fa-credit-card w-4 text-primary"></i> Pembayaran</span>
                    <span class="font-medium text-text-main"><?php echo ucfirst($pesanan->metode_pembayaran); ?></span>
                </div>
                <?php if($pesanan->catatan): ?>
                <div class="flex items-start gap-4">
                    <span class="text-text-subtle w-28 flex-shrink-0 flex items-center gap-2"><i class="fas fa-sticky-note w-4 text-primary"></i> Catatan</span>
                    <span class="font-medium text-text-main"><?php echo $pesanan->catatan; ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if($pesanan->status == 'pending'): ?>
        <a href="https://wa.me/<?php echo NOMOR_WA_PENJUAL; ?>?text=Halo%20NINGNONG%2C%20saya%20ingin%20konfirmasi%20pesanan%20<?php echo urlencode($pesanan->kode_pesanan); ?>" target="_blank" class="block w-full text-center px-6 py-3.5 bg-primary text-white rounded-full font-medium hover:bg-primary-hover transition-all duration-200 flex items-center justify-center gap-2 shadow-md shadow-primary/20">
            <i class="fab fa-whatsapp text-lg"></i> Konfirmasi via WhatsApp
        </a>
        <?php endif; ?>
    </div>
</section>


    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm text-text-muted mb-6">
            <a href="<?php echo base_url('riwayat'); ?>" class="hover:text-primary transition-colors duration-200">Riwayat</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-primary font-medium">Detail Pesanan</span>
        </div>

        <div class="bg-surface rounded-2xl p-6 border border-border-subtle/20 mb-6">
            <div class="flex flex-wrap justify-between items-start gap-4 mb-4">
                <div>
                    <p class="text-sm text-text-subtle mb-1">Kode Pesanan</p>
                    <p class="font-bold text-xl text-primary"><?php echo $pesanan->kode_pesanan; ?></p>
                    <p class="text-sm text-text-subtle mt-1"><?php echo date('d M Y H:i', strtotime($pesanan->created_at)); ?></p>
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

        <div class="bg-surface rounded-2xl p-6 border border-border-subtle/20 mb-6">
            <h3 class="font-bold text-primary mb-4 font-heading">Item Pesanan</h3>
            <div class="space-y-4">
                <?php foreach($detail as $d): ?>
                <div class="flex items-center gap-4 pb-4 border-b border-border-subtle/20 last:border-0">
                    <div class="w-16 h-16 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0 overflow-hidden">
                        <?php if($d->gambar && file_exists(FCPATH . 'assets/upload/'.$d->gambar)): ?>
                        <img src="<?php echo base_url('assets/upload/'.$d->gambar); ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                        <i class="fas fa-cookie-bite text-xl text-primary/30"></i>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-primary"><?php echo $d->nama_produk; ?></p>
                        <p class="text-sm text-text-muted"><?php echo $d->jumlah; ?> x Rp <?php echo number_format($d->harga_satuan,0,',','.'); ?></p>
                    </div>
                    <p class="font-bold text-primary">Rp <?php echo number_format($d->subtotal,0,',','.'); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="border-t border-border-subtle/30 pt-4 mt-4 flex justify-between items-center">
                <span class="font-bold text-primary">Total</span>
                <span class="font-bold text-xl text-primary">Rp <?php echo number_format($pesanan->total_harga,0,',','.'); ?></span>
            </div>
        </div>

        <div class="bg-surface rounded-2xl p-6 border border-border-subtle/20 mb-6">
            <h3 class="font-bold text-primary mb-4 font-heading">Data Pengiriman</h3>
            <div class="space-y-2 text-sm">
                <p><span class="text-text-subtle w-24 inline-block">Nama</span> <?php echo $pesanan->nama_penerima; ?></p>
                <p><span class="text-text-subtle w-24 inline-block">No HP</span> <?php echo $pesanan->no_hp_penerima; ?></p>
                <p><span class="text-text-subtle w-24 inline-block">Alamat</span> <?php echo $pesanan->alamat_pengiriman; ?></p>
                <p><span class="text-text-subtle w-24 inline-block">Pembayaran</span> <?php echo ucfirst($pesanan->metode_pembayaran); ?></p>
                <?php if($pesanan->catatan): ?>
                <p><span class="text-text-subtle w-24 inline-block">Catatan</span> <?php echo $pesanan->catatan; ?></p>
                <?php endif; ?>
            </div>
        </div>

        <?php if($pesanan->status == 'pending'): ?>
        <a href="https://wa.me/<?php echo NOMOR_WA_PENJUAL; ?>?text=Halo%20NINGNONG%2C%20saya%20ingin%20konfirmasi%20pesanan%20<?php echo urlencode($pesanan->kode_pesanan); ?>" target="_blank" class="block w-full text-center px-6 py-3 bg-primary text-white rounded-full font-medium hover:bg-primary-hover transition-all duration-200 flex items-center justify-center gap-2 shadow-md shadow-primary/20">
            <i class="fab fa-whatsapp mr-2"></i>Konfirmasi via WhatsApp
        </a>
        <?php endif; ?>
    </div>
</section>

<?php $this->load->view('templates/footer_pelanggan'); ?>
