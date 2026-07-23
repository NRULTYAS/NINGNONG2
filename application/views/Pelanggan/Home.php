<?php $this->load->view('templates/header_pelanggan'); ?>

<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-background via-surface to-secondary-light/20 py-20 md:py-28">
    <!-- Decorative blobs -->
    <div class="absolute top-10 left-10 w-72 h-72 bg-secondary-light/40 blob animate-float opacity-40"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-primary/10 blob animate-float-delay opacity-30"></div>
    <div class="absolute top-1/2 left-1/2 w-48 h-48 bg-secondary/10 blob opacity-20" style="animation:float 8s ease-in-out 1s infinite"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="relative z-10">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-secondary-light/80 text-primary rounded-full text-sm font-medium mb-6 border border-secondary/30">
                    <i class="fas fa-star text-accent text-xs"></i> Kue Basah Tradisional
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-text-main leading-tight mb-6 font-heading">
                    Nikmati Kelezatan<br>
                    <span class="relative inline-block">
                        Kue Basah
                        <span class="absolute -bottom-1 left-0 w-full h-3 bg-secondary-light/60 -z-10 rounded-full"></span>
                    </span>
                    <span class="bg-gradient-to-r from-primary via-secondary to-primary bg-clip-text text-transparent"> Asli Indonesia</span>
                </h1>
                <p class="text-text-muted text-lg mb-8 leading-relaxed max-w-lg">Dibuat dengan resep turun-temurun menggunakan bahan-bahan pilihan berkualitas tinggi. Rasakan kelezatan yang tak terlupakan.</p>
                <div class="flex flex-row gap-3">
                    <?php
                        $id_user = $this->session->userdata('id_user');
                        $role = $this->session->userdata('role');

                        if (empty($id_user) || empty($role)) {
                    ?>
                        <a href="<?php echo base_url('produk'); ?>" class="px-5 py-2.5 bg-gradient-to-r from-primary to-primary-hover text-white rounded-full font-medium hover:shadow-xl hover:shadow-primary/25 transition-all duration-200 flex items-center gap-2 shadow-md shadow-primary/20 text-sm">
                            <i class="fas fa-shopping-bag text-sm"></i> Lihat Produk
                        </a>
                        <a href="<?php echo base_url('auth/register'); ?>" class="px-5 py-2.5 border-2 border-primary/30 text-primary rounded-full font-medium hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 text-sm">Daftar Sekarang</a>
                    <?php
                        } elseif ($role === 'pelanggan') {
                    ?>
                        <a href="<?php echo base_url('pesanan/pilih_jenis'); ?>" class="px-5 py-2.5 bg-gradient-to-r from-primary to-primary-hover text-white rounded-full font-medium hover:shadow-xl hover:shadow-primary/25 transition-all duration-200 flex items-center gap-2 shadow-md shadow-primary/20 text-sm">
                            <i class="fas fa-shopping-bag text-sm"></i> Pesan Sekarang
                        </a>
                        <a href="https://wa.me/<?php echo NOMOR_WA_PENJUAL; ?>?text=<?php echo urlencode('Halo, saya ingin tanya-tanya tentang produk NINGNONG Kue Basah'); ?>" target="_blank" class="px-5 py-2.5 bg-[#25D366] text-white rounded-full font-medium hover:bg-[#1da851] hover:shadow-lg hover:shadow-black/10 transition-all duration-200 flex items-center gap-2 shadow-md shadow-[#25D366]/30 text-sm">
                            <i class="fab fa-whatsapp text-sm"></i> Chat WhatsApp
                        </a>
                    <?php
                        } elseif ($role === 'admin') {
                    ?>
                        <a href="<?php echo base_url('admin/dashboard'); ?>" class="px-5 py-2.5 bg-gradient-to-r from-primary to-primary-hover text-white rounded-full font-medium hover:shadow-xl hover:shadow-primary/25 transition-all duration-200 flex items-center gap-2 shadow-md shadow-primary/20 text-sm">
                            <i class="fas fa-tachometer-alt text-sm"></i> Dashboard Admin
                        </a>
                        <a href="<?php echo base_url('admin/produk'); ?>" class="px-5 py-2.5 border-2 border-primary/30 text-primary rounded-full font-medium hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 text-sm">Kelola Produk</a>
                    <?php
                        } else {
                            // fallback jika role tidak dikenali: tampilkan tombol daftar
                    ?>
                        <a href="<?php echo base_url('produk'); ?>" class="px-5 py-2.5 bg-gradient-to-r from-primary to-primary-hover text-white rounded-full font-medium hover:shadow-xl hover:shadow-primary/25 transition-all duration-200 flex items-center gap-2 shadow-md shadow-primary/20 text-sm">
                            <i class="fas fa-shopping-bag text-sm"></i> Lihat Produk
                        </a>
                        <a href="<?php echo base_url('auth/register'); ?>" class="px-5 py-2.5 border-2 border-primary/30 text-primary rounded-full font-medium hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 text-sm">Daftar Sekarang</a>
                    <?php } ?>
                </div>
                <!-- Stats -->
                <div class="flex gap-8 mt-10">
                    <div>
                        <p class="text-2xl font-bold text-primary">500+</p>
                        <p class="text-sm text-text-subtle">Pelanggan</p>
                    </div>
                    <div class="w-px bg-secondary/30"></div>
                    <div>
                        <p class="text-2xl font-bold text-primary">50+</p>
                        <p class="text-sm text-text-subtle">Menu Kue</p>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="aspect-square rounded-[2rem] overflow-hidden border border-white/50 shadow-2xl shadow-primary/10">
                    <img
src="<?php echo base_url('assets/img/images-40-2.jpeg'); ?>"
                        alt="Hero Produk"
                        class="w-full h-full object-cover"
                    />
                    <div class="absolute inset-0 bg-gradient-to-tr from-secondary-light/20 to-transparent"></div>

                    <!-- Floating badges -->
                    <div class="absolute -bottom-2 -left-2 md:bottom-8 md:left-8 bg-surface rounded-2xl shadow-xl p-4 flex items-center gap-3 animate-float border border-border-subtle/10">

                        <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-green-500/30">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-text-main text-sm">100% Alami</p>
                            <p class="text-xs text-text-subtle">Bahan Berkualitas</p>
                        </div>
                    </div>
                    <div class="absolute -top-2 -right-2 md:top-8 md:right-8 bg-surface rounded-2xl shadow-xl p-4 flex items-center gap-3 animate-float-delay border border-border-subtle/10">
                        <div class="w-12 h-12 bg-gradient-to-br from-accent to-accent-hover rounded-xl flex items-center justify-center text-white shadow-lg shadow-accent/30">
                            <i class="fas fa-fire"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-text-main text-sm">Fresh Daily</p>
                            <p class="text-xs text-text-subtle">Dibuat Pagi Hari</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Kategori Section -->
<section class="py-20 bg-surface relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1 bg-background text-primary rounded-full text-sm font-medium mb-3">Kategori</span>
            <h2 class="text-3xl md:text-4xl font-bold text-text-main mb-3 font-heading">Kategori Kue Kami</h2>
            <p class="text-text-muted max-w-md mx-auto">Pilih kue favoritmu dari berbagai kategori pilihan</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 max-w-5xl mx-auto">
            <?php $icons = ['fa-cookie','fa-cookie-bite','fa-ice-cream','fa-stroopwafel','fa-candy-cane','fa-lemon']; $ci=0; ?>
            <?php foreach($kategori as $k): ?>
            <a href="<?php echo base_url('produk?kategori='.$k->id_kategori); ?>" class="group card-hover">
                <div class="bg-background/80 rounded-2xl p-6 text-center hover:bg-gradient-to-br hover:from-primary hover:to-primary-hover transition-all duration-200 border border-border-subtle hover:border-transparent hover:shadow-xl hover:shadow-primary/15">
                    <div class="w-14 h-14 mx-auto bg-primary/10 rounded-2xl flex items-center justify-center mb-3 group-hover:bg-white/20 transition text-primary group-hover:text-white">
                        <i class="fas <?php echo $icons[$ci % count($icons)]; ?> text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-text-main group-hover:text-white transition text-sm"><?php echo $k->nama_kategori; ?></h3>
                </div>
            </a>
            <?php $ci++; endforeach; ?>
        </div>
    </div>
</section>

<!-- Produk Terbaru -->
<section class="py-20 bg-background relative">
    <div class="absolute top-0 right-0 w-64 h-64 bg-secondary-light/20 blob opacity-40"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="flex flex-wrap justify-between items-end mb-12 gap-4">
            <div>
                <span class="inline-block px-4 py-1 bg-surface text-primary rounded-full text-sm font-medium mb-3">Terbaru</span>
                <h2 class="text-3xl md:text-4xl font-bold text-text-main mb-2 font-heading">Produk Terbaru</h2>
                <p class="text-text-muted">Kue basah segar yang baru saja tersedia</p>
            </div>
            <a href="<?php echo base_url('produk'); ?>" class="group flex items-center gap-2 text-primary font-medium hover:gap-3 transition-all duration-200">
                Lihat Semua <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
<div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
             <?php foreach($produk_terbaru as $p): ?>
             <div class="bg-surface rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-200 group border border-border-subtle/10 card-hover">
                 <div class="product-card-image-wrapper bg-gradient-to-br from-primary/10 to-background aspect-square">
                     <?php if($p->gambar && file_exists(FCPATH . 'assets/upload/'.$p->gambar)): ?>
                     <img src="<?php echo base_url('assets/upload/'.$p->gambar); ?>" alt="<?php echo $p->nama_produk; ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                     <?php else: ?>
                     <i class="fas fa-cookie-bite text-5xl text-primary/15"></i>
                     <?php endif; ?>
                     <span class="absolute top-2 left-2 bg-primary/80 backdrop-blur-sm text-white text-[10px] px-2 py-0.5 rounded-lg font-medium tracking-wide uppercase"><?php echo $p->nama_kategori; ?></span>
                     <?php if($p->stok <= 5 && $p->stok > 0): ?>
                     <span class="absolute top-2 right-2 bg-red-500/90 backdrop-blur-sm text-white text-[10px] px-2 py-0.5 rounded-lg font-medium">Stok Menipis!</span>
                     <?php endif; ?>
                     <!-- Quick view overlay -->
                     <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/10 transition duration-300 flex items-center justify-center">
                         <a href="<?php echo base_url('produk/detail/'.$p->id_produk); ?>" class="w-8 h-8 md:w-11 md:h-11 bg-surface rounded-xl flex items-center justify-center text-primary shadow-lg opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:bg-primary hover:text-white">
                             <i class="fas fa-eye text-xs md:text-sm"></i>
                         </a>
                     </div>
                 </div>
                 <div class="p-2 md:p-4">
                     <h3 class="font-bold text-text-main mb-1 group-hover:text-primary transition text-sm md:text-base"><?php echo $p->nama_produk; ?></h3>
                     <p class="text-xs md:text-sm text-text-muted mb-2">Rasa <?php echo $p->rasa; ?></p>
                     <div class="flex items-center justify-between">
                         <span class="text-primary font-bold text-sm md:text-lg">Rp <?php echo number_format($p->harga,0,',','.'); ?></span>
                         <?php if($p->stok > 0): ?>
                         <span class="text-[10px] md:text-xs text-green-600 bg-green-50 px-1.5 md:px-2 py-0.5 md:py-1 rounded-lg font-medium">Tersedia</span>
                         <?php else: ?>
                         <span class="text-[10px] md:text-xs text-text-subtle bg-background px-1.5 md:px-2 py-0.5 md:py-1 rounded-lg font-medium">Habis</span>
                         <?php endif; ?>
                     </div>
                 </div>
             </div>
             <?php endforeach; ?>
         </div>
    </div>
</section>

<!-- Keunggulan -->
<section class="py-10 md:py-20 bg-surface relative overflow-hidden">
    <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-background blob opacity-50"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-8 md:mb-14">
            <span class="inline-block px-4 py-1 bg-background text-primary rounded-full text-sm font-medium mb-3">Keunggulan</span>
            <h2 class="text-2xl md:text-3xl font-bold text-text-main mb-2 md:mb-3 font-heading">Mengapa Memilih Kami?</h2>
            <p class="text-text-muted max-w-md mx-auto text-sm md:text-base">Komitmen kami untuk memberikan yang terbaik</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-8">
            <div class="text-center p-4 md:p-10 bg-gradient-to-br from-background to-surface rounded-2xl md:rounded-3xl border border-border-subtle card-hover group">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-green-400 to-green-500 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-5 text-white shadow-md md:shadow-lg shadow-green-500/20 md:shadow-green-500/25 group-hover:shadow-green-500/40 transition duration-200">
                    <i class="fas fa-leaf text-lg md:text-2xl"></i>
                </div>
                <h3 class="font-bold text-base md:text-xl mb-1 md:mb-2 text-text-main font-heading">Bahan Alami</h3>
                <p class="text-xs md:text-sm text-text-muted leading-snug md:leading-relaxed">Hanya menggunakan bahan-bahan alami tanpa pengawet berbahaya untuk keluarga tercinta</p>
            </div>
            <div class="text-center p-4 md:p-10 bg-gradient-to-br from-background to-surface rounded-2xl md:rounded-3xl border border-border-subtle card-hover group">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-secondary to-secondary-light rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-5 text-white shadow-md md:shadow-lg shadow-secondary/20 md:shadow-secondary/25 group-hover:shadow-secondary/40 transition duration-200">
                    <i class="fas fa-truck text-lg md:text-2xl"></i>
                </div>
                <h3 class="font-bold text-base md:text-xl mb-1 md:mb-2 text-text-main font-heading">Pengiriman Cepat</h3>
                <p class="text-xs md:text-sm text-text-muted leading-snug md:leading-relaxed">Pesanan dikirim dalam kondisi terbaik dan tepat waktu langsung ke pintu rumahmu</p>
            </div>
            <!-- Wrapper untuk card ke-3 agar ditengahkan di mobile -->
            <div class="col-span-2 flex justify-center md:contents">
                <div class="text-center p-4 md:p-10 bg-gradient-to-br from-background to-surface rounded-2xl md:rounded-3xl border border-border-subtle card-hover group w-full max-w-[calc(50%-0.375rem)] md:w-auto">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-primary to-primary-hover rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-5 text-white shadow-md md:shadow-lg shadow-primary/20 md:shadow-primary/25 group-hover:shadow-primary/40 transition duration-200">
                        <i class="fas fa-heart text-lg md:text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-base md:text-xl mb-1 md:mb-2 text-text-main font-heading">Dibuat dengan Cinta</h3>
                    <p class="text-xs md:text-sm text-text-muted leading-snug md:leading-relaxed">Setiap kue dibuat dengan penuh perhatian dan cinta menggunakan resep turun-temurun</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <?php $this->load->view('templates/footer_pelanggan'); ?>
