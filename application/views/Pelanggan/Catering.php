<?php $this->load->view('templates/header_pelanggan'); ?>


<section class="py-12 bg-background min-h-screen relative overflow-hidden">
    <div class="absolute top-10 right-0 w-72 h-72 bg-secondary-light/15 blob opacity-30"></div>
    <div class="absolute bottom-10 left-0 w-72 h-72 bg-primary/10 blob opacity-30"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-text-muted mb-8">
            <a href="<?php echo base_url('home'); ?>" class="hover:text-primary transition-colors duration-200">Beranda</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="<?php echo base_url('pesanan/pilih_jenis'); ?>" class="hover:text-primary transition-colors duration-200">Pesan Sekarang</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-primary font-medium">Catering</span>
        </div>

        <!-- Header -->
        <div class="text-center mb-12">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-secondary-light/50 text-primary rounded-full text-sm font-medium mb-4 border border-secondary/20">
                <i class="fas fa-box-open text-accent text-xs"></i> Catering Nasi Kotak
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-text-main mb-3 font-heading">Paket Catering Kami</h1>
            <p class="text-text-muted max-w-lg mx-auto">Nikmati hidangan nasi kotak praktis untuk berbagai acara spesial Anda</p>
        </div>

        <?php if(!empty($paket)): ?>
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6">
            <?php foreach($paket as $p): ?>
            <div class="group">
                <div class="bg-surface rounded-2xl sm:rounded-3xl border border-border-subtle/20 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-primary/15 transition-all duration-200 hover:-translate-y-1">
                    <!-- Foto -->
                    <div class="relative aspect-square sm:h-52 overflow-hidden bg-gradient-to-br from-background to-primary/10">
                        <?php if($p->foto && $p->foto != 'default.jpg' && file_exists(FCPATH . 'assets/upload/'.$p->foto)): ?>
                            <img src="<?php echo base_url('assets/upload/'.$p->foto); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-box-open text-3xl sm:text-5xl text-primary/20"></i>
                                    <p class="text-[10px] sm:text-xs text-primary/30 mt-1 sm:mt-2"><?php echo $p->nama_paket; ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- Badge porsi -->
                        <div class="absolute top-2 right-2 sm:top-3 sm:right-3 bg-surface/90 backdrop-blur-sm px-2 py-0.5 sm:px-3 sm:py-1 rounded-full text-[10px] sm:text-xs font-semibold text-primary shadow-sm border border-border-subtle/20">
                            <i class="fas fa-users mr-0.5 sm:mr-1"></i> <?php echo $p->porsi; ?> porsi
                        </div>
                    </div>

                    <!-- Konten -->
                    <div class="p-2 sm:p-4">
                        <h3 class="font-semibold text-sm sm:text-lg text-text-main mb-1 sm:mb-2 font-heading"><?php echo $p->nama_paket; ?></h3>

                        <!-- Isi Paket -->
                        <div class="mb-2 sm:mb-4">
                            <p class="text-[10px] sm:text-xs font-semibold text-text-muted uppercase tracking-wider mb-0.5 sm:mb-1.5">Isi Paket</p>
                            <p class="text-[10px] sm:text-xs text-text-muted line-clamp-2">
                                <?php echo str_replace('+', ', ', $p->isi_paket); ?>
                            </p>
                        </div>

                        <!-- Harga -->
                        <div class="flex items-center justify-between pt-2 sm:pt-3 border-t border-border-subtle/20">
                            <div>
                                <p class="text-[10px] sm:text-xs text-text-subtle">Harga per paket</p>
                                <p class="font-extrabold text-sm sm:text-xl text-primary">Rp <?php echo number_format($p->harga, 0, ',', '.'); ?></p>
                            </div>
                            <a href="<?php echo base_url('catering_kustom/index/'.$p->id); ?>" class="px-2 py-1 sm:px-4 sm:py-2.5 bg-primary text-white rounded-full font-semibold text-[10px] sm:text-sm hover:bg-primary-hover transition-all duration-200 hover:scale-[1.02] flex items-center gap-0.5 sm:gap-1.5 shadow-md shadow-primary/20">
                                <i class="fas fa-pen text-[10px] sm:text-xs"></i> <span class="hidden sm:inline">Kustomisasi Paket</span><span class="sm:hidden">Kustom</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <!-- Empty state -->
        <div class="text-center py-20">
            <div class="w-24 h-24 bg-gradient-to-br from-primary/10 to-accent-light/40 rounded-full flex items-center justify-center mx-auto mb-5 shadow-inner">
                <i class="fas fa-box-open text-4xl text-primary/30"></i>
            </div>
            <h3 class="text-xl font-bold text-text-main mb-2">Belum Ada Paket Catering</h3>
            <p class="text-text-muted">Saat ini belum tersedia paket catering. Silakan cek kembali nanti.</p>
        </div>
        <?php endif; ?>
    </div>
</section>


<?php $this->load->view('templates/footer_pelanggan'); ?>
