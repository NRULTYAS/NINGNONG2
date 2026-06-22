<?php $this->load->view('templates/header_pelanggan'); ?>

<!-- Breadcrumb -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
    <nav class="flex items-center gap-2 text-sm text-gray-500">
        <a href="<?php echo base_url('home'); ?>" class="hover:text-coklat-tua transition">Beranda</a>
        <span class="text-gray-400">/</span>
        <a href="<?php echo base_url('pesanan/pilih_jenis'); ?>" class="hover:text-coklat-tua transition">Pesan Sekarang</a>
        <span class="text-gray-400">/</span>
        <span class="text-gray-700 font-medium">Beli Satuan</span>
    </nav>
</div>

<!-- Page Header -->
<section class="relative overflow-hidden bg-gradient-to-br from-krem via-white to-oranye-pastel/20 py-16 md:py-20">
    <div class="absolute top-0 right-0 w-72 h-72 bg-oranye-pastel/20 blob opacity-40"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-coklat-muda/20 blob opacity-30" style="animation:float 7s ease-in-out 1s infinite"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-center">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-oranye-pastel/40 text-coklat-tua rounded-full text-sm font-medium mb-4 border border-oranye/20">
            <i class="fas fa-utensils text-oranye text-xs"></i> Katalog
        </span>

        <h1 class="text-4xl md:text-5xl font-extrabold text-coklat-tua mb-3">
            Daftar Produk
        </h1>

        <p class="text-gray-400 max-w-lg mx-auto">
            Temukan berbagai kue basah lezat pilihanmu
        </p>
    </div>
</section>

<section class="py-12 bg-krem min-h-screen relative">
    <div class="absolute top-0 left-0 w-64 h-64 bg-oranye-pastel/10 blob opacity-30"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

        <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-sm mb-10 border border-coklat-muda/20">
            <form action="<?php echo base_url('produk'); ?>" method="get" class="flex flex-col md:flex-row gap-4">

                <div class="flex-1 relative group">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                    <input
                        type="text"
                        name="q"
                        value="<?php echo $keyword; ?>"
                        placeholder="Cari produk..."
                        class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30">
                </div>

                <select name="kategori" class="px-4 py-3.5 rounded-xl border border-coklat-muda/30 bg-krem/30">
                    <option value="">Semua Kategori</option>

                    <?php foreach($kategori as $k): ?>
                        <option value="<?php echo $k->id_kategori; ?>"
                            <?php echo $id_kategori == $k->id_kategori ? 'selected' : ''; ?>>
                            <?php echo $k->nama_kategori; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button type="submit"
                    class="px-8 py-3.5 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl">
                    Cari
                </button>
            </form>
        </div>

        <?php if(empty($produk)): ?>

            <div class="text-center py-20">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">
                    Produk tidak ditemukan
                </h3>

                <p class="text-gray-400">
                    Coba kata kunci atau kategori lain
                </p>
            </div>

        <?php else: ?>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <?php foreach($produk as $p): ?>

                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">

                        <div class="aspect-[4/3] bg-gradient-to-br from-coklat-muda/20 to-krem flex items-center justify-center relative overflow-hidden">

                            <?php if($p->gambar && file_exists(FCPATH . 'assets/upload/'.$p->gambar)): ?>
                                <img src="<?php echo base_url('assets/upload/'.$p->gambar); ?>"
                                     alt="<?php echo $p->nama_produk; ?>"
                                     class="w-full h-full object-cover">
                            <?php else: ?>
                                <i class="fas fa-cookie-bite text-6xl text-coklat-tua/15"></i>
                            <?php endif; ?>

                        </div>

                        <div class="p-5">
                            <h3 class="font-bold text-gray-800 mb-1">
                                <?php echo $p->nama_produk; ?>
                            </h3>

                            <p class="text-sm text-gray-400 mb-3">
                                Rasa <?php echo $p->rasa; ?>
                                •
                                Stok <?php echo $p->stok; ?>
                            </p>

                            <div class="flex items-center justify-between">
                                <span class="text-coklat-tua font-bold text-lg">
                                    Rp <?php echo number_format($p->harga,0,',','.'); ?>
                                </span>

                                <a href="<?php echo base_url('produk/pesan/'.$p->id_produk); ?>"
                                   class="px-4 py-2 bg-coklat-tua text-white rounded-lg text-sm font-semibold hover:bg-coklat transition flex items-center gap-2">
                                    <i class="fas fa-shopping-bag text-xs"></i> Pesan
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