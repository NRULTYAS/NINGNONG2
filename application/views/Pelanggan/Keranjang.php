<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-12 bg-krem min-h-screen relative overflow-hidden">
    <div class="absolute top-0 right-0 w-72 h-72 bg-oranye-pastel/15 blob opacity-30"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-oranye-pastel/40 text-coklat-tua rounded-full text-sm font-medium mb-3 border border-oranye/20">
                <i class="fas fa-shopping-bag text-oranye text-xs"></i> Keranjang
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-coklat-tua mb-2">Keranjang Belanja</h1>
            <p class="text-gray-400">Kelola item pilihanmu sebelum checkout</p>
        </div>

        <?php if(empty($keranjang)): ?>
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-16 text-center border border-coklat-muda/20 max-w-xl mx-auto">
            <div class="w-28 h-28 bg-gradient-to-br from-coklat-muda/30 to-coklat-muda/10 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-shopping-bag text-4xl text-coklat-tua/30"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Keranjang Kosong</h3>
            <p class="text-gray-400 mb-8">Yuk, tambahkan kue favoritmu!</p>
            <a href="<?php echo base_url('produk'); ?>" class="px-8 py-3.5 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-medium hover:shadow-xl hover:shadow-coklat-tua/25 transition inline-flex items-center gap-2">
                <i class="fas fa-arrow-right text-sm"></i> Lihat Produk
            </a>
        </div>
        <?php else: ?>
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-4">
                <?php foreach($keranjang as $k): ?>
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-5 flex gap-5 items-center border border-coklat-muda/20 shadow-sm hover:shadow-md transition group">
                    <div class="w-24 h-24 bg-gradient-to-br from-coklat-muda/20 to-krem rounded-xl flex items-center justify-center flex-shrink-0 overflow-hidden">
                        <?php if($k->gambar && file_exists(FCPATH . 'assets/upload/'.$k->gambar)): ?>
                        <img src="<?php echo base_url('assets/upload/'.$k->gambar); ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <?php else: ?>
                        <i class="fas fa-cookie-bite text-3xl text-coklat-tua/20"></i>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-gray-800 truncate"><?php echo $k->nama_produk; ?></h3>
                        <p class="text-sm text-gray-400"><?php echo $k->nama_kategori; ?> &bull; Rasa <?php echo $k->rasa; ?></p>
                        <p class="text-coklat-tua font-bold mt-1">Rp <?php echo number_format($k->harga,0,',','.'); ?></p>
                    </div>
                    <form action="<?php echo base_url('keranjang/update/'.$k->id_keranjang); ?>" method="post" class="flex items-center gap-3">
                        <div class="flex items-center bg-krem rounded-lg border border-coklat-muda/30 shadow-sm">
                            <button type="button" onclick="this.parentElement.querySelector('input').stepDown(); this.form.submit()" class="px-3 py-2 text-gray-400 hover:text-coklat-tua transition"><i class="fas fa-minus text-xs"></i></button>
                            <input type="number" name="jumlah" value="<?php echo $k->jumlah; ?>" min="1" max="<?php echo $k->stok; ?>" onchange="this.form.submit()" class="w-12 text-center font-bold text-sm bg-transparent focus:outline-none text-coklat-tua">
                            <button type="button" onclick="this.parentElement.querySelector('input').stepUp(); this.form.submit()" class="px-3 py-2 text-gray-400 hover:text-coklat-tua transition"><i class="fas fa-plus text-xs"></i></button>
                        </div>
                    </form>
                    <div class="text-right min-w-[100px]">
                        <p class="font-bold text-coklat-tua text-lg">Rp <?php echo number_format($k->harga * $k->jumlah,0,',','.'); ?></p>
                        <a href="<?php echo base_url('keranjang/hapus/'.$k->id_keranjang); ?>" onclick="return confirm('Hapus dari keranjang?')" class="text-red-400 hover:text-red-600 text-sm mt-1 inline-flex items-center gap-1 transition">
                            <i class="fas fa-trash-alt text-xs"></i> Hapus
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="lg:col-span-1">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-coklat-muda/20 sticky top-24 shadow-sm">
                    <h3 class="font-bold text-gray-800 mb-5 text-lg">Ringkasan Pesanan</h3>
                    <?php 
                    $total = 0;
                    foreach($keranjang as $k) $total += $k->harga * $k->jumlah;
                    ?>
                    <div class="space-y-3 mb-5">
                        <div class="flex justify-between text-gray-500 text-sm">
                            <span>Total Item</span>
                            <span class="font-medium text-gray-700"><?php echo count($keranjang); ?> produk</span>
                        </div>
                        <div class="flex justify-between text-gray-500 text-sm">
                            <span>Ongkir</span>
                            <span class="font-medium text-green-600">Gratis</span>
                        </div>
                    </div>
                    <div class="border-t border-coklat-muda/30 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-lg text-gray-800">Total</span>
                            <span class="font-extrabold text-2xl text-coklat-tua">Rp <?php echo number_format($total,0,',','.'); ?></span>
                        </div>
                    </div>
                    <a href="<?php echo base_url('checkout'); ?>" class="block w-full py-3.5 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-medium hover:shadow-xl hover:shadow-coklat-tua/25 transition text-center flex items-center justify-center gap-2">
                        <i class="fas fa-credit-card text-sm"></i> Checkout
                    </a>
                    <a href="<?php echo base_url('produk'); ?>" class="block w-full py-3 text-coklat-tua rounded-xl font-medium hover:bg-krem/80 transition text-center mt-2 text-sm">
                        Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php $this->load->view('templates/footer_pelanggan'); ?>
<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-12 bg-krem min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-coklat-tua mb-8">Keranjang Belanja</h1>

        <?php if(empty($keranjang)): ?>
        <div class="bg-white rounded-2xl p-16 text-center border border-coklat-muda/20">
            <div class="w-24 h-24 bg-coklat-muda/30 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-shopping-cart text-4xl text-coklat-tua/40"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Keranjang Kosong</h3>
            <p class="text-gray-500 mb-6">Yuk, tambahkan kue favoritmu!</p>
            <a href="<?php echo base_url('produk'); ?>" class="px-8 py-3 bg-coklat-tua text-white rounded-xl font-medium hover:bg-coklat transition">Lihat Produk</a>
        </div>
        <?php else: ?>
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-4">
                <?php foreach($keranjang as $k): ?>
                <div class="bg-white rounded-2xl p-6 flex gap-6 items-center border border-coklat-muda/20">
                    <div class="w-24 h-24 bg-coklat-muda/20 rounded-xl flex items-center justify-center flex-shrink-0 overflow-hidden">
                        <?php if($k->gambar && file_exists(FCPATH . 'assets/upload/'.$k->gambar)): ?>
                        <img src="<?php echo base_url('assets/upload/'.$k->gambar); ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                        <i class="fas fa-cookie-bite text-3xl text-coklat-tua/30"></i>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-lg text-gray-800"><?php echo $k->nama_produk; ?></h3>
                        <p class="text-sm text-gray-500"><?php echo $k->nama_kategori; ?> &bull; Rasa <?php echo $k->rasa; ?></p>
                        <p class="text-coklat-tua font-bold mt-1">Rp <?php echo number_format($k->harga,0,',','.'); ?></p>
                    </div>
                    <form action="<?php echo base_url('keranjang/update/'.$k->id_keranjang); ?>" method="post" class="flex items-center gap-3">
                        <div class="flex items-center bg-krem rounded-lg border border-coklat-muda/30">
                            <button type="button" onclick="this.parentElement.querySelector('input').stepDown(); this.form.submit()" class="px-3 py-2 text-gray-500 hover:text-coklat-tua"><i class="fas fa-minus text-xs"></i></button>
                            <input type="number" name="jumlah" value="<?php echo $k->jumlah; ?>" min="1" max="<?php echo $k->stok; ?>" onchange="this.form.submit()" class="w-12 text-center font-semibold text-sm bg-transparent focus:outline-none">
                            <button type="button" onclick="this.parentElement.querySelector('input').stepUp(); this.form.submit()" class="px-3 py-2 text-gray-500 hover:text-coklat-tua"><i class="fas fa-plus text-xs"></i></button>
                        </div>
                    </form>
                    <div class="text-right min-w-[100px]">
                        <p class="font-bold text-coklat-tua">Rp <?php echo number_format($k->harga * $k->jumlah,0,',','.'); ?></p>
                        <a href="<?php echo base_url('keranjang/hapus/'.$k->id_keranjang); ?>" onclick="return confirm('Hapus dari keranjang?')" class="text-red-500 text-sm hover:underline mt-1 inline-block"><i class="fas fa-trash-alt mr-1"></i>Hapus</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl p-6 border border-coklat-muda/20 sticky top-24">
                    <h3 class="font-semibold text-lg text-gray-800 mb-4">Ringkasan</h3>
                    <?php 
                    $total = 0;
                    foreach($keranjang as $k) $total += $k->harga * $k->jumlah;
                    ?>
                    <div class="flex justify-between mb-3 text-gray-600">
                        <span>Total Item</span>
                        <span><?php echo count($keranjang); ?> produk</span>
                    </div>
                    <div class="border-t border-coklat-muda/30 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-lg">Total</span>
                            <span class="font-bold text-2xl text-coklat-tua">Rp <?php echo number_format($total,0,',','.'); ?></span>
                        </div>
                    </div>
                    <a href="<?php echo base_url('checkout'); ?>" class="block w-full py-3 bg-coklat-tua text-white rounded-xl font-medium hover:bg-coklat transition text-center">Checkout</a>
                    <a href="<?php echo base_url('produk'); ?>" class="block w-full py-3 text-coklat-tua rounded-xl font-medium hover:bg-krem transition text-center mt-2">Lanjut Belanja</a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php $this->load->view('templates/footer_pelanggan'); ?>
