<?php $this->load->view('templates/header_pelanggan'); ?>

<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-krem via-white to-oranye-pastel/20 py-20 md:py-28">
    <!-- Decorative blobs -->
    <div class="absolute top-10 left-10 w-72 h-72 bg-oranye-pastel/30 blob animate-float opacity-40"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-coklat-muda/20 blob animate-float-delay opacity-30"></div>
    <div class="absolute top-1/2 left-1/2 w-48 h-48 bg-oranye/10 blob opacity-20" style="animation:float 8s ease-in-out 1s infinite"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="relative z-10">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-oranye-pastel/50 text-coklat-tua rounded-full text-sm font-medium mb-6 border border-oranye/30">
                    <i class="fas fa-star text-oranye text-xs"></i> Kue Basah Tradisional
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-coklat-tua leading-tight mb-6">
                    Nikmati Kelezatan<br>
                    <span class="relative inline-block">
                        Kue Basah
                        <span class="absolute -bottom-1 left-0 w-full h-3 bg-oranye-pastel/40 -z-10 rounded-full"></span>
                    </span>
                    <span class="bg-gradient-to-r from-coklat-tua via-coklat to-oranye bg-clip-text text-transparent"> Asli Indonesia</span>
                </h1>
                <p class="text-gray-500 text-lg mb-8 leading-relaxed max-w-lg">Dibuat dengan resep turun-temurun menggunakan bahan-bahan pilihan berkualitas tinggi. Rasakan kelezatan yang tak terlupakan.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="<?php echo base_url('produk'); ?>" class="group px-8 py-3.5 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-medium hover:shadow-xl hover:shadow-coklat-tua/25 transition flex items-center gap-2">
                        Lihat Produk <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="<?php echo base_url('auth/register'); ?>" class="px-8 py-3.5 border-2 border-coklat-tua/30 text-coklat-tua rounded-xl font-medium hover:bg-coklat-tua hover:text-white hover:border-coklat-tua transition">Daftar Sekarang</a>
                </div>
                <!-- Stats -->
                <div class="flex gap-8 mt-10">
                    <div>
                        <p class="text-2xl font-bold text-coklat-tua">500+</p>
                        <p class="text-sm text-gray-400">Pelanggan</p>
                    </div>
                    <div class="w-px bg-coklat-muda"></div>
                    <div>
                        <p class="text-2xl font-bold text-coklat-tua">50+</p>
                        <p class="text-sm text-gray-400">Menu Kue</p>
                    </div>
                    <div class="w-px bg-coklat-muda"></div>
                    <div>
                        <p class="text-2xl font-bold text-coklat-tua">4.9<i class="fas fa-star text-oranye text-sm ml-1"></i></p>
                        <p class="text-sm text-gray-400">Rating</p>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="aspect-square rounded-[2rem] bg-gradient-to-br from-coklat-muda/30 to-oranye-pastel/20 flex items-center justify-center relative overflow-hidden border border-white/50 shadow-2xl shadow-coklat/10">
                    <div class="absolute inset-0 bg-gradient-to-tr from-oranye-pastel/20 to-transparent"></div>
                    <i class="fas fa-birthday-cake text-[10rem] text-coklat-tua/10"></i>
                    <!-- Floating badges -->
                    <div class="absolute -bottom-2 -left-2 md:bottom-8 md:left-8 bg-white rounded-2xl shadow-xl p-4 flex items-center gap-3 animate-float border border-coklat-muda/10">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-green-500/30">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">100% Alami</p>
                            <p class="text-xs text-gray-400">Bahan Berkualitas</p>
                        </div>
                    </div>
                    <div class="absolute -top-2 -right-2 md:top-8 md:right-8 bg-white rounded-2xl shadow-xl p-4 flex items-center gap-3 animate-float-delay border border-coklat-muda/10">
                        <div class="w-12 h-12 bg-gradient-to-br from-oranye to-oranye-pastel rounded-xl flex items-center justify-center text-white shadow-lg shadow-oranye/30">
                            <i class="fas fa-fire"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Fresh Daily</p>
                            <p class="text-xs text-gray-400">Dibuat Pagi Hari</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Kategori Section -->
<section class="py-20 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1 bg-krem text-coklat rounded-full text-sm font-medium mb-3">Kategori</span>
            <h2 class="text-3xl md:text-4xl font-bold text-coklat-tua mb-3">Kategori Kue Kami</h2>
            <p class="text-gray-400 max-w-md mx-auto">Pilih kue favoritmu dari berbagai kategori pilihan</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <?php $icons = ['fa-cookie','fa-cookie-bite','fa-ice-cream','fa-stroopwafel','fa-candy-cane','fa-lemon']; $ci=0; ?>
            <?php foreach($kategori as $k): ?>
            <a href="<?php echo base_url('produk?kategori='.$k->id_kategori); ?>" class="group card-hover">
                <div class="bg-krem/80 rounded-2xl p-6 text-center hover:bg-gradient-to-br hover:from-coklat-tua hover:to-coklat transition-all duration-300 border border-coklat-muda/10 hover:border-transparent hover:shadow-xl hover:shadow-coklat-tua/15">
                    <div class="w-14 h-14 mx-auto bg-coklat-tua/10 rounded-2xl flex items-center justify-center mb-3 group-hover:bg-white/20 transition text-coklat-tua group-hover:text-white">
                        <i class="fas <?php echo $icons[$ci % count($icons)]; ?> text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-700 group-hover:text-white transition text-sm"><?php echo $k->nama_kategori; ?></h3>
                </div>
            </a>
            <?php $ci++; endforeach; ?>
        </div>
    </div>
</section>

<!-- Produk Terbaru -->
<section class="py-20 bg-krem relative">
    <div class="absolute top-0 right-0 w-64 h-64 bg-oranye-pastel/20 blob opacity-40"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="flex flex-wrap justify-between items-end mb-12 gap-4">
            <div>
                <span class="inline-block px-4 py-1 bg-white text-coklat rounded-full text-sm font-medium mb-3">Terbaru</span>
                <h2 class="text-3xl md:text-4xl font-bold text-coklat-tua mb-2">Produk Terbaru</h2>
                <p class="text-gray-400">Kue basah segar yang baru saja tersedia</p>
            </div>
            <a href="<?php echo base_url('produk'); ?>" class="group flex items-center gap-2 text-coklat-tua font-medium hover:gap-3 transition-all">
                Lihat Semua <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach($produk_terbaru as $p): ?>
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group border border-coklat-muda/10 card-hover">
                <div class="aspect-[4/3] bg-gradient-to-br from-coklat-muda/20 to-krem flex items-center justify-center relative overflow-hidden">
                    <?php if($p->gambar && file_exists(FCPATH . 'assets/upload/'.$p->gambar)): ?>
                    <img src="<?php echo base_url('assets/upload/'.$p->gambar); ?>" alt="<?php echo $p->nama_produk; ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <?php else: ?>
                    <i class="fas fa-cookie-bite text-6xl text-coklat-tua/15"></i>
                    <?php endif; ?>
                    <span class="absolute top-3 left-3 bg-coklat-tua/80 backdrop-blur-sm text-white text-[10px] px-3 py-1 rounded-lg font-medium tracking-wide uppercase"><?php echo $p->nama_kategori; ?></span>
                    <?php if($p->stok <= 5 && $p->stok > 0): ?>
                    <span class="absolute top-3 right-3 bg-red-500/90 backdrop-blur-sm text-white text-[10px] px-3 py-1 rounded-lg font-medium">Stok Menipis!</span>
                    <?php endif; ?>
                    <!-- Quick view overlay -->
                    <div class="absolute inset-0 bg-coklat-tua/0 group-hover:bg-coklat-tua/10 transition duration-300 flex items-center justify-center">
                        <a href="<?php echo base_url('produk/detail/'.$p->id_produk); ?>" class="w-11 h-11 bg-white rounded-xl flex items-center justify-center text-coklat-tua shadow-lg opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:bg-coklat-tua hover:text-white">
                            <i class="fas fa-eye text-sm"></i>
                        </a>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-gray-800 mb-1 group-hover:text-coklat-tua transition"><?php echo $p->nama_produk; ?></h3>
                    <p class="text-sm text-gray-400 mb-3">Rasa <?php echo $p->rasa; ?></p>
                    <div class="flex items-center justify-between">
                        <span class="text-coklat-tua font-bold text-lg">Rp <?php echo number_format($p->harga,0,',','.'); ?></span>
                        <?php if($p->stok > 0): ?>
                        <span class="text-xs text-green-600 bg-green-50 px-2 py-1 rounded-lg font-medium">Tersedia</span>
                        <?php else: ?>
                        <span class="text-xs text-gray-400 bg-gray-50 px-2 py-1 rounded-lg font-medium">Habis</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Keunggulan -->
<section class="py-20 bg-white relative overflow-hidden">
    <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-krem blob opacity-50"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1 bg-krem text-coklat rounded-full text-sm font-medium mb-3">Keunggulan</span>
            <h2 class="text-3xl md:text-4xl font-bold text-coklat-tua mb-3">Mengapa Memilih Kami?</h2>
            <p class="text-gray-400 max-w-md mx-auto">Komitmen kami untuk memberikan yang terbaik</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center p-10 bg-gradient-to-br from-krem to-white rounded-3xl border border-coklat-muda/10 card-hover group">
                <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-500 rounded-2xl flex items-center justify-center mx-auto mb-5 text-white shadow-lg shadow-green-500/25 group-hover:shadow-green-500/40 transition">
                    <i class="fas fa-leaf text-2xl"></i>
                </div>
                <h3 class="font-bold text-xl mb-2 text-gray-800">Bahan Alami</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Hanya menggunakan bahan-bahan alami tanpa pengawet berbahaya untuk keluarga tercinta</p>
            </div>
            <div class="text-center p-10 bg-gradient-to-br from-krem to-white rounded-3xl border border-coklat-muda/10 card-hover group">
                <div class="w-16 h-16 bg-gradient-to-br from-oranye to-oranye-pastel rounded-2xl flex items-center justify-center mx-auto mb-5 text-white shadow-lg shadow-oranye/25 group-hover:shadow-oranye/40 transition">
                    <i class="fas fa-truck text-2xl"></i>
                </div>
                <h3 class="font-bold text-xl mb-2 text-gray-800">Pengiriman Cepat</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Pesanan dikirim dalam kondisi terbaik dan tepat waktu langsung ke pintu rumahmu</p>
            </div>
            <div class="text-center p-10 bg-gradient-to-br from-krem to-white rounded-3xl border border-coklat-muda/10 card-hover group">
                <div class="w-16 h-16 bg-gradient-to-br from-coklat-tua to-coklat rounded-2xl flex items-center justify-center mx-auto mb-5 text-white shadow-lg shadow-coklat-tua/25 group-hover:shadow-coklat-tua/40 transition">
                    <i class="fas fa-heart text-2xl"></i>
                </div>
                <h3 class="font-bold text-xl mb-2 text-gray-800">Dibuat dengan Cinta</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Setiap kue dibuat dengan penuh perhatian dan cinta menggunakan resep turun-temurun</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="relative bg-gradient-to-br from-coklat-tua via-coklat to-coklat-tua">
    <div class="max-w-3xl mx-auto px-4 py-10 md:py-12 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-2 tracking-tight">Siap Memesan Kue Favoritmu?</h2>
        <p class="text-coklat-muda/80 text-sm md:text-base mb-6 max-w-lg mx-auto">Pesan sekarang dan nikmati kelezatan kue basah segar langsung ke rumahmu</p>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="<?php echo base_url('produk'); ?>" class="px-6 py-2.5 bg-white text-coklat-tua rounded-lg font-semibold text-sm hover:shadow-lg hover:shadow-black/10 transition flex items-center gap-2">
                <i class="fas fa-shopping-bag text-xs"></i> Pesan Sekarang
            </a>
            <a href="https://wa.me/<?php echo NOMOR_WA_PENJUAL; ?>" target="_blank" class="px-6 py-2.5 bg-green-500 text-white rounded-lg font-semibold text-sm hover:bg-green-600 hover:shadow-lg hover:shadow-black/10 transition flex items-center gap-2">
                <i class="fab fa-whatsapp text-xs"></i> Chat WhatsApp
            </a>
        </div>
    </div>
</section>

<!-- Separator -->
<div class="h-px bg-gradient-to-r from-transparent via-coklat-muda/40 to-transparent"></div>

<?php $this->load->view('templates/footer_pelanggan'); ?>
