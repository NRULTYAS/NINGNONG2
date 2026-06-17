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
