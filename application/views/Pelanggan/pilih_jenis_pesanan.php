<?php $this->load->view('templates/header_pelanggan'); ?>

<!-- Breadcrumb -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
    <nav class="flex items-center gap-2 text-sm text-text-muted">
        <a href="<?php echo base_url('home'); ?>" class="hover:text-primary transition-colors duration-200">Beranda</a>
        <span class="text-text-subtle">/</span>
        <a href="<?php echo base_url('pesanan/'); ?>" class="hover:text-primary transition-colors duration-200">Pesan Sekarang</a>
        <span class="text-text-subtle">/</span>
        <span class="text-text-main font-medium">Pilih Jenis Pesanan</span>
    </nav>
</div>

<!-- Hero / Header -->
<section class="py-10 md:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="absolute -top-16 -left-10 w-72 h-72 bg-secondary-light/25 rounded-[2rem] blur-2xl"></div>
        <div class="absolute -bottom-20 -right-10 w-96 h-96 bg-primary/10 rounded-[3rem] blur-2xl"></div>

        <div class="relative z-10 text-center">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-background text-primary rounded-full text-sm font-medium mb-5 border border-border-subtle/20">
                <i class="fas fa-utensils text-accent"></i> Ningnong Order
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-text-main mb-3 font-heading">
                Pilih Jenis Pesanan
            </h1>
            <p class="text-text-muted max-w-2xl mx-auto">
                Tentukan tipe pesananmu dulu. Setelah itu kamu akan diarahkan ke halaman produk untuk mulai belanja.
            </p>
        </div>

        <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-4 gap-6 relative z-10">
            <!-- Beli Satuan -->
            <a href="<?php echo base_url('produk'); ?>" class="group bg-surface/80 backdrop-blur-sm rounded-3xl p-6 border border-border-subtle/20 shadow-sm hover:shadow-xl transition-all duration-200 card-hover">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary to-primary-hover flex items-center justify-center text-white mb-4 shadow-lg shadow-primary/20">
                    <i class="fas fa-shopping-bag text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-text-main mb-2 font-heading">Beli Satuan</h3>
                <p class="text-sm text-text-muted leading-relaxed">
                    Produk reguler yang bisa dibeli satuan. Tambahkan ke keranjang belanja.
                </p>
                <div class="mt-5 flex items-center gap-2 text-primary font-semibold group-hover:translate-x-1 transition-transform duration-200">
                    Pilih
                    <i class="fas fa-arrow-right text-sm"></i>
                </div>
            </a>

            <!-- Snack Box -->
            <a href="<?php echo base_url('pesanan/snack_box_builder'); ?>" class="group bg-surface/80 backdrop-blur-sm rounded-3xl p-6 border border-border-subtle/20 shadow-sm hover:shadow-xl transition-all duration-200 card-hover">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-secondary to-secondary-light flex items-center justify-center text-white mb-4 shadow-lg shadow-secondary/20">
                    <i class="fas fa-box-open text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-text-main mb-2 font-heading">Snack Box</h3>
                <p class="text-sm text-text-muted leading-relaxed">
                    Paket snack box. Susun isi box sesuai pilihanmu di builder.
                </p>
                <div class="mt-5 flex items-center gap-2 text-primary font-semibold group-hover:translate-x-1 transition-transform duration-200">
                    Pilih
                    <i class="fas fa-arrow-right text-sm"></i>
                </div>
            </a>

            <!-- Catering -->
            <a href="<?php echo base_url('catering'); ?>" class="group bg-surface/80 backdrop-blur-sm rounded-3xl p-6 border border-border-subtle/20 shadow-sm hover:shadow-xl transition-all duration-200 card-hover">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-green-500 to-green-400 flex items-center justify-center text-white mb-4 shadow-lg shadow-green-500/20">
                    <i class="fas fa-people-group text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-text-main mb-2 font-heading">Catering</h3>
                <p class="text-sm text-text-muted leading-relaxed">
                    Paket catering. Pilih jumlah porsi dan tanggal pemesanan.
                </p>
                <div class="mt-5 flex items-center gap-2 text-primary font-semibold group-hover:translate-x-1 transition-transform duration-200">
                    Pilih
                    <i class="fas fa-arrow-right text-sm"></i>
                </div>
            </a>

            <!-- Nyiru / Tampah -->
            <a href="<?php echo base_url('nyiru'); ?>" class="group bg-surface/80 backdrop-blur-sm rounded-3xl p-6 border border-border-subtle/20 shadow-sm hover:shadow-xl transition-all duration-200 card-hover">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary/80 to-primary flex items-center justify-center text-white mb-4 shadow-lg shadow-primary/20">
                    <i class="fas fa-bowl-food text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-text-main mb-2 font-heading">Nyiru / Tampah</h3>
                <p class="text-sm text-text-muted leading-relaxed">
                    Paket untuk acara. Pilih ukuran, jumlah, dan tanggal acara.
                </p>
                <div class="mt-5 flex items-center gap-2 text-primary font-semibold group-hover:translate-x-1 transition-transform duration-200">
                    Pilih
                    <i class="fas fa-arrow-right text-sm"></i>
                </div>
            </a>
        </div>

        <div class="mt-8 text-center text-xs text-text-subtle">
            * Klik "Pilih" untuk mulai memesan sesuai jenis yang diinginkan.
        </div>
    </div>
</section>

<?php $this->load->view('templates/footer_pelanggan'); ?>
