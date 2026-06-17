<?php $this->load->view('templates/header_pelanggan'); ?>

<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-coklat-muda/30 via-krem to-oranye-pastel/20 py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-block px-4 py-1 bg-oranye-pastel/60 text-coklat-tua rounded-full text-sm font-medium mb-4">Kue Basah Tradisional</span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-coklat-tua leading-tight mb-6">Nikmati Kelezatan Kue Basah <span class="text-oranye">Asli Indonesia</span></h1>
                <p class="text-gray-600 text-lg mb-8 leading-relaxed">Dibuat dengan resep turun-temurun menggunakan bahan-bahan pilihan berkualitas tinggi. Rasakan kelezatan yang tak terlupakan.</p>
                <div class="flex gap-4">
                    <a href="<?php echo base_url('produk'); ?>" class="px-8 py-3 bg-coklat-tua text-white rounded-xl font-medium hover:bg-coklat transition shadow-lg shadow-coklat-tua/20">Lihat Produk</a>
                    <a href="<?php echo base_url('auth/register'); ?>" class="px-8 py-3 border-2 border-coklat-tua text-coklat-tua rounded-xl font-medium hover:bg-coklat-tua hover:text-white transition">Daftar Sekarang</a>
                </div>
            </div>
            <div class="relative">
                <div class="aspect-square rounded-3xl bg-coklat-muda/40 flex items-center justify-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-tr from-oranye-pastel/30 to-transparent"></div>
                    <i class="fas fa-birthday-cake text-9xl text-coklat-tua/20"></i>
                </div>
                <div class="absolute -bottom-4 -left-4 bg-white rounded-2xl shadow-lg p-4 flex items-center gap-3">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                        <i class="fas fa-check"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Bahan Berkualitas</p>
                        <p class="text-sm text-gray-500">100% Alami</p>
                    </div>
                </div>
                <div class="absolute -top-4 -right-4 bg-white rounded-2xl shadow-lg p-4 flex items-center gap-3">
                    <div class="w-12 h-12 bg-oranye-pastel rounded-full flex items-center justify-center text-coklat-tua">
                        <i class="fas fa-fire"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Fresh Setiap Hari</p>
                        <p class="text-sm text-gray-500">Dibuat Pagi Hari</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Kategori Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-coklat-tua mb-3">Kategori Kue</h2>
            <p class="text-gray-500">Pilih kue favoritmu dari berbagai kategori</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <?php foreach($kategori as $k): ?>
            <a href="<?php echo base_url('produk?kategori='.$k->id_kategori); ?>" class="group">
                <div class="bg-krem rounded-2xl p-6 text-center hover:bg-coklat-muda/30 transition border border-coklat-muda/20">
                    <div class="w-16 h-16 mx-auto bg-coklat-tua/10 rounded-full flex items-center justify-center mb-3 group-hover:bg-coklat-tua group-hover:text-white transition text-coklat-tua">
                        <i class="fas fa-utensils text-xl"></i>
                    </div>
                    <h3 class="font-medium text-gray-800"><?php echo $k->nama_kategori; ?></h3>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Produk Terbaru -->
<section class="py-16 bg-krem">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-bold text-coklat-tua mb-2">Produk Terbaru</h2>
                <p class="text-gray-500">Kue basah segar yang baru saja tersedia</p>
            </div>
            <a href="<?php echo base_url('produk'); ?>" class="text-coklat-tua font-medium hover:underline">Lihat Semua <i class="fas fa-arrow-right ml-1"></i></a>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach($produk_terbaru as $p): ?>
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition group border border-coklat-muda/20">
                <div class="aspect-[4/3] bg-coklat-muda/20 flex items-center justify-center relative overflow-hidden">
                    <?php if($p->gambar && file_exists(FCPATH . 'assets/upload/'.$p->gambar)): ?>
                    <img src="<?php echo base_url('assets/upload/'.$p->gambar); ?>" alt="<?php echo $p->nama_produk; ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <?php else: ?>
                    <i class="fas fa-cookie-bite text-6xl text-coklat-tua/20"></i>
                    <?php endif; ?>
                    <span class="absolute top-3 left-3 bg-oranye text-white text-xs px-3 py-1 rounded-full font-medium"><?php echo $p->nama_kategori; ?></span>
                </div>
                <div class="p-5">
                    <h3 class="font-semibold text-lg text-gray-800 mb-1"><?php echo $p->nama_produk; ?></h3>
                    <p class="text-sm text-gray-500 mb-3">Rasa <?php echo $p->rasa; ?></p>
                    <div class="flex items-center justify-between">
                        <span class="text-coklat-tua font-bold text-lg">Rp <?php echo number_format($p->harga,0,',','.'); ?></span>
                        <a href="<?php echo base_url('produk/detail/'.$p->id_produk); ?>" class="w-10 h-10 bg-coklat-tua text-white rounded-full flex items-center justify-center hover:bg-coklat transition">
                            <i class="fas fa-eye text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Keunggulan -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-coklat-tua mb-3">Mengapa Memilih Kami?</h2>
            <p class="text-gray-500">Komitmen kami untuk memberikan yang terbaik</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center p-8 bg-krem rounded-2xl border border-coklat-muda/20">
                <div class="w-16 h-16 bg-coklat-tua/10 rounded-full flex items-center justify-center mx-auto mb-4 text-coklat-tua">
                    <i class="fas fa-leaf text-2xl"></i>
                </div>
                <h3 class="font-semibold text-xl mb-2">Bahan Alami</h3>
                <p class="text-gray-500 text-sm">Hanya menggunakan bahan-bahan alami tanpa pengawet berbahaya</p>
            </div>
            <div class="text-center p-8 bg-krem rounded-2xl border border-coklat-muda/20">
                <div class="w-16 h-16 bg-coklat-tua/10 rounded-full flex items-center justify-center mx-auto mb-4 text-coklat-tua">
                    <i class="fas fa-truck text-2xl"></i>
                </div>
                <h3 class="font-semibold text-xl mb-2">Pengiriman Cepat</h3>
                <p class="text-gray-500 text-sm">Pesanan dikirim dalam kondisi terbaik dan tepat waktu</p>
            </div>
            <div class="text-center p-8 bg-krem rounded-2xl border border-coklat-muda/20">
                <div class="w-16 h-16 bg-coklat-tua/10 rounded-full flex items-center justify-center mx-auto mb-4 text-coklat-tua">
                    <i class="fas fa-heart text-2xl"></i>
                </div>
                <h3 class="font-semibold text-xl mb-2">Dibuat dengan Cinta</h3>
                <p class="text-gray-500 text-sm">Setiap kue dibuat dengan penuh perhatian dan cinta</p>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('templates/footer_pelanggan'); ?>
