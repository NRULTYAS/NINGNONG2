<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-12 bg-krem min-h-screen relative overflow-hidden">
    <div class="absolute top-0 right-0 w-72 h-72 bg-oranye-pastel/15 blob opacity-30"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-oranye-pastel/40 text-coklat-tua rounded-full text-sm font-medium mb-3 border border-oranye/20">
                <i class="fas fa-credit-card text-oranye text-xs"></i> Checkout
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-coklat-tua mb-2">Selesaikan Pesanan</h1>
            <p class="text-gray-400">Isi data pengiriman dan pilih metode pembayaran</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <form action="<?php echo base_url('checkout/proses'); ?>" method="post">
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-coklat-muda/20 shadow-sm">
                        <h3 class="font-bold text-gray-800 mb-5 text-lg flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-coklat-tua to-coklat rounded-xl flex items-center justify-center text-white shadow-md shadow-coklat-tua/20">
                                <i class="fas fa-truck text-sm"></i>
                            </div>
                            Informasi Pengiriman
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Penerima</label>
                                <div class="relative">
                                    <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    <input type="text" name="nama_penerima" value="<?php echo $user->nama; ?>" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">No HP</label>
                                <div class="relative">
                                    <i class="fas fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    <input type="text" name="no_hp" value="<?php echo $user->no_hp; ?>" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Pengiriman</label>
                            <textarea name="alamat" required rows="3" class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition"><?php echo $user->alamat; ?></textarea>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-coklat-muda/20 shadow-sm">
                        <h3 class="font-bold text-gray-800 mb-5 text-lg flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-oranye to-oranye-pastel rounded-xl flex items-center justify-center text-white shadow-md shadow-oranye/20">
                                <i class="fas fa-wallet text-sm"></i>
                            </div>
                            Metode Pembayaran
                        </h3>
                        <div class="space-y-3">
                            <label class="flex items-center gap-4 p-4 rounded-xl border border-coklat-muda/30 cursor-pointer hover:bg-krem/50 hover:border-coklat-tua/30 transition group">
                                <input type="radio" name="metode_pembayaran" value="Transfer Bank" checked class="w-5 h-5 text-coklat-tua accent-coklat-tua">
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-800 group-hover:text-coklat-tua transition">Transfer Bank</p>
                                    <p class="text-sm text-gray-400">BCA / Mandiri / BNI</p>
                                </div>
                                <i class="fas fa-university text-coklat-muda group-hover:text-coklat transition"></i>
                            </label>
                            <label class="flex items-center gap-4 p-4 rounded-xl border border-coklat-muda/30 cursor-pointer hover:bg-krem/50 hover:border-coklat-tua/30 transition group">
                                <input type="radio" name="metode_pembayaran" value="COD" class="w-5 h-5 text-coklat-tua accent-coklat-tua">
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-800 group-hover:text-coklat-tua transition">COD (Bayar di Tempat)</p>
                                    <p class="text-sm text-gray-400">Bayar saat menerima pesanan</p>
                                </div>
                                <i class="fas fa-hand-holding-usd text-coklat-muda group-hover:text-coklat transition"></i>
                            </label>
                            <label class="flex items-center gap-4 p-4 rounded-xl border border-coklat-muda/30 cursor-pointer hover:bg-krem/50 hover:border-coklat-tua/30 transition group">
                                <input type="radio" name="metode_pembayaran" value="E-Wallet" class="w-5 h-5 text-coklat-tua accent-coklat-tua">
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-800 group-hover:text-coklat-tua transition">E-Wallet</p>
                                    <p class="text-sm text-gray-400">Dana / OVO / GoPay</p>
                                </div>
                                <i class="fas fa-mobile-alt text-coklat-muda group-hover:text-coklat transition"></i>
                            </label>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-coklat-muda/20 shadow-sm">
                        <h3 class="font-bold text-gray-800 mb-5 text-lg flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-500 rounded-xl flex items-center justify-center text-white shadow-md shadow-green-500/20">
                                <i class="fas fa-sticky-note text-sm"></i>
                            </div>
                            Catatan Tambahan
                        </h3>
                        <textarea name="catatan" rows="3" class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition" placeholder="Catatan tambahan untuk pesanan (opsional)"></textarea>
                    </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-coklat-muda/20 sticky top-24 shadow-sm">
                    <h3 class="font-bold text-gray-800 mb-5 text-lg">Ringkasan Pesanan</h3>
                    <div class="space-y-3 mb-5 max-h-60 overflow-y-auto pr-1">
                        <?php $total = 0; foreach($keranjang as $k): $subtotal = $k->harga * $k->jumlah; $total += $subtotal; ?>
                        <div class="flex justify-between text-sm items-center">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-krem rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-cookie-bite text-coklat-tua/40 text-xs"></i>
                                </div>
                                <span class="text-gray-600 truncate max-w-[120px]"><?php echo $k->nama_produk; ?></span>
                            </div>
                            <span class="font-medium text-coklat-tua">x<?php echo $k->jumlah; ?></span>
                            <span class="font-medium text-gray-700">Rp <?php echo number_format($subtotal,0,',','.'); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="border-t border-coklat-muda/30 pt-4 mb-2">
                        <div class="flex justify-between text-sm text-gray-500 mb-2">
                            <span>Subtotal</span>
                            <span>Rp <?php echo number_format($total,0,',','.'); ?></span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-500 mb-4">
                            <span>Ongkir</span>
                            <span class="text-green-600 font-medium">Gratis</span>
                        </div>
                    </div>
                    <div class="border-t border-coklat-muda/30 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-lg text-gray-800">Total</span>
                            <span class="font-extrabold text-2xl text-coklat-tua">Rp <?php echo number_format($total,0,',','.'); ?></span>
                        </div>
                    </div>
                    <button type="submit" class="block w-full py-3.5 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-medium hover:shadow-xl hover:shadow-coklat-tua/25 transition text-center flex items-center justify-center gap-2">
                        <i class="fas fa-check-circle text-sm"></i> Buat Pesanan
                    </button>
                    <a href="<?php echo base_url('keranjang'); ?>" class="block w-full py-3 text-coklat-tua rounded-xl font-medium hover:bg-krem/80 transition text-center mt-2 text-sm">
                        Kembali ke Keranjang
                    </a>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('templates/footer_pelanggan'); ?>
<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-12 bg-krem min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-coklat-tua mb-8">Checkout</h1>

        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <form action="<?php echo base_url('checkout/proses'); ?>" method="post">
                    <div class="bg-white rounded-2xl p-6 border border-coklat-muda/20 mb-6">
                        <h3 class="font-semibold text-lg text-gray-800 mb-4"><i class="fas fa-truck mr-2 text-coklat-tua"></i>Informasi Pengiriman</h3>
                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Penerima</label>
                                <input type="text" name="nama_penerima" value="<?php echo $user->nama; ?>" required class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">No HP</label>
                                <input type="text" name="no_hp" value="<?php echo $user->no_hp; ?>" required class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Pengiriman</label>
                            <textarea name="alamat" required rows="3" class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30"><?php echo $user->alamat; ?></textarea>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-coklat-muda/20 mb-6">
                        <h3 class="font-semibold text-lg text-gray-800 mb-4"><i class="fas fa-credit-card mr-2 text-coklat-tua"></i>Metode Pembayaran</h3>
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 p-4 rounded-xl border border-coklat-muda/30 cursor-pointer hover:bg-krem/50 transition">
                                <input type="radio" name="metode_pembayaran" value="Transfer Bank" checked class="w-5 h-5 text-coklat-tua">
                                <div>
                                    <p class="font-medium">Transfer Bank</p>
                                    <p class="text-sm text-gray-500">BCA / Mandiri / BNI</p>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 p-4 rounded-xl border border-coklat-muda/30 cursor-pointer hover:bg-krem/50 transition">
                                <input type="radio" name="metode_pembayaran" value="COD" class="w-5 h-5 text-coklat-tua">
                                <div>
                                    <p class="font-medium">COD (Bayar di Tempat)</p>
                                    <p class="text-sm text-gray-500">Bayar saat menerima pesanan</p>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 p-4 rounded-xl border border-coklat-muda/30 cursor-pointer hover:bg-krem/50 transition">
                                <input type="radio" name="metode_pembayaran" value="E-Wallet" class="w-5 h-5 text-coklat-tua">
                                <div>
                                    <p class="font-medium">E-Wallet</p>
                                    <p class="text-sm text-gray-500">Dana / OVO / GoPay</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-coklat-muda/20">
                        <h3 class="font-semibold text-lg text-gray-800 mb-4"><i class="fas fa-sticky-note mr-2 text-coklat-tua"></i>Catatan</h3>
                        <textarea name="catatan" rows="2" class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30" placeholder="Catatan tambahan untuk pesanan (opsional)"></textarea>
                    </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl p-6 border border-coklat-muda/20 sticky top-24">
                    <h3 class="font-semibold text-lg text-gray-800 mb-4">Ringkasan Pesanan</h3>
                    <div class="space-y-3 mb-4">
                        <?php $total = 0; foreach($keranjang as $k): $subtotal = $k->harga * $k->jumlah; $total += $subtotal; ?>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600"><?php echo $k->nama_produk; ?> x<?php echo $k->jumlah; ?></span>
                            <span class="font-medium">Rp <?php echo number_format($subtotal,0,',','.'); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="border-t border-coklat-muda/30 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-lg">Total</span>
                            <span class="font-bold text-2xl text-coklat-tua">Rp <?php echo number_format($total,0,',','.'); ?></span>
                        </div>
                    </div>
                    <button type="submit" class="block w-full py-3 bg-coklat-tua text-white rounded-xl font-medium hover:bg-coklat transition text-center">Buat Pesanan</button>
                    <a href="<?php echo base_url('keranjang'); ?>" class="block w-full py-3 text-coklat-tua rounded-xl font-medium hover:bg-krem transition text-center mt-2">Kembali ke Keranjang</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('templates/footer_pelanggan'); ?>
