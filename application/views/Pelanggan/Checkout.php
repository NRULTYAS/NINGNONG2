<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-12 bg-background min-h-screen relative overflow-hidden">
    <div class="absolute top-0 right-0 w-72 h-72 bg-secondary-light/15 blob opacity-30"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-secondary-light/40 text-primary rounded-full text-sm font-medium mb-3 border border-secondary/20">
                <i class="fas fa-credit-card text-accent text-xs"></i> Checkout
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-text-main mb-2 font-heading">Selesaikan Pesanan</h1>
            <p class="text-text-muted">Isi data pengiriman dan pilih metode pembayaran</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <form action="<?php echo base_url('checkout/proses'); ?>" method="post">
                    <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-border-subtle/20 shadow-sm">
                        <h3 class="font-bold text-text-main mb-5 text-lg flex items-center gap-3 font-heading">
                            <div class="w-10 h-10 bg-gradient-to-br from-primary to-primary-hover rounded-xl flex items-center justify-center text-white shadow-md shadow-primary/20">
                                <i class="fas fa-truck text-sm"></i>
                            </div>
                            Informasi Pengiriman
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-text-main mb-2">Nama Penerima</label>
                                <div class="relative">
                                    <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-text-subtle"></i>
                                    <input type="text" name="nama_penerima" value="<?php echo $user->nama; ?>" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-text-main mb-2">No HP</label>
                                <div class="relative">
                                    <i class="fas fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-text-subtle"></i>
                                    <input type="text" name="no_hp" value="<?php echo $user->no_hp; ?>" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-2">Alamat Pengiriman</label>
                            <textarea name="alamat" required rows="3" class="w-full px-4 py-3 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200"><?php echo $user->alamat; ?></textarea>
                        </div>
                    </div>

                    <!-- PEMBAYARAN -->
                    <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-border-subtle/20 shadow-sm">
                        <h3 class="font-bold text-text-main mb-5 text-lg flex items-center gap-3 font-heading">
                            <div class="w-10 h-10 bg-gradient-to-br from-secondary to-secondary-light rounded-xl flex items-center justify-center text-white shadow-md shadow-secondary/20">
                                <i class="fas fa-wallet text-sm"></i>
                            </div>
                            Metode Pembayaran
                        </h3>
                        <div class="space-y-3">
                            <label class="flex items-center gap-4 p-4 rounded-xl border border-border-subtle/30 cursor-pointer hover:bg-background/50 hover:border-primary/30 transition-all duration-200 group" data-metode="transfer">
                                <input type="radio" name="metode_pembayaran" value="Transfer Bank" checked class="w-5 h-5 text-primary accent-primary metode-radio">
                                <div class="flex-1">
                                    <p class="font-semibold text-text-main group-hover:text-primary transition-colors duration-200">Transfer Bank</p>
                                    <p class="text-sm text-text-muted">BJB</p>
                                </div>
                                <i class="fas fa-university text-border-subtle group-hover:text-primary transition-colors duration-200"></i>
                            </label>
                            <label class="flex items-center gap-4 p-4 rounded-xl border border-border-subtle/30 cursor-pointer hover:bg-background/50 hover:border-primary/30 transition-all duration-200 group" data-metode="cod">
                                <input type="radio" name="metode_pembayaran" value="COD" class="w-5 h-5 text-primary accent-primary metode-radio">
                                <div class="flex-1">
                                    <p class="font-semibold text-text-main group-hover:text-primary transition-colors duration-200">COD (Bayar di Tempat)</p>
                                    <p class="text-sm text-text-muted">Bayar saat menerima pesanan</p>
                                </div>
                                <i class="fas fa-hand-holding-usd text-border-subtle group-hover:text-primary transition-colors duration-200"></i>
                            </label>
                            <label class="flex items-center gap-4 p-4 rounded-xl border border-border-subtle/30 cursor-pointer hover:bg-background/50 hover:border-primary/30 transition-all duration-200 group" data-metode="ewallet">
                                <input type="radio" name="metode_pembayaran" value="E-Wallet" class="w-5 h-5 text-primary accent-primary metode-radio">
                                <div class="flex-1">
                                    <p class="font-semibold text-text-main group-hover:text-primary transition-colors duration-200">E-Wallet</p>
                                    <p class="text-sm text-text-muted">Dana / OVO / GoPay</p>
                                </div>
                                <i class="fas fa-mobile-alt text-border-subtle group-hover:text-primary transition-colors duration-200"></i>
                            </label>
                        </div>
                    </div>

                    <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-border-subtle/20 shadow-sm">
                        <h3 class="font-bold text-text-main mb-5 text-lg flex items-center gap-3 font-heading">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-500 rounded-xl flex items-center justify-center text-white shadow-md shadow-green-500/20">
                                <i class="fas fa-sticky-note text-sm"></i>
                            </div>
                            Catatan Tambahan
                        </h3>
                        <textarea name="catatan" rows="3" class="w-full px-4 py-3 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200" placeholder="Catatan tambahan untuk pesanan (opsional)"></textarea>
                    </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-6 border border-border-subtle/20 sticky top-24 shadow-sm">
                    <h3 class="font-bold text-text-main mb-5 text-lg font-heading">Ringkasan Pesanan</h3>
                    <div class="space-y-3 mb-5 max-h-60 overflow-y-auto pr-1">
                        <?php $total = 0; foreach($keranjang as $k): $subtotal = $k->harga * $k->jumlah; $total += $subtotal; ?>
                        <div class="flex justify-between text-sm items-center">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-background rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-cookie-bite text-primary/40 text-xs"></i>
                                </div>
                                <span class="text-text-main truncate max-w-[120px]"><?php echo $k->nama_produk; ?></span>
                            </div>
                            <span class="font-medium text-primary">x<?php echo $k->jumlah; ?></span>
                            <span class="font-medium text-text-main">Rp <?php echo number_format($subtotal,0,',','.'); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="border-t border-border-subtle/30 pt-4 mb-2">
                        <div class="flex justify-between text-sm text-text-muted mb-2">
                            <span>Subtotal</span>
                            <span>Rp <?php echo number_format($total,0,',','.'); ?></span>
                        </div>
                        <div class="flex justify-between text-sm text-text-muted mb-4">
                            <span>Ongkir</span>
                            <span class="text-green-600 font-medium">Gratis</span>
                        </div>
                    </div>
                    <div class="border-t border-border-subtle/30 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-lg text-text-main">Total</span>
                            <span class="font-extrabold text-2xl text-primary">Rp <?php echo number_format($total,0,',','.'); ?></span>
                        </div>
                    </div>
                    <button type="submit" class="block w-full py-3.5 bg-primary text-white rounded-full font-medium hover:bg-primary-hover transition-all duration-200 text-center flex items-center justify-center gap-2 shadow-md shadow-primary/20">
                        <i class="fas fa-check-circle text-sm"></i> Buat Pesanan
                    </button>
                    <a href="<?php echo base_url('keranjang'); ?>" class="block w-full py-3 text-primary rounded-full font-medium hover:bg-background/80 transition-all duration-200 text-center mt-2 text-sm">
                        Kembali ke Keranjang
                    </a>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ========== MODAL TRANSFER BANK ========== -->
<div id="modalTransfer" class="fixed inset-0 z-[9999] bg-black/40 backdrop-blur-sm flex items-center justify-center hidden p-4" onclick="closeModalTransfer(event)">
    <div class="bg-surface rounded-3xl max-w-md w-full shadow-2xl border border-border-subtle/20 overflow-hidden" onclick="event.stopPropagation()">
        <!-- Header -->
        <div class="flex items-center justify-between p-6 border-b border-border-subtle/20">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-primary to-primary-hover rounded-xl flex items-center justify-center text-white shadow-md shadow-primary/20">
                    <i class="fas fa-university text-sm"></i>
                </div>
                <div>
                    <h3 class="font-bold text-text-main">Transfer Bank</h3>
                    <p class="text-xs text-text-muted">Pilih rekening tujuan transfer</p>
                </div>
            </div>
            <button onclick="closeModalTransfer()" class="w-8 h-8 rounded-full bg-background hover:bg-secondary-light flex items-center justify-center text-text-muted hover:text-text-main transition-all duration-200">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>
        <!-- Body: 1 Rekening -->
        <div class="p-6">
            <div class="bg-background/60 rounded-2xl p-5 border border-border-subtle/20">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary to-primary-hover rounded-xl flex items-center justify-center text-white shadow-md">
                        <i class="fas fa-university text-sm"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-text-main text-sm">BJB</p>
                    </div>
                </div>
                <div class="flex items-center justify-between bg-surface rounded-xl px-4 py-3 border border-border-subtle/20 mb-3">
                    <span class="font-mono font-bold text-primary text-base select-all">0100515393100</span>
                    <button onclick="copyText(this, '0100515393100')" class="px-3 py-1.5 bg-primary text-white rounded-lg text-xs font-medium hover:bg-primary-hover transition flex items-center gap-1.5 flex-shrink-0">
                        <i class="fas fa-copy"></i> Salin
                    </button>
                </div>
                <p class="text-xs text-text-subtle">a.n. <span class="font-semibold text-text-main">SURATININGSIH</span></p>
            </div>
        </div>
        <!-- Footer -->
        <div class="px-6 pb-6">
            <p class="text-xs text-text-subtle text-center">* Silakan transfer sesuai total pembayaran dan upload bukti transfer</p>
        </div>
    </div>
</div>



<!-- Toast untuk feedback copy -->
<div id="toast-copy" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[99999] bg-text-main text-white px-5 py-3 rounded-2xl shadow-lg text-sm font-medium flex items-center gap-2 opacity-0 translate-y-4 transition-all duration-300 pointer-events-none">
    <i class="fas fa-check-circle text-green-400"></i>
    <span id="toast-copy-msg">Nomor rekening disalin</span>
</div>

<script>
// ===== MODAL TRANSFER BANK =====
function openModalTransfer() {
    document.getElementById('modalTransfer').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function closeModalTransfer(e) {
    if (e && e.target !== e.currentTarget) return;
    document.getElementById('modalTransfer').classList.add('hidden');
    document.body.style.overflow = '';
}
// Escape key close
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModalTransfer();
    }
});

// ===== TOAST COPY =====
function showCopyToast(msg) {
    const toast = document.getElementById('toast-copy');
    const msgEl = document.getElementById('toast-copy-msg');
    msgEl.textContent = msg || 'Nomor rekening disalin';
    toast.classList.remove('opacity-0', 'translate-y-4');
    toast.classList.add('opacity-100', 'translate-y-0');
    setTimeout(function() {
        toast.classList.remove('opacity-100', 'translate-y-0');
        toast.classList.add('opacity-0', 'translate-y-4');
    }, 2000);
}

// ===== COPY TEXT =====
function copyText(btn, text) {
    navigator.clipboard.writeText(text).then(function() {
        const original = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Tersalin';
        btn.classList.remove('bg-primary', 'hover:bg-primary-hover');
        btn.classList.add('bg-green-500', 'hover:bg-green-600');
        setTimeout(function() {
            btn.innerHTML = original;
            btn.classList.remove('bg-green-500', 'hover:bg-green-600');
            btn.classList.add('bg-primary', 'hover:bg-primary-hover');
        }, 1500);
        showCopyToast('Nomor rekening disalin');
    }).catch(function() {
        // Fallback: select all text
        const span = btn.parentElement.querySelector('.font-mono');
        if (span) {
            const range = document.createRange();
            range.selectNodeContents(span);
            const sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);
            showCopyToast('Teks dipilih, silakan salin manual');
        }
    });
}

// ===== EVENT: Klik opsi pembayaran → buka modal =====
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-metode]').forEach(function(label) {
        label.addEventListener('click', function() {
            const metode = this.dataset.metode;
            const radio = this.querySelector('.metode-radio');
            if (radio) radio.checked = true;

            if (metode === 'transfer') {
                setTimeout(openModalTransfer, 150);
            }
            // COD / E-Wallet: no modal, just select
        });
    });
});
</script>

<?php $this->load->view('templates/footer_pelanggan'); ?>