<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-12 bg-background min-h-screen relative overflow-hidden">
    <div class="absolute top-0 right-0 w-72 h-72 bg-secondary-light/15 blob opacity-30"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-secondary-light/40 text-primary rounded-full text-sm font-medium mb-3 border border-secondary/20">
                <i class="fas fa-shopping-bag text-accent text-xs"></i> Keranjang
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-text-main mb-2 font-heading">Keranjang Belanja</h1>
            <p class="text-text-muted">Kelola item pilihanmu sebelum checkout</p>
        </div>

        <?php if(empty($keranjang)): ?>
        <div class="bg-surface/80 backdrop-blur-sm rounded-3xl p-16 text-center border border-border-subtle/20 max-w-xl mx-auto">
            <div class="w-28 h-28 bg-gradient-to-br from-primary/10 to-secondary-light/30 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-shopping-bag text-4xl text-primary/30"></i>
            </div>
            <h3 class="text-xl font-semibold text-text-main mb-2">Keranjang Kosong</h3>
            <p class="text-text-muted mb-8">Yuk, tambahkan kue favoritmu!</p>
            <a href="<?php echo base_url('produk'); ?>" class="px-8 py-3.5 bg-primary text-white rounded-full font-medium hover:bg-primary-hover transition-all duration-200 inline-flex items-center gap-2 shadow-md shadow-primary/20">
                <i class="fas fa-arrow-right text-sm"></i> Lihat Produk
            </a>
        </div>
        <?php else: ?>
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-4">
                <?php foreach($keranjang as $k): ?>
                <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-6 flex gap-5 items-center border border-border-subtle/20 shadow-sm hover:shadow-md transition-all duration-200 group">
                    <div class="w-24 h-24 bg-gradient-to-br from-primary/10 to-background rounded-xl flex items-center justify-center flex-shrink-0 overflow-hidden">
                        <?php if($k->gambar && file_exists(FCPATH . 'assets/upload/'.$k->gambar)): ?>
                        <img src="<?php echo base_url('assets/upload/'.$k->gambar); ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <?php else: ?>
                        <i class="fas fa-cookie-bite text-3xl text-primary/20"></i>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-text-main truncate"><?php echo $k->nama_produk; ?></h3>
                        <p class="text-sm text-text-muted"><?php echo $k->nama_kategori; ?> &bull; Rasa <?php echo $k->rasa; ?></p>
                        <p class="text-primary font-bold mt-1">Rp <?php echo number_format($k->harga,0,',','.'); ?></p>
                    </div>
                    <form action="<?php echo base_url('keranjang/update/'.$k->id_keranjang); ?>" method="post" class="flex items-center gap-3">
                        <div class="flex items-center bg-background rounded-xl border border-border-subtle/30 shadow-sm">
                            <button type="button" onclick="this.parentElement.querySelector('input').stepDown(); this.form.submit()" class="px-3 py-2 text-text-subtle hover:text-primary transition-colors duration-200"><i class="fas fa-minus text-xs"></i></button>
                            <input type="number" name="jumlah" value="<?php echo $k->jumlah; ?>" min="1" max="<?php echo $k->stok; ?>" onchange="this.form.submit()" class="w-12 text-center font-bold text-sm bg-transparent focus:outline-none text-primary">
                            <button type="button" onclick="this.parentElement.querySelector('input').stepUp(); this.form.submit()" class="px-3 py-2 text-text-subtle hover:text-primary transition-colors duration-200"><i class="fas fa-plus text-xs"></i></button>
                        </div>
                    </form>
                    <div class="text-right min-w-[100px]">
                        <p class="font-bold text-primary text-lg">Rp <?php echo number_format($k->harga * $k->jumlah,0,',','.'); ?></p>
                        <a href="<?php echo base_url('keranjang/hapus/'.$k->id_keranjang); ?>" onclick="return confirm('Hapus dari keranjang?')" class="text-red-400 hover:text-red-600 text-sm mt-1 inline-flex items-center gap-1 transition-colors duration-200">
                            <i class="fas fa-trash-alt text-xs"></i> Hapus
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="lg:col-span-1">
                <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-6 border border-border-subtle/20 sticky top-24 shadow-sm">
                    <h3 class="font-bold text-text-main mb-5 text-lg font-heading">Ringkasan Pesanan</h3>
                    <?php
                    $total = 0;
                    foreach($keranjang as $k) $total += $k->harga * $k->jumlah;
                    ?>
                    <div class="space-y-3 mb-5">
                        <div class="flex justify-between text-text-muted text-sm">
                            <span>Total Item</span>
                            <span class="font-medium text-text-main"><?php echo count($keranjang); ?> produk</span>
                        </div>
                        <div class="flex justify-between text-text-muted text-sm">
                            <span>Ongkir</span>
                            <span class="font-medium text-green-600">Gratis</span>
                        </div>
                    </div>
                    <div class="border-t border-border-subtle/30 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-lg text-text-main">Total</span>
                            <span class="font-extrabold text-2xl text-primary">Rp <?php echo number_format($total,0,',','.'); ?></span>
                        </div>
                    </div>
                    <a href="<?php echo base_url('checkout'); ?>" class="block w-full py-3.5 bg-primary text-white rounded-full font-medium hover:bg-primary-hover transition-all duration-200 text-center flex items-center justify-center gap-2 shadow-md shadow-primary/20">
                        <i class="fas fa-credit-card text-sm"></i> Checkout
                    </a>
                    <a href="<?php echo base_url('produk'); ?>" class="block w-full py-3 text-primary rounded-full font-medium hover:bg-background/80 transition-all duration-200 text-center mt-2 text-sm">
                        Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php $this->load->view('templates/footer_pelanggan'); ?>
