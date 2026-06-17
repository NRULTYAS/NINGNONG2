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
