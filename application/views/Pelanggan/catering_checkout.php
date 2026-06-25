<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-12 bg-background min-h-screen relative overflow-hidden">
    <div class="absolute top-10 right-0 w-72 h-72 bg-secondary-light/15 blob opacity-30"></div>
    <div class="absolute bottom-10 left-0 w-72 h-72 bg-primary/10 blob opacity-30"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-text-muted mb-8">
            <a href="<?php echo base_url('home'); ?>" class="hover:text-primary transition-colors duration-200">Beranda</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="<?php echo base_url('catering'); ?>" class="hover:text-primary transition-colors duration-200">Catering</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-primary font-medium">Checkout Catering</span>
        </div>

        <!-- Header -->
        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-secondary-light/50 text-primary rounded-full text-sm font-medium mb-4 border border-secondary/20">
                <i class="fas fa-credit-card text-accent text-xs"></i> Checkout Catering
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-text-main mb-3 font-heading">Selesaikan Pesanan Catering</h1>
            <p class="text-text-muted max-w-lg mx-auto">Isi data pengiriman dan pilih metode pembayaran</p>
        </div>

        <?php echo form_open('catering_checkout/proses', ['class' => 'contents']); ?>
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Form -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Informasi Pengiriman + Data Penerima -->
                <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-border-subtle/20 shadow-sm">
                    <h3 class="font-bold text-text-main mb-5 text-lg flex items-center gap-3 font-heading">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary to-primary-hover rounded-xl flex items-center justify-center text-white shadow-md shadow-primary/20">
                            <i class="fas fa-truck text-sm"></i>
                        </div>
                        Informasi Pengiriman
                    </h3>
                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-2">Nama Penerima <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-text-subtle"></i>
                                <input type="text" name="nama_penerima" value="<?php echo set_value('nama_penerima', $user->nama ?? ''); ?>" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-2">No HP <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-text-subtle"></i>
                                <input type="tel" name="no_hp" value="<?php echo set_value('no_hp', $user->no_hp ?? ''); ?>" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-text-main mb-2">Alamat Pengiriman <span class="text-red-500">*</span></label>
                        <textarea name="alamat" required rows="3" class="w-full px-4 py-3 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200"><?php echo set_value('alamat', $user->alamat ?? ''); ?></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text-main mb-2">Tanggal Kirim <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i class="fas fa-calendar-alt absolute left-4 top-1/2 -translate-y-1/2 text-text-subtle"></i>
                            <input type="date" name="tanggal_kirim" class="w-full pl-11 pr-4 py-3 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200" required>
                        </div>
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-border-subtle/20 shadow-sm">
                    <h3 class="font-bold text-text-main mb-5 text-lg flex items-center gap-3 font-heading">
                        <div class="w-10 h-10 bg-gradient-to-br from-secondary to-secondary-light rounded-xl flex items-center justify-center text-white shadow-md shadow-secondary/20">
                            <i class="fas fa-wallet text-sm"></i>
                        </div>
                        Metode Pembayaran
                    </h3>
                    <div class="space-y-3">
                        <label class="flex items-center gap-4 p-4 rounded-xl border border-border-subtle/30 cursor-pointer hover:bg-background/50 hover:border-primary/30 transition-all duration-200 group" data-metode="transfer">
                            <input type="radio" name="metode_pembayaran" value="transfer" checked class="w-5 h-5 text-primary accent-primary metode-radio">
                            <div class="flex-1">
                                <p class="font-semibold text-text-main group-hover:text-primary transition-colors duration-200">Transfer Bank</p>
                                <p class="text-sm text-text-muted">BCA / Mandiri / BRI / BNI</p>
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
                            <input type="radio" name="metode_pembayaran" value="qris" class="w-5 h-5 text-primary accent-primary metode-radio">
                            <div class="flex-1">
                                <p class="font-semibold text-text-main group-hover:text-primary transition-colors duration-200">QRIS / E-Wallet</p>
                                <p class="text-sm text-text-muted">GoPay / OVO / Dana / M-Banking</p>
                            </div>
                            <i class="fas fa-mobile-alt text-border-subtle group-hover:text-primary transition-colors duration-200"></i>
                        </label>
                    </div>
                </div>

                <!-- Catatan -->
                <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-border-subtle/20 shadow-sm">
                    <h3 class="font-bold text-text-main mb-5 text-lg flex items-center gap-3 font-heading">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-500 rounded-xl flex items-center justify-center text-white shadow-md shadow-green-500/20">
                            <i class="fas fa-sticky-note text-sm"></i>
                        </div>
                        Catatan Tambahan
                    </h3>
                    <textarea name="catatan" rows="3" class="w-full px-4 py-3 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200" placeholder="Catatan tambahan untuk pesanan (opsional)"><?php echo set_value('catatan'); ?></textarea>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-6 border border-border-subtle/20 sticky top-24 shadow-sm">
                    <h3 class="font-bold text-text-main mb-5 text-lg font-heading">Ringkasan Pesanan</h3>

                    <?php $harga_per_box = $catering_order['harga_per_box']; ?>
                    <?php $default_jumlah = 25; ?>

                    <!-- Detail Paket -->
                    <div class="bg-background/40 rounded-xl p-4 mb-4 border border-border-subtle/20">
                        <p class="font-bold text-text-main"><?php echo $catering_order['nama_paket']; ?></p>
                        <p class="text-xs text-text-muted mt-1">Harga Paket: <span class="font-semibold text-primary">Rp <?php echo number_format($catering_order['harga_paket'], 0, ',', '.'); ?></span></p>
                        <p class="text-xs text-text-muted">Biaya Tambahan: <span class="font-semibold text-primary">Rp <?php echo number_format($catering_order['total_tambahan'], 0, ',', '.'); ?></span></p>
                    </div>

                    <!-- Jumlah Box -->
                    <div class="bg-background/40 rounded-xl p-4 mb-4 border border-border-subtle/20">
                        <label class="block text-xs font-medium text-text-muted mb-1">Jumlah Box <span class="text-red-500">*</span></label>
                        <input type="number" id="jumlah-box" name="jumlah_box" min="25" value="<?php echo $default_jumlah; ?>" class="w-full px-4 py-2.5 border border-border-subtle/30 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-colors duration-200 text-center font-semibold" required>
                        <p id="error-jumlah-box" class="text-xs text-red-500 mt-1 hidden">Minimal pemesanan catering adalah 25 box.</p>
                    </div>

                    <!-- Harga & Total -->
                    <div class="border-t border-border-subtle/30 pt-4 mb-2">
                        <div class="flex justify-between text-sm text-text-muted mb-2">
                            <span>Harga per Box</span>
                            <span>Rp <?php echo number_format($harga_per_box, 0, ',', '.'); ?></span>
                        </div>
                        <div class="flex justify-between text-sm text-text-muted mb-2">
                            <span>Jumlah Box</span>
                            <span class="font-semibold text-text-main" id="total-box"><?php echo $default_jumlah; ?></span>
                        </div>
                        <div class="flex justify-between text-sm text-text-muted mb-4">
                            <span>Ongkir</span>
                            <span class="text-green-600 font-medium">Gratis</span>
                        </div>
                    </div>
                    <div class="border-t border-border-subtle/30 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-lg text-text-main">Total Pembayaran</span>
                            <span class="font-extrabold text-2xl text-primary" id="total-pembayaran">Rp <?php echo number_format($harga_per_box * $default_jumlah, 0, ',', '.'); ?></span>
                        </div>
                    </div>

                    <input type="hidden" name="harga_per_box" id="harga-per-box" value="<?php echo $harga_per_box; ?>">
                    <input type="hidden" name="total_harga" id="total-harga-hidden" value="<?php echo $harga_per_box * $default_jumlah; ?>">

                    <button type="submit" class="block w-full py-3.5 bg-primary text-white rounded-full font-medium hover:bg-primary-hover transition-all duration-200 text-center flex items-center justify-center gap-2 shadow-md shadow-primary/20">
                        <i class="fas fa-check-circle text-sm"></i> Buat Pesanan
                    </button>
                    <a href="<?php echo base_url('catering'); ?>" class="block w-full py-3 text-primary rounded-full font-medium hover:bg-background/80 transition-all duration-200 text-center mt-2 text-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Catering
                    </a>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hargaPerBox = <?php echo $harga_per_box; ?>;
    const inputJumlah = document.getElementById('jumlah-box');
    const totalBoxEl = document.getElementById('total-box');
    const totalPembayaranEl = document.getElementById('total-pembayaran');
    const totalHidden = document.getElementById('total-harga-hidden');
    const errorEl = document.getElementById('error-jumlah-box');
    const btnSubmit = document.querySelector('button[type="submit"]');

    function updateTotal() {
        const jumlah = parseInt(inputJumlah.value) || 0;
        const total = hargaPerBox * jumlah;

        totalBoxEl.textContent = jumlah;
        totalPembayaranEl.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        totalHidden.value = total;

        if (jumlah < 25) {
            errorEl.classList.remove('hidden');
            inputJumlah.classList.add('border-red-400');
            btnSubmit.disabled = true;
            btnSubmit.classList.add('opacity-50', 'cursor-not-allowed');
        } else {
            errorEl.classList.add('hidden');
            inputJumlah.classList.remove('border-red-400');
            btnSubmit.disabled = false;
            btnSubmit.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    }

    if (inputJumlah) {
        inputJumlah.addEventListener('input', updateTotal);
        updateTotal();
    }
});
</script>

<!-- ========== MODAL TRANSFER BANK ========== -->
<div id="modalTransfer" class="fixed inset-0 z-[9999] bg-black/40 backdrop-blur-sm flex items-center justify-center hidden p-4" onclick="closeModalTransfer(event)">
    <div class="bg-surface rounded-3xl max-w-md w-full shadow-2xl border border-border-subtle/20 overflow-hidden" onclick="event.stopPropagation()">
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
        <div class="p-6">
            <div class="bg-background/60 rounded-2xl p-5 border border-border-subtle/20">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary to-primary-hover rounded-xl flex items-center justify-center text-white shadow-md">
                        <i class="fas fa-university text-sm"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-text-main text-sm">[NAMA_BANK]</p>
                    </div>
                </div>
                <div class="flex items-center justify-between bg-surface rounded-xl px-4 py-3 border border-border-subtle/20 mb-3">
                    <span class="font-mono font-bold text-primary text-base select-all">[NO_REKENING]</span>
                    <button onclick="copyText(this, '[NO_REKENING]')" class="px-3 py-1.5 bg-primary text-white rounded-lg text-xs font-medium hover:bg-primary-hover transition flex items-center gap-1.5 flex-shrink-0">
                        <i class="fas fa-copy"></i> Salin
                    </button>
                </div>
                <p class="text-xs text-text-subtle">a.n. <span class="font-semibold text-text-main">[NAMA_PEMILIK]</span></p>
            </div>
        </div>
        <div class="px-6 pb-6">
            <p class="text-xs text-text-subtle text-center">* Silakan transfer sesuai total pembayaran dan upload bukti transfer</p>
        </div>
    </div>
</div>

<!-- ========== MODAL QRIS / E-WALLET ========== -->
<div id="modalQRIS" class="fixed inset-0 z-[9999] bg-black/40 backdrop-blur-sm flex items-center justify-center hidden p-4" onclick="closeModalQRIS(event)">
    <div class="bg-surface rounded-3xl max-w-sm w-full shadow-2xl border border-border-subtle/20 overflow-hidden text-center" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between p-6 border-b border-border-subtle/20">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center text-white shadow-md shadow-green-500/20">
                    <i class="fas fa-qrcode text-sm"></i>
                </div>
                <h3 class="font-bold text-text-main">QRIS / E-Wallet</h3>
            </div>
            <button onclick="closeModalQRIS()" class="w-8 h-8 rounded-full bg-background hover:bg-secondary-light flex items-center justify-center text-text-muted hover:text-text-main transition-all duration-200">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>
        <div class="p-8">
            <div class="w-56 h-56 mx-auto bg-surface rounded-2xl border-2 border-border-subtle/30 flex items-center justify-center overflow-hidden shadow-sm mb-4 p-3">
                <?php if (file_exists(FCPATH . 'assets/img/qris.png')): ?>
                <img src="<?php echo base_url('assets/img/qris.png'); ?>" alt="QRIS NINGNONG" class="w-full h-full object-contain">
                <?php else: ?>
                <div class="text-center text-text-subtle">
                    <i class="fas fa-qrcode text-5xl mb-2"></i>
                    <p class="text-xs">QRIS akan ditampilkan di sini</p>
                </div>
                <?php endif; ?>
            </div>
            <p class="text-sm text-text-muted">Scan QRIS untuk pembayaran</p>
            <p class="text-xs text-text-subtle mt-1">Gunakan GoPay, OVO, DANA, atau M-Banking</p>
        </div>
    </div>
</div>

<!-- Toast untuk feedback copy -->
<div id="toast-copy" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[99999] bg-text-main text-white px-5 py-3 rounded-2xl shadow-lg text-sm font-medium flex items-center gap-2 opacity-0 translate-y-4 transition-all duration-300 pointer-events-none">
    <i class="fas fa-check-circle text-green-400"></i>
    <span id="toast-copy-msg">Nomor rekening disalin</span>
</div>

<script>
function openModalTransfer() {
    document.getElementById('modalTransfer').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function closeModalTransfer(e) {
    if (e && e.target !== e.currentTarget) return;
    document.getElementById('modalTransfer').classList.add('hidden');
    document.body.style.overflow = '';
}
function openModalQRIS() {
    document.getElementById('modalQRIS').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function closeModalQRIS(e) {
    if (e && e.target !== e.currentTarget) return;
    document.getElementById('modalQRIS').classList.add('hidden');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') { closeModalTransfer(); closeModalQRIS(); }
});
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
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-metode]').forEach(function(label) {
        label.addEventListener('click', function() {
            const metode = this.dataset.metode;
            const radio = this.querySelector('.metode-radio');
            if (radio) radio.checked = true;
            if (metode === 'transfer') {
                setTimeout(openModalTransfer, 150);
            } else if (metode === 'ewallet') {
                setTimeout(openModalQRIS, 150);
            }
        });
    });
});
</script>

<?php $this->load->view('templates/footer_pelanggan'); ?>
