<!-- Footer -->
<footer class="bg-primary-dark text-background relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-primary/40 to-transparent"></div>

    <!-- Signature organic shapes -->
    <div class="absolute -top-16 -right-16 w-64 h-64 bg-accent/5 organic-shape"></div>
    <div class="absolute bottom-12 -left-12 w-48 h-48 bg-background/5 organic-shape" style="border-radius: 60% 40% 30% 70% / 50% 60% 40% 50%;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative">
        <div class="grid grid-cols-2 md:grid-cols-12 gap-8 lg:gap-12">
            <!-- Logo & Deskripsi -->
            <div class="col-span-2 md:col-span-5 flex flex-col">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 bg-surface rounded-xl flex items-center justify-center text-primary font-bold text-base shadow-lg">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="#7C8C6C"/><circle cx="12" cy="12" r="3" fill="#7C8C6C"/></svg>
                    </div>
                    <div>
                        <span class="text-lg font-bold leading-none tracking-tight font-heading">NINGNONG</span>
                        <span class="block text-[9px] text-secondary font-medium tracking-[0.15em] uppercase">Kue Basah</span>
                    </div>
                </div>
                <p class="text-background/80 text-sm leading-relaxed mb-6 max-w-xs">
                    Kue basah tradisional dengan sentuhan modern. Dibuat dari bahan pilihan untuk cita rasa otentik.
                </p>
                <div class="flex gap-3">
                    <a href="https://www.instagram.com/ningnong_kue?igsh=MXdrdmNuYXA2YXJreA==" target="_blank" class="w-9 h-9 bg-background/15 rounded-xl flex items-center justify-center hover:bg-background/30 transition-colors duration-200 text-background hover:text-accent">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                    <a href="https://wa.me/<?php echo NOMOR_WA_PENJUAL; ?>" target="_blank" class="w-9 h-9 bg-background/15 rounded-xl flex items-center justify-center hover:bg-background/30 transition-colors duration-200 text-background hover:text-accent">
                        <i class="fab fa-whatsapp text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- Menu -->
            <div class="md:col-span-2 pt-0.5">
                <h4 class="text-[11px] font-semibold uppercase tracking-[0.15em] text-accent mb-4 font-heading">Menu</h4>
                <ul class="space-y-3 text-background/80 text-sm">
                    <li><a href="<?php echo base_url('home'); ?>" class="hover:text-background transition-colors duration-200">Beranda</a></li>
                    <li><a href="<?php echo base_url('produk'); ?>" class="hover:text-background transition-colors duration-200">Aneka Kue</a></li>
                    <li><a href="<?php echo base_url('keranjang'); ?>" class="hover:text-background transition-colors duration-200">Keranjang</a></li>
                    <li><a href="<?php echo base_url('riwayat'); ?>" class="hover:text-background transition-colors duration-200">Riwayat</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="md:col-span-3 pt-0.5">
                <h4 class="text-[11px] font-semibold uppercase tracking-[0.15em] text-accent mb-4 font-heading">Kontak</h4>
                <ul class="space-y-3 text-background/80 text-sm">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt mt-1 text-accent text-xs flex-shrink-0"></i>
                        <span class="leading-relaxed">Gbi, Komp, Jl. Alam Raya No.4, RW.5, Buahbatu, Kec. Bojongsoang, Kabupaten Bandung, Jawa Barat 40287</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-phone text-accent text-xs flex-shrink-0"></i>
                        <span>0821-1976-4204</span>
                    </li>
                </ul>
            </div>

            <!-- Jam Operasional -->
            <div class="md:col-span-2 pt-0.5">
                <h4 class="text-[11px] font-semibold uppercase tracking-[0.15em] text-accent mb-4 font-heading">Jam Buka</h4>
                <ul class="space-y-3 text-background/80 text-sm">
                    <li class="flex items-center gap-3">
                        <i class="fas fa-clock text-accent text-xs flex-shrink-0"></i>
                        <span>Setiap Hari 05.00 - 12.00</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="h-px bg-background/10 mt-12 mb-6"></div>

        <div class="flex flex-col md:flex-row justify-between items-center gap-3">
            <p class="text-background/50 text-[11px]">&copy; <?php echo date('Y'); ?> NINGNONG Kue Basah. All rights reserved.</p>
            <p class="text-background/35 text-[11px]">Made with <i class="fas fa-heart text-accent/70 text-[9px]"></i> in Indonesia</p>
        </div>
    </div>
</footer>

</body>
</html>
