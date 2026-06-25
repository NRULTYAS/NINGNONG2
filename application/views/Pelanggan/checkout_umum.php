<?php $this->load->view('templates/header_pelanggan'); ?>

<!-- Breadcrumb -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
    <nav class="flex items-center gap-2 text-sm text-text-muted">
        <a href="<?php echo base_url('home'); ?>" class="hover:text-primary transition-colors duration-200">Beranda</a>
        <span class="text-text-subtle">/</span>
        <a href="<?php echo base_url('produk'); ?>" class="hover:text-primary transition-colors duration-200">Pilih Paket</a>
        <span class="text-text-subtle">/</span>
        <span class="text-text-main font-medium">Checkout</span>
    </nav>
</div>

<section class="py-12 bg-background min-h-screen relative overflow-hidden">
    <div class="absolute top-0 right-0 w-72 h-72 bg-secondary-light/15 blob opacity-30"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

        <?php if ($this->session->flashdata('error')): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-5 text-sm flex items-center gap-2">
            <i class="fas fa-exclamation-circle"></i> <?php echo $this->session->flashdata('error'); ?>
        </div>
        <?php endif; ?>

        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-secondary-light/40 text-primary rounded-full text-sm font-medium mb-3 border border-secondary/20">
                <i class="fas fa-credit-card text-accent text-xs"></i> Checkout
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-text-main mb-2 font-heading">Selesaikan Pesanan</h1>
            <p class="text-text-muted">Isi data pengiriman dan konfirmasi pesanan</p>
        </div>

        <form action="<?php echo base_url('checkout_umum/proses'); ?>" method="post" enctype="multipart/form-data" class="contents">
        <div class="grid lg:grid-cols-2 gap-6">
            <!-- Kolom Kiri: Data Pengiriman + Catatan + Upload -->
            <div class="space-y-6">
                <!-- Informasi Pengiriman -->
                <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-6 border border-border-subtle/20 shadow-sm">
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
                            <label class="block text-sm font-medium text-text-main mb-2">No. HP <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-text-subtle"></i>
                                <input type="text" name="no_hp" value="<?php echo set_value('no_hp', $user->no_hp ?? ''); ?>" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-text-main mb-2">Alamat Pengiriman <span class="text-red-500">*</span></label>
                        <textarea name="alamat" required rows="3" class="w-full px-4 py-3 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200"><?php echo set_value('alamat', $user->alamat ?? ''); ?></textarea>
                    </div>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-2">Tanggal Pengiriman <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-calendar-alt absolute left-4 top-1/2 -translate-y-1/2 text-text-subtle"></i>
                                <input type="date" name="tanggal_kirim" value="<?php echo set_value('tanggal_kirim'); ?>" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200" min="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-2">
                                <?php
                                $qty_label = 'Jumlah';
                                $qty_min = 1;
                                if (($order['type'] ?? '') === 'snack_box') { $qty_label = 'Jumlah Dus'; $qty_min = 15; }
                                if (($order['type'] ?? '') === 'catering') { $qty_label = 'Jumlah Box'; $qty_min = 25; }
                                echo $qty_label;
                                ?>
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="jumlah" value="<?php echo set_value('jumlah', $order['jumlah'] ?? ($order['jumlah_dus'] ?? ($order['jumlah_box'] ?? 1))); ?>" min="<?php echo $qty_min; ?>" required class="w-full px-4 py-3 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200">
                            <p class="text-xs text-text-subtle mt-1"><?php echo ($order['type'] ?? '') === 'catering' ? 'Minimal 25 box' : (($order['type'] ?? '') === 'snack_box' ? 'Minimal 15 dus' : 'Minimal 1'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Catatan Tambahan -->
                <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-6 border border-border-subtle/20 shadow-sm">
                    <h3 class="font-bold text-text-main mb-4 text-lg flex items-center gap-3 font-heading">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-500 rounded-xl flex items-center justify-center text-white shadow-md shadow-green-500/20">
                            <i class="fas fa-sticky-note text-sm"></i>
                        </div>
                        Catatan Tambahan
                    </h3>
                    <textarea name="catatan" rows="3" class="w-full px-4 py-3 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200" placeholder="Catatan untuk pesanan (opsional)"><?php echo set_value('catatan'); ?></textarea>
                </div>

                <!-- Bukti Pembayaran -->
                <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-6 border border-border-subtle/20 shadow-sm">
                    <h3 class="font-bold text-text-main mb-4 text-lg flex items-center gap-3 font-heading">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-500 rounded-xl flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                            <i class="fas fa-upload text-sm"></i>
                        </div>
                        Bukti Pembayaran (Opsional)
                    </h3>
                    <div class="border-2 border-dashed border-primary/30 rounded-xl p-6 text-center hover:border-primary/40 transition-colors duration-200 bg-background/20">
                        <input type="file" name="bukti_pembayaran" accept="image/*" class="hidden" id="bukti-upload">
                        <label for="bukti-upload" class="cursor-pointer flex flex-col items-center">
                            <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mb-3">
                                <i class="fas fa-cloud-upload-alt text-primary text-xl"></i>
                            </div>
                            <p class="text-sm font-medium text-text-main">Klik untuk upload bukti pembayaran</p>
                            <p class="text-xs text-text-subtle mt-1">JPG, PNG, WEBP (Max 2MB)</p>
                        </label>
                        <div id="file-preview" class="mt-3 hidden">
                            <img id="preview-img" src="" alt="Preview" class="max-h-32 mx-auto rounded-lg border border-border-subtle/20">
                            <p id="file-name" class="text-xs text-text-subtle mt-1"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Pembayaran + Ringkasan (sticky) -->
            <div class="lg:sticky lg:top-24 lg:self-start space-y-6">
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
                            <input type="radio" name="metode_pembayaran" value="Transfer Bank" checked class="w-5 h-5 text-primary accent-primary metode-radio">
                            <div class="flex-1">
                                <p class="font-semibold text-text-main group-hover:text-primary transition-colors duration-200">Transfer Bank</p>
                                <p class="text-sm text-text-muted">BCA / Mandiri / BNI</p>
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
                                <p class="font-semibold text-text-main group-hover:text-primary transition-colors duration-200">E-Wallet / QRIS</p>
                                <p class="text-sm text-text-muted">Dana / OVO / GoPay / M-Banking</p>
                            </div>
                            <i class="fas fa-mobile-alt text-border-subtle group-hover:text-primary transition-colors duration-200"></i>
                        </label>
                    </div>
                </div>

                <!-- Card Ringkasan Pesanan + Total + Submit -->
                <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-6 border border-border-subtle/20 shadow-sm">
                    <h3 class="font-bold text-text-main mb-4 text-lg font-heading">Ringkasan Pesanan</h3>
                    <div class="bg-background/40 rounded-xl p-4 mb-4 border border-border-subtle/20">
                        <p class="font-bold text-text-main"><?php echo $order['nama_produk'] ?? $order['nama_paket'] ?? 'Produk'; ?></p>
                        <?php if (isset($order['jumlah'])): ?>
                        <p class="text-sm text-text-muted">Jumlah: <span class="font-semibold text-primary"><?php echo $order['jumlah']; ?></span></p>
                        <?php endif; ?>
                        <?php if (isset($order['jumlah_dus'])): ?>
                        <p class="text-sm text-text-muted">Jumlah Dus: <span class="font-semibold text-primary"><?php echo $order['jumlah_dus']; ?></span></p>
                        <?php endif; ?>
                        <?php if (isset($order['jumlah_box'])): ?>
                        <p class="text-sm text-text-muted">Jumlah Box: <span class="font-semibold text-primary"><?php echo $order['jumlah_box']; ?></span></p>
                        <?php endif; ?>
                        <?php if (isset($order['harga'])): ?>
                        <p class="text-sm text-text-muted">Harga: <span class="font-semibold text-primary">Rp <?php echo number_format($order['harga'], 0, ',', '.'); ?></span></p>
                        <?php endif; ?>
                        <?php if (isset($order['harga_per_box'])): ?>
                        <p class="text-sm text-text-muted">Harga per Box: <span class="font-semibold text-primary">Rp <?php echo number_format($order['harga_per_box'], 0, ',', '.'); ?></span></p>
                        <?php endif; ?>
                    </div>
                    <div class="border-t border-border-subtle/30 pt-4 mb-4">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-lg text-text-main">Total Pembayaran</span>
                            <span class="font-extrabold text-2xl text-primary" id="total-preview">Menghitung...</span>
                        </div>
                    </div>
                    <input type="hidden" name="jumlah" id="form-jumlah" value="<?php echo $order['jumlah'] ?? 1; ?>">
                    <input type="hidden" name="harga_satuan" id="form-harga" value="<?php echo $order['harga'] ?? $order['harga_per_box'] ?? $order['harga_per_dus'] ?? 0; ?>">
                    <button type="submit" class="block w-full py-3.5 bg-primary text-white rounded-full font-semibold hover:bg-primary-hover transition-all duration-200 hover:scale-[1.02] flex items-center justify-center gap-2 shadow-md shadow-primary/20">
                        <i class="fas fa-check-circle text-lg"></i> Konfirmasi Pesanan
                    </button>
                    <a href="<?php echo base_url('produk'); ?>" class="block w-full py-3 text-primary rounded-full font-medium hover:bg-background/80 transition-all duration-200 text-center mt-2 text-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali pilih produk
                    </a>
                </div>
            </div>
        </div>
        </form>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const order = <?php echo json_encode($order); ?>;
    const qtyInput = document.querySelector('input[name="jumlah"]');
    const totalEl = document.getElementById('total-preview');
    const hargaEl = document.getElementById('form-harga');
    const qtyForm = document.getElementById('form-jumlah');

    function getHargaSatuan() {
        if (order.type === 'pesan_satuan' || order.type === 'nyiru') {
            return parseInt(order.harga) || 0;
        }
        if (order.type === 'snack_box') {
            let sum = 0;
            (order.items || []).forEach(function(it) {
                sum += (parseInt(it.subtotal) || 0);
            });
            return sum;
        }
        if (order.type === 'catering') {
            return parseFloat(order.harga_per_box) || 0;
        }
        return 0;
    }

    function updateTotal() {
        const harga = getHargaSatuan();
        const qty = parseInt(qtyInput.value) || 1;
        hargaEl.value = harga;
        qtyForm.value = qty;
        const total = harga * qty;
        totalEl.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
    }

    if (qtyInput) {
        qtyInput.addEventListener('input', updateTotal);
        updateTotal();
    }

    // Frontend validation minimal order
    const btnSubmit = document.querySelector('button[type="submit"]');
    const orderType = order.type || '';
    const minOrder = orderType === 'catering' ? 25 : (orderType === 'snack_box' ? 15 : 1);

    function validateMin() {
        const qty = parseInt(qtyInput.value) || 0;
        if (qty < minOrder) {
            btnSubmit.disabled = true;
            btnSubmit.classList.add('opacity-50', 'cursor-not-allowed');
        } else {
            btnSubmit.disabled = false;
            btnSubmit.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    }

    if (qtyInput && btnSubmit) {
        qtyInput.addEventListener('input', validateMin);
        validateMin();
    }

    // Preview file upload bukti pembayaran
    const fileInput = document.getElementById('bukti-upload');
    const filePreview = document.getElementById('file-preview');
    const previewImg = document.getElementById('preview-img');
    const fileName = document.getElementById('file-name');

    if (fileInput) {
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    fileName.textContent = file.name;
                    filePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Toggle panel QRIS / Transfer Bank
    const metodeRadios = document.querySelectorAll('input[name="metode_pembayaran"]');
    const panelQris = document.getElementById('panel-qris');
    const panelTransfer = document.getElementById('panel-transfer');

    function toggleMetode() {
        const selected = document.querySelector('input[name="metode_pembayaran"]:checked');
        if (!selected) return;
        if (selected.value === 'QRIS') {
            panelQris.classList.remove('hidden');
            panelTransfer.classList.add('hidden');
        } else {
            panelQris.classList.add('hidden');
            panelTransfer.classList.remove('hidden');
        }
    }

    metodeRadios.forEach(r => r.addEventListener('change', toggleMetode));
    toggleMetode();
});

// Copy nomor rekening ke clipboard
function copyRekening(btn) {
    const text = btn.parentElement.querySelector('.font-mono').textContent;
    navigator.clipboard.writeText(text.replace(/[^0-9]/g, '')).then(function() {
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Tersalin';
        btn.classList.add('bg-green-500');
        setTimeout(function() {
            btn.innerHTML = originalHTML;
            btn.classList.remove('bg-green-500');
        }, 1500);
    });
}
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
