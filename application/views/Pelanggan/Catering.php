<?php $this->load->view('templates/header_pelanggan'); ?>


<section class="py-12 bg-krem min-h-screen relative overflow-hidden">
    <div class="absolute top-10 right-0 w-72 h-72 bg-oranye-pastel/15 blob opacity-30"></div>
    <div class="absolute bottom-10 left-0 w-72 h-72 bg-coklat-muda/15 blob opacity-30"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-8">
            <a href="<?php echo base_url('home'); ?>" class="hover:text-coklat-tua transition">Beranda</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-coklat-tua font-medium">Catering</span>
        </div>

        <!-- Header -->
        <div class="text-center mb-12">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-oranye-pastel/40 text-coklat-tua rounded-full text-sm font-medium mb-3 border border-oranye/20">
                <i class="fas fa-box-open text-oranye text-xs"></i> Catering Nasi Kotak
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-coklat-tua mb-2">Paket Catering Kami</h1>
            <p class="text-gray-500 max-w-xl mx-auto">Nikmati hidangan nasi kotak praktis untuk berbagai acara spesial Anda</p>
        </div>

        <?php if(!empty($paket)): ?>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach($paket as $p): ?>
            <div class="group">
                <div class="bg-white rounded-3xl border border-coklat-muda/20 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-coklat-muda/20 transition-all duration-300 hover:-translate-y-1">
                    <!-- Foto -->
                    <div class="relative h-52 overflow-hidden bg-gradient-to-br from-krem to-coklat-muda/20">
                        <?php if($p->foto && $p->foto != 'default.jpg' && file_exists(FCPATH . 'assets/upload/'.$p->foto)): ?>
                            <img src="<?php echo base_url('assets/upload/'.$p->foto); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-box-open text-5xl text-coklat-tua/20"></i>
                                    <p class="text-xs text-coklat-tua/30 mt-2"><?php echo $p->nama_paket; ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- Badge porsi -->
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-coklat-tua shadow-sm border border-coklat-muda/20">
                            <i class="fas fa-users mr-1"></i> <?php echo $p->porsi; ?> porsi
                        </div>
                    </div>

                    <!-- Konten -->
                    <div class="p-5">
                        <h3 class="font-bold text-lg text-gray-800 mb-2"><?php echo $p->nama_paket; ?></h3>
                        
                        <!-- Isi Paket -->
                        <div class="mb-4">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Isi Paket</p>
                            <div class="flex flex-wrap gap-1.5">
                                <?php 
                                $isi_arr = explode('+', $p->isi_paket);
                                foreach($isi_arr as $isi_item): 
                                    $item = trim($isi_item);
                                    if($item):
                                ?>
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-krem rounded-lg text-xs text-gray-600 font-medium border border-coklat-muda/20">
                                    <i class="fas fa-check-circle text-green-500 text-[10px]"></i>
                                    <?php echo $item; ?>
                                </span>
                                <?php 
                                    endif;
                                endforeach; 
                                ?>
                            </div>
                        </div>

                        <!-- Harga -->
                        <div class="flex items-center justify-between pt-3 border-t border-coklat-muda/20">
                            <div>
                                <p class="text-xs text-gray-400">Harga per paket</p>
                                <p class="font-extrabold text-xl text-coklat-tua">Rp <?php echo number_format($p->harga, 0, ',', '.'); ?></p>
                            </div>
                            <a href="<?php echo base_url('catering_kustom/index/'.$p->id); ?>" class="px-4 py-2.5 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-semibold text-sm hover:shadow-lg hover:shadow-coklat-tua/25 transition-all hover:scale-[1.02] flex items-center gap-1.5">
                                <i class="fas fa-pen text-xs"></i> Kustomisasi Paket
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
            <div class="w-24 h-24 bg-gradient-to-br from-coklat-muda/40 to-coklat-susu/40 rounded-full flex items-center justify-center mx-auto mb-5 shadow-inner">
                <i class="fas fa-box-open text-4xl text-coklat-tua/30"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-600 mb-2">Belum Ada Paket Catering</h3>
            <p class="text-gray-400">Saat ini belum tersedia paket catering. Silakan cek kembali nanti.</p>
        </div>
        <?php endif; ?>
    </div>
</section>


<?php $this->load->view('templates/footer_pelanggan'); ?>