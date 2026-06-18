<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-12 bg-krem min-h-screen relative overflow-hidden">
    <div class="absolute top-20 right-0 w-96 h-96 bg-oranye-pastel/15 blob opacity-30"></div>
    <div class="absolute bottom-20 left-0 w-72 h-72 bg-coklat-muda/15 blob opacity-30" style="animation:float 8s ease-in-out 1s infinite"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-gray-400 mb-8">
            <a href="<?php echo base_url('home'); ?>" class="hover:text-coklat-tua transition">Beranda</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="<?php echo base_url('produk'); ?>" class="hover:text-coklat-tua transition">Produk</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-coklat-tua font-medium"><?php echo $produk->nama_produk; ?></span>
        </div>

        <div class="grid md:grid-cols-2 gap-12 mb-20">
            <!-- Gambar -->
            <div class="relative">
                <div class="bg-white/80 backdrop-blur-sm rounded-[2rem] p-6 md:p-10 flex items-center justify-center border border-coklat-muda/20 shadow-xl shadow-coklat/5">
                    <div class="aspect-square w-full max-w-md bg-gradient-to-br from-coklat-muda/20 to-krem rounded-2xl flex items-center justify-center overflow-hidden relative group">
                        <?php if($produk->gambar && file_exists(FCPATH . 'assets/upload/'.$produk->gambar)): ?>
                        <img src="<?php echo base_url('assets/upload/'.$produk->gambar); ?>" alt="<?php echo $produk->nama_produk; ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        <?php else: ?>
                        <i class="fas fa-cookie-bite text-9xl text-coklat-tua/15"></i>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Floating badge -->
                <div class="absolute -bottom-4 -right-4 md:bottom-4 md:right-4 bg-white rounded-2xl shadow-xl p-4 flex items-center gap-3 animate-float border border-coklat-muda/10">
                    <div class="w-12 h-12 bg-gradient-to-br from-coklat-tua to-coklat rounded-xl flex items-center justify-center text-white shadow-lg shadow-coklat-tua/30">
                        <i class="fas fa-award"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Terlaris</p>
                        <p class="text-xs text-gray-400">Paling Diminati</p>
                    </div>
                </div>
            </div>

            <!-- Info -->
            <div class="flex flex-col justify-center">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-oranye-pastel/40 text-coklat-tua rounded-full text-sm font-medium mb-5 border border-oranye/20 w-fit">
                    <i class="fas fa-tag text-oranye text-xs"></i> <?php echo $produk->nama_kategori; ?>
                </span>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-coklat-tua mb-5 leading-tight"><?php echo $produk->nama_produk; ?></h1>
                <p class="text-gray-400 mb-8 leading-relaxed text-lg"><?php echo $produk->deskripsi ?: 'Deskripsi produk belum tersedia.'; ?></p>

                <div class="grid grid-cols-3 gap-4 mb-8">
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-4 border border-coklat-muda/20 text-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-oranye to-oranye-pastel rounded-xl flex items-center justify-center text-white mx-auto mb-2 shadow-md shadow-oranye/20">
                            <i class="fas fa-cookie text-sm"></i>
                        </div>
                        <p class="text-xs text-gray-400 mb-0.5">Rasa</p>
                        <p class="font-semibold text-coklat-tua text-sm"><?php echo $produk->rasa; ?></p>
                    </div>
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-4 border border-coklat-muda/20 text-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-500 rounded-xl flex items-center justify-center text-white mx-auto mb-2 shadow-md shadow-green-500/20">
                            <i class="fas fa-box text-sm"></i>
                        </div>
                        <p class="text-xs text-gray-400 mb-0.5">Stok</p>
                        <p class="font-semibold text-coklat-tua text-sm"><?php echo $produk->stok; ?> tersedia</p>
                    </div>
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-4 border border-coklat-muda/20 text-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-coklat-tua to-coklat rounded-xl flex items-center justify-center text-white mx-auto mb-2 shadow-md shadow-coklat-tua/20">
                            <i class="fas fa-fire text-sm"></i>
                        </div>
                        <p class="text-xs text-gray-400 mb-0.5">Fresh</p>
                        <p class="font-semibold text-coklat-tua text-sm">100% Baru</p>
                    </div>
                </div>

                <div class="mb-8">
                    <p class="text-sm text-gray-400 mb-1">Harga</p>
                    <p class="text-4xl md:text-5xl font-extrabold text-coklat-tua">Rp <?php echo number_format($produk->harga,0,',','.'); ?></p>
                </div>

                <?php if($this->session->userdata('id_user') && $this->session->userdata('role') != 'admin'): ?>
                <form action="<?php echo base_url('keranjang/tambah'); ?>" method="post" class="flex gap-4">
                    <input type="hidden" name="id_produk" value="<?php echo $produk->id_produk; ?>">
                    <div class="flex items-center bg-white rounded-xl border border-coklat-muda/30 shadow-sm">
                        <button type="button" onclick="this.parentElement.querySelector('input').stepDown()" class="px-4 py-3.5 text-gray-400 hover:text-coklat-tua transition"><i class="fas fa-minus text-xs"></i></button>
                        <input type="number" name="jumlah" value="1" min="1" max="<?php echo $produk->stok; ?>" class="w-16 text-center font-bold border-x border-coklat-muda/30 py-3.5 focus:outline-none text-coklat-tua">
                        <button type="button" onclick="this.parentElement.querySelector('input').stepUp()" class="px-4 py-3.5 text-gray-400 hover:text-coklat-tua transition"><i class="fas fa-plus text-xs"></i></button>
                    </div>
                    <button type="submit" <?php echo $produk->stok == 0 ? 'disabled' : ''; ?> class="flex-1 px-8 py-3.5 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-medium hover:shadow-xl hover:shadow-coklat-tua/25 transition flex items-center justify-center gap-2 <?php echo $produk->stok == 0 ? 'opacity-50 cursor-not-allowed' : ''; ?>">
                        <i class="fas fa-shopping-bag"></i> Tambah ke Keranjang
                    </button>
                </form>
                <?php else: ?>
                <a href="<?php echo base_url('auth/login'); ?>" class="inline-flex items-center gap-2 px-8 py-3.5 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-medium hover:shadow-xl hover:shadow-coklat-tua/25 transition">
                    <i class="fas fa-sign-in-alt"></i> Masuk untuk Pesan
                </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Rekomendasi -->
        <?php if(!empty($rekomendasi)): ?>
        <div class="border-t border-coklat-muda/30 pt-16">
            <div class="text-center mb-12">
                <span class="inline-block px-4 py-1 bg-white text-coklat rounded-full text-sm font-medium mb-3">Rekomendasi</span>
                <h2 class="text-3xl font-bold text-coklat-tua mb-2">Produk Serupa</h2>
                <p class="text-gray-400">Rekomendasi berdasarkan kategori, rasa, dan harga</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach($rekomendasi as $r): $p = $r['produk']; ?>
                <a href="<?php echo base_url('produk/detail/'.$p->id_produk); ?>" class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-coklat-muda/10 group card-hover">
                    <div class="aspect-[4/3] bg-gradient-to-br from-coklat-muda/20 to-krem flex items-center justify-center relative overflow-hidden">
                        <?php if($p->gambar && file_exists(FCPATH . 'assets/upload/'.$p->gambar)): ?>
                        <img src="<?php echo base_url('assets/upload/'.$p->gambar); ?>" alt="<?php echo $p->nama_produk; ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <?php else: ?>
                        <i class="fas fa-cookie-bite text-5xl text-coklat-tua/15"></i>
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-coklat-tua/0 group-hover:bg-coklat-tua/10 transition duration-300"></div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-gray-800 mb-1 group-hover:text-coklat-tua transition"><?php echo $p->nama_produk; ?></h3>
                        <p class="text-sm text-gray-400 mb-2">Rasa <?php echo $p->rasa; ?></p>
                        <p class="text-coklat-tua font-bold text-lg">Rp <?php echo number_format($p->harga,0,',','.'); ?></p>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php $this->load->view('templates/footer_pelanggan'); ?>
<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-12 bg-krem min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-8">
            <a href="<?php echo base_url('home'); ?>" class="hover:text-coklat-tua">Beranda</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="<?php echo base_url('produk'); ?>" class="hover:text-coklat-tua">Produk</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-coklat-tua"><?php echo $produk->nama_produk; ?></span>
        </div>

        <div class="grid md:grid-cols-2 gap-10 mb-16">
            <!-- Gambar -->
            <div class="bg-white rounded-3xl p-8 flex items-center justify-center border border-coklat-muda/20">
                <div class="aspect-square w-full max-w-md bg-coklat-muda/20 rounded-2xl flex items-center justify-center overflow-hidden">
                    <?php if($produk->gambar && file_exists(FCPATH . 'assets/upload/'.$produk->gambar)): ?>
                    <img src="<?php echo base_url('assets/upload/'.$produk->gambar); ?>" alt="<?php echo $produk->nama_produk; ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                    <i class="fas fa-cookie-bite text-9xl text-coklat-tua/20"></i>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Info -->
            <div>
                <span class="inline-block px-4 py-1 bg-oranye-pastel/60 text-coklat-tua rounded-full text-sm font-medium mb-4"><?php echo $produk->nama_kategori; ?></span>
                <h1 class="text-3xl md:text-4xl font-bold text-coklat-tua mb-4"><?php echo $produk->nama_produk; ?></h1>
                <p class="text-gray-500 mb-6 leading-relaxed"><?php echo $produk->deskripsi ?: 'Deskripsi produk belum tersedia.'; ?></p>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-white rounded-xl p-4 border border-coklat-muda/20">
                        <p class="text-sm text-gray-500 mb-1">Rasa</p>
                        <p class="font-semibold text-coklat-tua"><?php echo $produk->rasa; ?></p>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-coklat-muda/20">
                        <p class="text-sm text-gray-500 mb-1">Stok</p>
                        <p class="font-semibold text-coklat-tua"><?php echo $produk->stok; ?> tersedia</p>
                    </div>
                </div>

                <div class="mb-8">
                    <p class="text-sm text-gray-500 mb-1">Harga</p>
                    <p class="text-4xl font-bold text-coklat-tua">Rp <?php echo number_format($produk->harga,0,',','.'); ?></p>
                </div>

                <?php if($this->session->userdata('id_user') && $this->session->userdata('role') != 'admin'): ?>
                <form action="<?php echo base_url('keranjang/tambah'); ?>" method="post" class="flex gap-4">
                    <input type="hidden" name="id_produk" value="<?php echo $produk->id_produk; ?>">
                    <div class="flex items-center bg-white rounded-xl border border-coklat-muda/30">
                        <button type="button" onclick="this.parentElement.querySelector('input').stepDown()" class="px-4 py-3 text-gray-500 hover:text-coklat-tua"><i class="fas fa-minus"></i></button>
                        <input type="number" name="jumlah" value="1" min="1" max="<?php echo $produk->stok; ?>" class="w-16 text-center font-semibold border-x border-coklat-muda/30 py-3 focus:outline-none">
                        <button type="button" onclick="this.parentElement.querySelector('input').stepUp()" class="px-4 py-3 text-gray-500 hover:text-coklat-tua"><i class="fas fa-plus"></i></button>
                    </div>
                    <button type="submit" <?php echo $produk->stok == 0 ? 'disabled' : ''; ?> class="flex-1 px-8 py-3 bg-coklat-tua text-white rounded-xl font-medium hover:bg-coklat transition flex items-center justify-center gap-2 <?php echo $produk->stok == 0 ? 'opacity-50 cursor-not-allowed' : ''; ?>">
                        <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                    </button>
                </form>
                <?php else: ?>
                <a href="<?php echo base_url('auth/login'); ?>" class="inline-block px-8 py-3 bg-coklat-tua text-white rounded-xl font-medium hover:bg-coklat transition">Masuk untuk Pesan</a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Rekomendasi -->
        <?php if(!empty($rekomendasi)): ?>
        <div class="border-t border-coklat-muda/30 pt-12">
            <h2 class="text-2xl font-bold text-coklat-tua mb-2">Produk Serupa</h2>
            <p class="text-gray-500 mb-8">Rekomendasi berdasarkan kategori, rasa, dan harga</p>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach($rekomendasi as $r): $p = $r['produk']; ?>
                <a href="<?php echo base_url('produk/detail/'.$p->id_produk); ?>" class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition border border-coklat-muda/20 group">
                    <div class="aspect-[4/3] bg-coklat-muda/20 flex items-center justify-center relative overflow-hidden">
                        <?php if($p->gambar && file_exists(FCPATH . 'assets/upload/'.$p->gambar)): ?>
                        <img src="<?php echo base_url('assets/upload/'.$p->gambar); ?>" alt="<?php echo $p->nama_produk; ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <?php else: ?>
                        <i class="fas fa-cookie-bite text-5xl text-coklat-tua/20"></i>
                        <?php endif; ?>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800 mb-1"><?php echo $p->nama_produk; ?></h3>
                        <p class="text-sm text-gray-500 mb-2">Rasa <?php echo $p->rasa; ?></p>
                        <p class="text-coklat-tua font-bold">Rp <?php echo number_format($p->harga,0,',','.'); ?></p>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php $this->load->view('templates/footer_pelanggan'); ?>
