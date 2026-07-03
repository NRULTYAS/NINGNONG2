<?php $this->load->view('templates/header_pelanggan'); ?>

<section class="py-8 bg-background min-h-screen relative overflow-hidden">
    <div class="absolute top-0 right-0 w-72 h-72 bg-secondary-light/15 blob opacity-30"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-6">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-secondary-light/40 text-primary rounded-full text-sm font-medium mb-2 border border-secondary/20">
                <i class="fas fa-credit-card text-accent text-xs"></i> Checkout
            </span>
            <h1 class="text-2xl md:text-3xl font-extrabold text-text-main mb-1 font-heading">Selesaikan Pesanan</h1>
            <p class="text-sm text-text-muted">Isi data pengiriman dan pilih metode pembayaran</p>
        </div>

        <?php if ($this->session->flashdata('error')): ?>
        <div class="max-w-7xl mx-auto mb-4 px-4 sm:px-6 lg:px-8">
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
                <i class="fas fa-exclamation-circle"></i> <?php echo $this->session->flashdata('error'); ?>
            </div>
        </div>
        <?php endif; ?>

        <form action="<?php echo base_url('checkout/proses'); ?>" method="post" enctype="multipart/form-data" id="formCheckout">
            <div class="grid lg:grid-cols-3 gap-6">
                <!-- ===== KOLOM KIRI: Informasi Pengiriman + Upload ===== -->
                <div class="lg:col-span-2 space-y-4">
                    <!-- INFORMASI PENGIRIMAN -->
                    <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-5 md:p-6 border border-border-subtle/20 shadow-sm">
                        <h3 class="font-bold text-text-main mb-4 text-base flex items-center gap-3 font-heading">
                            <div class="w-8 h-8 bg-gradient-to-br from-primary to-primary-hover rounded-xl flex items-center justify-center text-white shadow-md shadow-primary/20">
                                <i class="fas fa-truck text-xs"></i>
                            </div>
                            Informasi Pengiriman
                        </h3>
                        <div class="grid md:grid-cols-2 gap-3 mb-3">
                            <div>
                                <label class="block text-sm font-medium text-text-main mb-1.5">
                                    Nama Penerima <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <i class="fas fa-user absolute left-3.5 top-1/2 -translate-y-1/2 text-text-subtle text-sm"></i>
                                    <input type="text" name="nama_penerima" value="<?php echo $user->nama; ?>" required class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200 text-sm">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-text-main mb-1.5">
                                    No. HP <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <i class="fas fa-phone absolute left-3.5 top-1/2 -translate-y-1/2 text-text-subtle text-sm"></i>
                                    <input type="text" name="no_hp" value="<?php echo $user->no_hp; ?>" required class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200 text-sm">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-text-main mb-1.5">
                                Alamat Pengiriman <span class="text-red-500">*</span>
                            </label>
                            <textarea name="alamat" required rows="2" class="w-full px-4 py-2.5 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200 text-sm"><?php echo $user->alamat; ?></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-1.5">
                                Tanggal Pengiriman <span class="text-red-500">*</span>
                            </label>
                            <div class="relative max-w-xs">
                                <i class="fas fa-calendar-alt absolute left-3.5 top-1/2 -translate-y-1/2 text-text-subtle text-sm"></i>
                                <input type="date" name="tanggal_kirim" required class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200 text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- CATATAN TAMBAHAN -->
                    <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-5 md:p-6 border border-border-subtle/20 shadow-sm">
                        <h3 class="font-bold text-text-main mb-3 text-base flex items-center gap-3 font-heading">
                            <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-green-500 rounded-xl flex items-center justify-center text-white shadow-md shadow-green-500/20">
                                <i class="fas fa-sticky-note text-xs"></i>
                            </div>
                            Catatan Tambahan
                        </h3>
                        <textarea name="catatan" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200 text-sm" placeholder="Catatan tambahan untuk pesanan (opsional)"></textarea>
                    </div>

                    <!-- BUKTI PEMBAYARAN -->
                    <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-5 md:p-6 border border-border-subtle/20 shadow-sm" id="buktiSection">
                        <h3 class="font-bold text-text-main mb-3 text-base flex items-center gap-3 font-heading">
                            <div class="w-8 h-8 bg-gradient-to-br from-purple-400 to-purple-500 rounded-xl flex items-center justify-center text-white shadow-md shadow-purple-500/20">
                                <i class="fas fa-image text-xs"></i>
                            </div>
                            Bukti Pembayaran
                        </h3>
                        <div class="border-2 border-dashed border-border-subtle/40 rounded-2xl p-4 text-center hover:border-primary/40 transition-all duration-200 cursor-pointer bg-background/20" id="uploadArea">
                            <div class="flex flex-col items-center gap-1.5">
                                <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                                    <i class="fas fa-cloud-upload-alt text-lg text-primary/60"></i>
                                </div>
                                <p class="text-sm text-text-main font-medium">Klik untuk upload bukti pembayaran</p>
                                <p class="text-xs text-text-subtle" id="fileLabel">Format: JPG, PNG, WEBP (Max 2MB)</p>
                                <p class="text-xs text-red-500 font-medium hidden" id="wajibBukti">* Wajib dilampirkan untuk metode Transfer / QRIS</p>
                            </div>
                            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept=".jpg,.jpeg,.png,.webp" class="hidden">
                            <div id="uploadError" class="text-xs text-red-500 font-medium mt-2 hidden">* Bukti pembayaran wajib diupload untuk metode Transfer / E-Wallet</div>
                        </div>
                        <div id="filePreview" class="mt-2 hidden">
                            <div class="flex items-center gap-3 bg-background/40 rounded-xl px-4 py-2.5 border border-border-subtle/20">
                                <i class="fas fa-file-image text-primary text-lg"></i>
                                <span class="text-sm text-text-main flex-1 truncate" id="fileName"></span>
                                <button type="button" onclick="removeFile()" class="text-red-400 hover:text-red-600 transition">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== KOLOM KANAN: Ringkasan + Metode Pembayaran ===== -->
                <div class="lg:col-span-1 space-y-4">
                    <!-- RINGKASAN PESANAN (ATAS) -->
                    <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-5 border border-border-subtle/20 shadow-sm">
                        <h3 class="font-bold text-text-main mb-4 text-base font-heading">Ringkasan Pesanan</h3>
                        <div class="space-y-2 mb-3 max-h-40 overflow-y-auto pr-1">
                            <?php $total = 0; foreach($keranjang as $k): $subtotal = $k->harga * $k->jumlah; $total += $subtotal; ?>
                            <div class="flex justify-between text-sm items-center">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 bg-background rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-cookie-bite text-primary/40 text-xs"></i>
                                    </div>
                                    <span class="text-text-main truncate max-w-[110px]"><?php echo $k->nama_produk; ?></span>
                                </div>
                                <span class="font-medium text-text-main">Rp <?php echo number_format($subtotal,0,',','.'); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="border-t border-border-subtle/30 pt-3 mb-1">
                            <div class="flex justify-between text-sm text-text-muted mb-1">
                                <span>Subtotal</span>
                                <span>Rp <?php echo number_format($total,0,',','.'); ?></span>
                            </div>
                            <div class="flex justify-between text-sm text-text-muted mb-2">
                                <span>Ongkir</span>
                                <span class="text-green-600 font-medium">Gratis</span>
                            </div>
                        </div>
                        <div class="border-t border-border-subtle/30 pt-3 mb-4">
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-base text-text-main">Total</span>
                                <span class="font-extrabold text-xl text-primary">Rp <?php echo number_format($total,0,',','.'); ?></span>
                            </div>
                        </div>
                        <button type="submit" id="btnSubmit" class="block w-full py-3 bg-primary text-white rounded-full font-medium hover:bg-primary-hover transition-all duration-200 text-center flex items-center justify-center gap-2 shadow-md shadow-primary/20 text-sm disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-primary">
                            <i class="fas fa-check-circle text-sm"></i> Konfirmasi Pesanan
                        </button>
                        <a href="<?php echo base_url('keranjang'); ?>" class="block w-full py-2.5 text-primary rounded-full font-medium hover:bg-background/80 transition-all duration-200 text-center mt-1.5 text-xs">
                            Kembali ke Keranjang
                        </a>
                    </div>

                    <!-- METODE PEMBAYARAN (BAWAH) -->
                    <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-5 border border-border-subtle/20 shadow-sm">
                        <h3 class="font-bold text-text-main mb-3 text-base flex items-center gap-3 font-heading">
                            <div class="w-8 h-8 bg-gradient-to-br from-secondary to-secondary-light rounded-xl flex items-center justify-center text-white shadow-md shadow-secondary/20">
                                <i class="fas fa-wallet text-xs"></i>
                            </div>
                            Metode Pembayaran
                        </h3>
                        <div class="space-y-2">
                            <label class="flex items-center gap-3 p-3 rounded-xl border border-border-subtle/30 cursor-pointer hover:bg-background/50 hover:border-primary/30 transition-all duration-200 group metode-label" data-metode="transfer">
                                <input type="radio" name="metode_pembayaran" value="transfer" checked class="w-4 h-4 text-primary accent-primary metode-radio">
                                <div class="flex-1">
                                    <p class="font-semibold text-text-main group-hover:text-primary transition-colors duration-200 text-sm">Transfer Bank</p>
                                    <p class="text-xs text-text-muted">BCA / Mandiri / BNI</p>
                                </div>
                                <i class="fas fa-university text-border-subtle group-hover:text-primary transition-colors duration-200 text-sm"></i>
                            </label>
                            <label class="flex items-center gap-3 p-3 rounded-xl border border-border-subtle/30 cursor-pointer hover:bg-background/50 hover:border-primary/30 transition-all duration-200 group metode-label" data-metode="cod">
                                <input type="radio" name="metode_pembayaran" value="cod" class="w-4 h-4 text-primary accent-primary metode-radio">
                                <div class="flex-1">
                                    <p class="font-semibold text-text-main group-hover:text-primary transition-colors duration-200 text-sm">COD - Bayar di Tempat</p>
                                    <p class="text-xs text-text-muted">Bayar saat menerima pesanan</p>
                                </div>
                                <i class="fas fa-hand-holding-usd text-border-subtle group-hover:text-primary transition-colors duration-200 text-sm"></i>
                            </label>
                            <label class="flex items-center gap-3 p-3 rounded-xl border border-border-subtle/30 cursor-pointer hover:bg-background/50 hover:border-primary/30 transition-all duration-200 group metode-label" data-metode="ewallet">
                                <input type="radio" name="metode_pembayaran" value="ewallet" class="w-4 h-4 text-primary accent-primary metode-radio">
                                <div class="flex-1">
                                    <p class="font-semibold text-text-main group-hover:text-primary transition-colors duration-200 text-sm">E-Wallet / QRIS</p>
                                    <p class="text-xs text-text-muted">Dana / OVO / GoPay / M-Banking</p>
                                </div>
                                <i class="fas fa-mobile-alt text-border-subtle group-hover:text-primary transition-colors duration-200 text-sm"></i>
                            </label>
                        </div>

                        <!-- QRIS SECTION -->
                        <div id="qrisSection" class="mt-3 p-3 bg-background/40 rounded-2xl border border-border-subtle/20 hidden">
                            <div class="text-center">
                                <img src="<?php echo base_url('assets/img/qris.jpeg'); ?>" alt="QRIS NINGNONG" class="w-full max-w-[480px] h-auto mx-auto rounded-xl shadow-sm border border-border-subtle/20">
                                <p class="text-sm text-text-muted mt-2">Scan QRIS berikut untuk melakukan pembayaran</p>
                                <p class="text-xs text-text-subtle mt-1">Setelah transfer, upload bukti pembayaran di kolom kiri</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- ========== MODAL TRANSFER BANK ========== -->
<div id="modalTransfer" class="fixed inset-0 z-[9999] bg-black/40 backdrop-blur-sm flex items-center justify-center hidden p-4" onclick="closeModalTransfer(event)">
    <div class="bg-surface rounded-3xl max-w-md w-full shadow-2xl border border-border-subtle/20 overflow-hidden" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between p-5 border-b border-border-subtle/20">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-gradient-to-br from-primary to-primary-hover rounded-xl flex items-center justify-center text-white shadow-md shadow-primary/20">
                    <i class="fas fa-university text-xs"></i>
                </div>
                <div>
                    <h3 class="font-bold text-text-main text-sm">Transfer Bank</h3>
                    <p class="text-xs text-text-muted">Pilih rekening tujuan transfer</p>
                </div>
            </div>
            <button onclick="closeModalTransfer()" class="w-7 h-7 rounded-full bg-background hover:bg-secondary-light flex items-center justify-center text-text-muted hover:text-text-main transition-all duration-200">
                <i class="fas fa-times text-xs"></i>
            </button>
        </div>
        <div class="p-5">
            <div class="bg-background/60 rounded-2xl p-4 border border-border-subtle/20">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-9 h-9 bg-gradient-to-br from-primary to-primary-hover rounded-xl flex items-center justify-center text-white shadow-md">
                        <i class="fas fa-university text-xs"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-text-main text-sm">BJB</p>
                    </div>
                </div>
                <div class="flex items-center justify-between bg-surface rounded-xl px-4 py-2.5 border border-border-subtle/20 mb-2">
                    <span class="font-mono font-bold text-primary text-sm select-all">0100515393100</span>
                    <button onclick="copyText(this, '0100515393100')" class="px-3 py-1.5 bg-primary text-white rounded-lg text-xs font-medium hover:bg-primary-hover transition flex items-center gap-1.5 flex-shrink-0">
                        <i class="fas fa-copy"></i> Salin
                    </button>
                </div>
                <p class="text-xs text-text-subtle">a.n. <span class="font-semibold text-text-main">SURATININGSIH</span></p>
            </div>
        </div>
        <div class="px-5 pb-5">
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
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModalTransfer();
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

// ===== UPLOAD AREA CLICK HANDLER =====
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('bukti_pembayaran');
    const filePreview = document.getElementById('filePreview');
    const fileName = document.getElementById('fileName');
    const fileLabel = document.getElementById('fileLabel');

    if (uploadArea && fileInput) {
        uploadArea.addEventListener('click', function(e) {
            if (e.target !== fileInput) fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                fileName.textContent = file.name;
                filePreview.classList.remove('hidden');
                fileLabel.textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
                // Sembunyikan error saat user memilih file
                const uploadError = document.getElementById('uploadError');
                if (uploadError) uploadError.classList.add('hidden');
                if (uploadArea) uploadArea.classList.remove('border-red-400', 'bg-red-50/20');
            } else {
                removeFile();
            }
        });
    }

    // ===== VALIDASI BUKTI PEMBAYARAN + HIGHLIGHT METODE + QRIS =====
    const metodeRadios = document.querySelectorAll('.metode-radio');
    const buktiInput = document.getElementById('bukti_pembayaran');
    const wajibLabel = document.getElementById('wajibBukti');
    const uploadError = document.getElementById('uploadError');
    const qrisSection = document.getElementById('qrisSection');
    const metodeLabels = document.querySelectorAll('.metode-label');
    const btnSubmit = document.getElementById('btnSubmit');

    // Daftar field wajib yang harus diisi
    const requiredFields = [
        document.querySelector('input[name="nama_penerima"]'),
        document.querySelector('input[name="no_hp"]'),
        document.querySelector('textarea[name="alamat"]'),
        document.querySelector('input[name="tanggal_kirim"]')
    ];

    function checkFormValidity() {
        const selected = document.querySelector('.metode-radio:checked');
        const metode = selected ? selected.value : null;

        // COD: tombol SELALU enabled (tidak peduli bukti pembayaran)
        if (metode === 'cod') {
            btnSubmit.removeAttribute('disabled');
            return;
        }

        // Transfer / E-Wallet: tombol disabled sampai file bukti diupload
        if (metode === 'transfer' || metode === 'ewallet') {
            const hasFile = buktiInput && buktiInput.files && buktiInput.files[0];
            if (hasFile) {
                btnSubmit.removeAttribute('disabled');
            } else {
                btnSubmit.setAttribute('disabled', 'disabled');
            }
            return;
        }

        // Fallback: jika tidak ada metode terpilih
        btnSubmit.setAttribute('disabled', 'disabled');
    }

    function updateMetodeUI() {
        const selected = document.querySelector('.metode-radio:checked');
        if (!selected) return;

        const metode = selected.value;

        // 1. Validasi bukti pembayaran
        if (metode === 'transfer' || metode === 'ewallet') {
            wajibLabel.classList.remove('hidden');
        } else {
            wajibLabel.classList.add('hidden');
            uploadError.classList.add('hidden');
            if (uploadArea) uploadArea.classList.remove('border-red-400', 'bg-red-50/20');
        }

        // 2. Tampilkan/sembunyikan QRIS
        if (qrisSection) {
            if (metode === 'ewallet') {
                qrisSection.classList.remove('hidden');
            } else {
                qrisSection.classList.add('hidden');
            }
        }

        // 3. Highlight card yang dipilih (border hijau)
        metodeLabels.forEach(function(label) {
            label.classList.remove('border-green-500', 'bg-green-50/50');
            label.classList.add('border-border-subtle/30');
        });
        metodeLabels.forEach(function(label) {
            const radio = label.querySelector('.metode-radio');
            if (radio && radio.checked) {
                label.classList.remove('border-border-subtle/30');
                label.classList.add('border-green-500', 'bg-green-50/50');
            }
        });

        // 4. Cek validitas form untuk enable/disable tombol
        checkFormValidity();
    }

    metodeRadios.forEach(function(radio) {
        radio.addEventListener('change', updateMetodeUI);
    });

    // Event listener untuk field wajib
    requiredFields.forEach(function(field) {
        if (field) {
            field.addEventListener('input', checkFormValidity);
            field.addEventListener('change', checkFormValidity);
        }
    });

    // Event listener untuk file upload
    if (buktiInput) {
        buktiInput.addEventListener('change', function() {
            // Sembunyikan error visual saat user pilih file
            if (this.files && this.files[0]) {
                uploadError.classList.add('hidden');
                if (uploadArea) uploadArea.classList.remove('border-red-400', 'bg-red-50/20');
            }
            checkFormValidity();
        });
    }

    updateMetodeUI();

    // ===== VALIDASI FORM SEBELUM SUBMIT =====
    document.getElementById('formCheckout').addEventListener('submit', function(e) {
        const selected = document.querySelector('.metode-radio:checked');
        if (!selected) {
            e.preventDefault();
            alert('Silakan pilih metode pembayaran terlebih dahulu.');
            return;
        }

        const metode = selected.value;

        if (metode === 'transfer' || metode === 'ewallet') {
            if (!buktiInput.files || !buktiInput.files[0]) {
                e.preventDefault();
                uploadError.classList.remove('hidden');
                if (uploadArea) {
                    uploadArea.classList.add('border-red-400', 'bg-red-50/20');
                    uploadArea.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
                return;
            } else {
                uploadError.classList.add('hidden');
                if (uploadArea) uploadArea.classList.remove('border-red-400', 'bg-red-50/20');
            }
        }
    });

    // ===== EVENT: Klik opsi pembayaran → buka modal =====
    document.querySelectorAll('[data-metode]').forEach(function(label) {
        label.addEventListener('click', function() {
            const metode = this.dataset.metode;
            const radio = this.querySelector('.metode-radio');
            if (radio) radio.checked = true;
            updateMetodeUI();
            if (metode === 'transfer') {
                setTimeout(openModalTransfer, 150);
            }
        });
    });
});

// ===== REMOVE FILE =====
function removeFile() {
    const fileInput = document.getElementById('bukti_pembayaran');
    const filePreview = document.getElementById('filePreview');
    const fileLabel = document.getElementById('fileLabel');
    if (fileInput) fileInput.value = '';
    if (filePreview) filePreview.classList.add('hidden');
    if (fileLabel) fileLabel.textContent = 'Format: JPG, PNG, WEBP (Max 2MB)';
    // Trigger re-check validitas form agar tombol disabled kembali
    document.querySelector('.metode-radio') && document.dispatchEvent(new Event('change'));
}
</script>

<?php $this->load->view('templates/footer_pelanggan'); ?>