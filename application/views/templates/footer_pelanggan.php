<!-- Footer -->
<footer class="bg-coklat-tua text-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-2 md:grid-cols-12 gap-8">
            <!-- Logo & Deskripsi -->
            <div class="col-span-2 md:col-span-5">
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-coklat-tua font-bold text-sm shadow-md">N</div>
                    <div>
                        <span class="text-base font-bold leading-none tracking-tight">NINGNONG</span>
                        <span class="block text-[8px] text-coklat-muda font-medium tracking-widest uppercase">Kue Basah</span>
                    </div>
                </div>
                <p class="text-coklat-muda/60 text-sm leading-relaxed mb-4 max-w-xs">
                    Nikmati kelezatan kue basah tradisional dengan sentuhan modern. Dibuat dengan bahan berkualitas dan penuh cinta.
                </p>
                <div class="flex gap-2">
                    <a href="#" class="w-7 h-7 bg-white/10 rounded-md flex items-center justify-center hover:bg-white/20 transition text-coklat-muda hover:text-white">
                        <i class="fab fa-instagram text-xs"></i>
                    </a>
                    <a href="#" class="w-7 h-7 bg-white/10 rounded-md flex items-center justify-center hover:bg-white/20 transition text-coklat-muda hover:text-white">
                        <i class="fab fa-facebook-f text-xs"></i>
                    </a>
                    <a href="https://wa.me/<?php echo NOMOR_WA_PENJUAL; ?>" target="_blank" class="w-7 h-7 bg-white/10 rounded-md flex items-center justify-center hover:bg-white/20 transition text-coklat-muda hover:text-white">
                        <i class="fab fa-whatsapp text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Menu -->
            <div class="md:col-span-2">
                <h4 class="text-[11px] font-semibold uppercase tracking-[0.15em] text-coklat-muda/50 mb-3">Menu</h4>
                <ul class="space-y-2 text-coklat-muda/65 text-sm">
                    <li><a href="<?php echo base_url('home'); ?>" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="<?php echo base_url('produk'); ?>" class="hover:text-white transition">Produk</a></li>
                    <li><a href="<?php echo base_url('keranjang'); ?>" class="hover:text-white transition">Keranjang</a></li>
                    <li><a href="<?php echo base_url('riwayat'); ?>" class="hover:text-white transition">Riwayat</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="md:col-span-3">
                <h4 class="text-[11px] font-semibold uppercase tracking-[0.15em] text-coklat-muda/50 mb-3">Kontak</h4>
                <ul class="space-y-2 text-coklat-muda/65 text-sm">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-map-marker-alt mt-1 text-oranye/50 text-[10px]"></i>
                        <span>Jl. Kue Basah No. 1, Jakarta</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-phone text-oranye/50 text-[10px]"></i>
                        <span>0812-3456-7890</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-envelope text-oranye/50 text-[10px]"></i>
                        <span>info@ningnong.com</span>
                    </li>
                </ul>
            </div>

            <!-- Jam Operasional -->
            <div class="md:col-span-2">
                <h4 class="text-[11px] font-semibold uppercase tracking-[0.15em] text-coklat-muda/50 mb-3">Jam Buka</h4>
                <ul class="space-y-2 text-coklat-muda/65 text-sm">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-clock text-oranye/50 text-[10px]"></i>
                        <span>Senin - Jumat: 08.00 - 20.00</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-clock text-oranye/50 text-[10px]"></i>
                        <span>Sabtu - Minggu: 07.00 - 21.00</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10 mt-8 pt-4 flex flex-col md:flex-row justify-between items-center gap-2">
            <p class="text-coklat-muda/40 text-[11px]">&copy; <?php echo date('Y'); ?> NINGNONG Kue Basah. All rights reserved.</p>
            <p class="text-coklat-muda/30 text-[11px]">Made with <i class="fas fa-heart text-oranye/50 text-[9px]"></i> in Indonesia</p>
        </div>
    </div>
</footer>

</body>
</html>
