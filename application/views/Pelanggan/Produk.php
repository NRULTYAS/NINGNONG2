<?php $this->load->view('templates/header_pelanggan'); ?>

<!-- Page Header -->
<section class="relative overflow-hidden bg-gradient-to-br from-krem via-white to-oranye-pastel/20 py-16 md:py-20">
    <div class="absolute top-0 right-0 w-72 h-72 bg-oranye-pastel/20 blob opacity-40"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-coklat-muda/20 blob opacity-30" style="animation:float 7s ease-in-out 1s infinite"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-center">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-oranye-pastel/40 text-coklat-tua rounded-full text-sm font-medium mb-4 border border-oranye/20">
            <i class="fas fa-utensils text-oranye text-xs"></i> Katalog
        </span>
        <h1 class="text-4xl md:text-5xl font-extrabold text-coklat-tua mb-3">Daftar Produk</h1>
        <p class="text-gray-400 max-w-lg mx-auto">Temukan berbagai kue basah lezat pilihanmu</p>
    </div>
</section>

<section class="py-12 bg-krem min-h-screen relative">
    <div class="absolute top-0 left-0 w-64 h-64 bg-oranye-pastel/10 blob opacity-30"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Search & Filter -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-sm mb-10 border border-coklat-muda/20">
            <form action="<?php echo base_url('produk'); ?>" method="get" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative group">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-coklat-tua transition"></i>
                    <input type="text" name="q" value="<?php echo $keyword; ?>" placeholder="Cari produk..." class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition">
                </div>
                <select name="kategori" class="px-4 py-3.5 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition cursor-pointer">
                    <option value="">Semua Kategori</option>
                    <?php foreach($kategori as $k): ?>
                    <option value="<?php echo $k->id_kategori; ?>" <?php echo $id_kategori == $k->id_kategori ? 'selected' : ''; ?>><?php echo $k->nama_kategori; ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="px-8 py-3.5 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-medium hover:shadow-lg hover:shadow-coklat-tua/25 transition flex items-center justify-center gap-2">
                    <i class="fas fa-search text-sm"></i> Cari
                </button>
            </form>
        </div>

        <!-- Produk Grid -->
        <?php if(empty($produk)): ?>
        <div class="text-center py-20">
            <div class="w-28 h-28 bg-gradient-to-br from-coklat-muda/30 to-coklat-muda/10 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-search text-4xl text-coklat-tua/30"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Produk tidak ditemukan</h3>
            <p class="text-gray-400 mb-6">Coba kata kunci atau kategori lain</p>
            <a href="<?php echo base_url('produk'); ?>" class="px-8 py-3 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-medium hover:shadow-lg transition">Lihat Semua Produk</a>
        </div>
        <?php else: ?>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach($produk as $p): ?>
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group border border-coklat-muda/10 card-hover">
                <div class="aspect-[4/3] bg-gradient-to-br from-coklat-muda/20 to-krem flex items-center justify-center relative overflow-hidden">
                    <?php if($p->gambar && file_exists(FCPATH . 'assets/upload/'.$p->gambar)): ?>
                    <img src="<?php echo base_url('assets/upload/'.$p->gambar); ?>" alt="<?php echo $p->nama_produk; ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <?php else: ?>
                    <i class="fas fa-cookie-bite text-6xl text-coklat-tua/15"></i>
                    <?php endif; ?>
                    <span class="absolute top-3 left-3 bg-coklat-tua/80 backdrop-blur-sm text-white text-[10px] px-3 py-1 rounded-lg font-medium tracking-wide uppercase"><?php echo $p->nama_kategori; ?></span>
                    <?php if($p->stok <= 5 && $p->stok > 0): ?>
                    <span class="absolute top-3 right-3 bg-red-500/90 backdrop-blur-sm text-white text-[10px] px-3 py-1 rounded-lg font-medium">Stok Menipis</span>
                    <?php elseif($p->stok == 0): ?>
                    <span class="absolute top-3 right-3 bg-gray-500/90 backdrop-blur-sm text-white text-[10px] px-3 py-1 rounded-lg font-medium">Habis</span>
                    <?php endif; ?>
                    <div class="absolute inset-0 bg-coklat-tua/0 group-hover:bg-coklat-tua/10 transition duration-300 flex items-center justify-center">
                        <a href="<?php echo base_url('produk/detail/'.$p->id_produk); ?>" class="w-11 h-11 bg-white rounded-xl flex items-center justify-center text-coklat-tua shadow-lg opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:bg-coklat-tua hover:text-white">
                            <i class="fas fa-eye text-sm"></i>
                        </a>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-gray-800 mb-1 group-hover:text-coklat-tua transition"><?php echo $p->nama_produk; ?></h3>
                    <p class="text-sm text-gray-400 mb-3">Rasa <?php echo $p->rasa; ?> &bull; Stok <?php echo $p->stok; ?></p>
                    <div class="flex items-center justify-between">
                        <span class="text-coklat-tua font-bold text-lg">Rp <?php echo number_format($p->harga,0,',','.'); ?></span>
                        <a href="<?php echo base_url('produk/detail/'.$p->id_produk); ?>" class="w-9 h-9 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-lg flex items-center justify-center hover:shadow-md transition">
                            <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
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
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-coklat-tua mb-3">Daftar Produk</h1>
            <p class="text-gray-500">Temukan berbagai kue basah lezat pilihanmu</p>
        </div>

        <!-- Search & Filter -->
        <div class="bg-white rounded-2xl p-6 shadow-sm mb-8 border border-coklat-muda/20">
            <form action="<?php echo base_url('produk'); ?>" method="get" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="q" value="<?php echo $keyword; ?>" placeholder="Cari produk..." class="w-full pl-11 pr-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/50">
                </div>
                <select name="kategori" class="px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/50">
                    <option value="">Semua Kategori</option>
                    <?php foreach($kategori as $k): ?>
                    <option value="<?php echo $k->id_kategori; ?>" <?php echo $id_kategori == $k->id_kategori ? 'selected' : ''; ?>><?php echo $k->nama_kategori; ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="px-8 py-3 bg-coklat-tua text-white rounded-xl font-medium hover:bg-coklat transition">Cari</button>
            </form>
        </div>

        <!-- Produk Grid -->
        <?php if(empty($produk)): ?>
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-coklat-muda/30 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-search text-4xl text-coklat-tua/40"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Produk tidak ditemukan</h3>
            <p class="text-gray-500">Coba kata kunci atau kategori lain</p>
        </div>
        <?php else: ?>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach($produk as $p): ?>
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition group border border-coklat-muda/20">
                <div class="aspect-[4/3] bg-coklat-muda/20 flex items-center justify-center relative overflow-hidden">
                    <?php if($p->gambar && file_exists(FCPATH . 'assets/upload/'.$p->gambar)): ?>
                    <img src="<?php echo base_url('assets/upload/'.$p->gambar); ?>" alt="<?php echo $p->nama_produk; ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <?php else: ?>
                    <i class="fas fa-cookie-bite text-6xl text-coklat-tua/20"></i>
                    <?php endif; ?>
                    <span class="absolute top-3 left-3 bg-oranye text-white text-xs px-3 py-1 rounded-full font-medium"><?php echo $p->nama_kategori; ?></span>
                    <?php if($p->stok <= 5 && $p->stok > 0): ?>
                    <span class="absolute top-3 right-3 bg-red-500 text-white text-xs px-3 py-1 rounded-full font-medium">Stok Menipis</span>
                    <?php elseif($p->stok == 0): ?>
                    <span class="absolute top-3 right-3 bg-gray-500 text-white text-xs px-3 py-1 rounded-full font-medium">Habis</span>
                    <?php endif; ?>
                </div>
                <div class="p-5">
                    <h3 class="font-semibold text-lg text-gray-800 mb-1"><?php echo $p->nama_produk; ?></h3>
                    <p class="text-sm text-gray-500 mb-3">Rasa <?php echo $p->rasa; ?> &bull; Stok <?php echo $p->stok; ?></p>
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
        <?php endif; ?>
    </div>
</section>

<?php $this->load->view('templates/footer_pelanggan'); ?>
