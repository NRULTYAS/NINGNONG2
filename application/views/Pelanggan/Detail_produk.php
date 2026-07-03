<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-12 bg-background min-h-screen relative overflow-hidden">
    <div class="absolute top-20 right-0 w-96 h-96 bg-secondary-light/15 blob opacity-30"></div>
    <div class="absolute bottom-20 left-0 w-72 h-72 bg-primary/10 blob opacity-30" style="animation:float 8s ease-in-out 1s infinite"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-text-muted mb-8">
            <a href="<?php echo base_url('home'); ?>" class="hover:text-primary transition-colors duration-200">Beranda</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="<?php echo base_url('produk'); ?>" class="hover:text-primary transition-colors duration-200">Produk</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-primary font-medium"><?php echo $produk->nama_produk; ?></span>
        </div>

        <div class="grid md:grid-cols-2 gap-12 mb-20">
            <!-- Gambar -->
            <div class="relative">
                <div class="bg-surface/80 backdrop-blur-sm rounded-[2rem] p-6 md:p-10 flex items-center justify-center border border-border-subtle/20 shadow-xl shadow-primary/5">
                    <div class="aspect-square w-full max-w-md bg-gradient-to-br from-primary/10 to-background rounded-2xl flex items-center justify-center overflow-hidden relative group">
                        <?php if($produk->gambar && file_exists(FCPATH . 'assets/upload/'.$produk->gambar)): ?>
                        <img src="<?php echo base_url('assets/upload/'.$produk->gambar); ?>" alt="<?php echo $produk->nama_produk; ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        <?php else: ?>
                        <i class="fas fa-cookie-bite text-9xl text-primary/15"></i>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Info -->
            <div class="flex flex-col justify-center">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-secondary-light/40 text-primary rounded-full text-sm font-medium mb-5 border border-secondary/20 w-fit">
                    <i class="fas fa-tag text-accent text-xs"></i> <?php echo $produk->nama_kategori; ?>
                </span>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-text-main mb-5 leading-tight font-heading"><?php echo $produk->nama_produk; ?></h1>
                <p class="text-text-muted mb-8 leading-relaxed text-lg"><?php echo $produk->deskripsi ?: 'Deskripsi produk belum tersedia.'; ?></p>

                <div class="grid grid-cols-3 gap-4 mb-8">
                    <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-4 border border-border-subtle/20 text-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-secondary to-secondary-light rounded-xl flex items-center justify-center text-white mx-auto mb-2 shadow-md shadow-secondary/20">
                            <i class="fas fa-cookie text-sm"></i>
                        </div>
                        <p class="text-xs text-text-subtle mb-0.5">Rasa</p>
                        <p class="font-semibold text-primary text-sm"><?php echo $produk->rasa; ?></p>
                    </div>
                    <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-4 border border-border-subtle/20 text-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-500 rounded-xl flex items-center justify-center text-white mx-auto mb-2 shadow-md shadow-green-500/20">
                            <i class="fas fa-box text-sm"></i>
                        </div>
                        <p class="text-xs text-text-subtle mb-0.5">Stok</p>
                        <p class="font-semibold text-primary text-sm"><?php echo $produk->stok; ?> tersedia</p>
                    </div>
                    <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-4 border border-border-subtle/20 text-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary to-primary-hover rounded-xl flex items-center justify-center text-white mx-auto mb-2 shadow-md shadow-primary/20">
                            <i class="fas fa-fire text-sm"></i>
                        </div>
                        <p class="text-xs text-text-subtle mb-0.5">Fresh</p>
                        <p class="font-semibold text-primary text-sm">100% Baru</p>
                    </div>
                </div>

                <div class="mb-8">
                    <p class="text-sm text-text-subtle mb-1">Harga</p>
                    <p class="text-4xl md:text-5xl font-extrabold text-primary">Rp <?php echo number_format($produk->harga,0,',','.'); ?></p>
                </div>

                <?php if($this->session->userdata('id_user') && $this->session->userdata('role') != 'admin'): ?>
                <form action="<?php echo base_url('keranjang/tambah'); ?>" method="post" class="flex gap-4">
                    <input type="hidden" name="id_produk" value="<?php echo $produk->id_produk; ?>">
                    <div class="flex items-center bg-surface rounded-xl border border-border-subtle/30 shadow-sm">
                        <button type="button" onclick="this.parentElement.querySelector('input').stepDown()" class="px-4 py-3.5 text-text-subtle hover:text-primary transition-colors duration-200"><i class="fas fa-minus text-xs"></i></button>
                        <input type="number" name="jumlah" value="1" min="1" max="<?php echo $produk->stok; ?>" class="w-16 text-center font-bold border-x border-border-subtle/30 py-3.5 focus:outline-none text-primary">
                        <button type="button" onclick="this.parentElement.querySelector('input').stepUp()" class="px-4 py-3.5 text-text-subtle hover:text-primary transition-colors duration-200"><i class="fas fa-plus text-xs"></i></button>
                    </div>
                    <button type="submit" <?php echo $produk->stok == 0 ? 'disabled' : ''; ?> class="flex-1 px-8 py-3.5 bg-primary text-white rounded-full font-medium hover:bg-primary-hover transition-all duration-200 flex items-center justify-center gap-2 shadow-md shadow-primary/20 <?php echo $produk->stok == 0 ? 'opacity-50 cursor-not-allowed' : ''; ?>">
                        <i class="fas fa-shopping-bag"></i> Tambah ke Keranjang
                    </button>
                </form>
                <?php else: ?>
                <a href="<?php echo base_url('auth/login'); ?>" class="inline-flex items-center gap-2 px-8 py-3.5 bg-primary text-white rounded-full font-medium hover:bg-primary-hover transition-all duration-200">
                    <i class="fas fa-sign-in-alt"></i> Masuk untuk Pesan
                </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Rekomendasi -->
        <?php if(!empty($rekomendasi)): ?>
        <div class="border-t border-secondary/30 pt-16">
            <div class="text-center mb-12">
                <span class="inline-block px-4 py-1 bg-surface text-primary rounded-full text-sm font-medium mb-3">Rekomendasi</span>
                <h2 class="text-3xl font-bold text-text-main mb-2 font-heading">Produk Serupa</h2>
                <p class="text-text-muted">Rekomendasi berdasarkan kategori, rasa, dan harga</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach($rekomendasi as $r): $p = $r['produk']; ?>
                <a href="<?php echo base_url('produk/detail/'.$p->id_produk); ?>" class="bg-surface rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-200 border border-border-subtle/10 group card-hover">
                    <div class="product-card-image-wrapper bg-gradient-to-br from-primary/10 to-background">
                        <?php if($p->gambar && file_exists(FCPATH . 'assets/upload/'.$p->gambar)): ?>
                        <img src="<?php echo base_url('assets/upload/'.$p->gambar); ?>" alt="<?php echo $p->nama_produk; ?>" class="product-card-image group-hover:scale-110 transition duration-700">
                        <?php else: ?>
                        <i class="fas fa-cookie-bite text-5xl text-primary/15"></i>
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/10 transition duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-text-main mb-1 group-hover:text-primary transition-colors duration-200"><?php echo $p->nama_produk; ?></h3>
                        <p class="text-sm text-text-muted mb-2">Rasa <?php echo $p->rasa; ?></p>
                        <p class="text-primary font-bold text-lg">Rp <?php echo number_format($p->harga,0,',','.'); ?></p>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php $this->load->view('templates/footer_pelanggan'); ?>