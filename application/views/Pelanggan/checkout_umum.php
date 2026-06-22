<?php $this->load->view('templates/header_pelanggan'); ?>

<!-- Breadcrumb -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
    <nav class="flex items-center gap-2 text-sm text-gray-500">
        <a href="<?php echo base_url('home'); ?>" class="hover:text-coklat-tua transition">Beranda</a>
        <span class="text-gray-400">/</span>
        <a href="<?php echo base_url('produk'); ?>" class="hover:text-coklat-tua transition">Pilih Paket</a>
        <span class="text-gray-400">/</span>
        <span class="text-gray-700 font-medium">Checkout</span>
    </nav>
</div>

<section class="py-12 bg-krem min-h-screen relative overflow-hidden">
    <div class="absolute top-0 right-0 w-72 h-72 bg-oranye-pastel/15 blob opacity-30"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

        <?php if ($this->session->flashdata('error')): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-5 text-sm flex items-center gap-2">
            <i class="fas fa-exclamation-circle"></i> <?php echo $this->session->flashdata('error'); ?>
        </div>
        <?php endif; ?>

        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-oranye-pastel/40 text-coklat-tua rounded-full text-sm font-medium mb-3 border border-oranye/20">
                <i class="fas fa-credit-card text-oranye text-xs"></i> Checkout
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-coklat-tua mb-2">Selesaikan Pesanan</h1>
            <p class="text-gray-400">Isi data pengiriman dan konfirmasi pesanan</p>
        </div>

        <form action="<?php echo base_url('checkout_umum/proses'); ?>" method="post" enctype="multipart/form-data" class="contents">
        <div class="grid lg:grid-cols-2 gap-6">
            <!-- Kolom Kiri: Data Pengiriman + Catatan + Upload -->
            <div class="space-y-6">
                <!-- Informasi Pengiriman -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-coklat-muda/20 shadow-sm">
                    <h3 class="font-bold text-gray-800 mb-5 text-lg flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-coklat-tua to-coklat rounded-xl flex items-center justify-center text-white shadow-md shadow-coklat-tua/20">
                            <i class="fas fa-truck text-sm"></i>
                        </div>
                        Informasi Pengiriman
                    </h3>
                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Penerima <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="nama_penerima" value="<?php echo set_value('nama_penerima', $user->nama ?? ''); ?>" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">No. HP <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="no_hp" value="<?php echo set_value('no_hp', $user->no_hp ?? ''); ?>" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Pengiriman <span class="text-red-500">*</span></label>
                        <textarea name="alamat" required rows="3" class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition"><?php echo set_value('alamat', $user->alamat ?? ''); ?></textarea>
                    </div>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengiriman <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-calendar-alt absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="date" name="tanggal_kirim" value="<?php echo set_value('tanggal_kirim'); ?>" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition" min="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <?php
                                $qty_label = 'Jumlah';
                                $qty_min = 1;
                                if (($order['type'] ?? '') === 'snack_box') { $qty_label = 'Jumlah Dus'; $qty_min = 15; }
                                if (($order['type'] ?? '') === 'catering') { $qty_label = 'Jumlah Box'; $qty_min = 25; }
                                echo $qty_label;
                                ?>
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="jumlah" value="<?php echo set_value('jumlah', $order['jumlah'] ?? ($order['jumlah_dus'] ?? ($order['jumlah_box'] ?? 1))); ?>" min="<?php echo $qty_min; ?>" required class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition">
                            <p class="text-xs text-gray-400 mt-1"><?php echo ($order['type'] ?? '') === 'catering' ? 'Minimal 25 box' : (($order['type'] ?? '') === 'snack_box' ? 'Minimal 15 dus' : 'Minimal 1'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Catatan Tambahan -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-coklat-muda/20 shadow-sm">
                    <h3 class="font-bold text-gray-800 mb-4 text-lg flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-500 rounded-xl flex items-center justify-center text-white shadow-md shadow-green-500/20">
                            <i class="fas fa-sticky-note text-sm"></i>
                        </div>
                        Catatan Tambahan
                    </h3>
                    <textarea name="catatan" rows="3" class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition" placeholder="Catatan untuk pesanan (opsional)"><?php echo set_value('catatan'); ?></textarea>
                </div>

                <!-- Bukti Pembayaran -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-coklat-muda/20 shadow-sm">
                    <h3 class="font-bold text-gray-800 mb-4 text-lg flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-500 rounded-xl flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                            <i class="fas fa-upload text-sm"></i>
                        </div>
                        Bukti Pembayaran (Opsional)
                    </h3>
                    <div class="border-2 border-dashed border-coklat-muda/40 rounded-xl p-6 text-center hover:border-coklat-tua/40 transition bg-krem/20">
                        <input type="file" name="bukti_pembayaran" accept="image/*" class="hidden" id="bukti-upload">
                        <label for="bukti-upload" class="cursor-pointer flex flex-col items-center">
                            <div class="w-12 h-12 rounded-full bg-coklat-muda/20 flex items-center justify-center mb-3">
                                <i class="fas fa-cloud-upload-alt text-coklat-tua text-xl"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">Klik untuk upload bukti pembayaran</p>
                            <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP (Max 2MB)</p>
                        </label>
                        <div id="file-preview" class="mt-3 hidden">
                            <img id="preview-img" src="" alt="Preview" class="max-h-32 mx-auto rounded-lg border border-coklat-muda/20">
                            <p id="file-name" class="text-xs text-gray-500 mt-1"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Pembayaran + Ringkasan (sticky) -->
            <div class="lg:sticky lg:top-24 lg:self-start space-y-6">
                <!-- Card Pembayaran (Radio + Konten) -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-coklat-muda/20 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-coklat-muda/20">
                        <h3 class="font-bold text-gray-800 mb-4 text-lg flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-purple-500 rounded-xl flex items-center justify-center text-white shadow-md shadow-purple-500/20">
                                <i class="fas fa-credit-card text-sm"></i>
                            </div>
                            Pilihan Pembayaran
                        </h3>
                        <div class="space-y-3">
                            <label class="flex items-center gap-4 p-4 rounded-xl border-2 border-coklat-muda/30 cursor-pointer hover:border-coklat-tua/40 transition group metode-option" data-metode="qris">
                                <input type="radio" name="metode_pembayaran" value="QRIS" checked class="w-5 h-5 text-coklat-tua accent-coklat-tua">
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-800 group-hover:text-coklat-tua transition">QRIS</p>
                                    <p class="text-sm text-gray-400">Scan QR Code untuk pembayaran</p>
                                </div>
                                <i class="fas fa-qrcode text-coklat-muda text-xl"></i>
                            </label>
                            <label class="flex items-center gap-4 p-4 rounded-xl border-2 border-coklat-muda/30 cursor-pointer hover:border-coklat-tua/40 transition group metode-option" data-metode="transfer">
                                <input type="radio" name="metode_pembayaran" value="Transfer Bank" class="w-5 h-5 text-coklat-tua accent-coklat-tua">
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-800 group-hover:text-coklat-tua transition">Transfer Bank</p>
                                    <p class="text-sm text-gray-400">BCA / Mandiri / BNI</p>
                                </div>
                                <i class="fas fa-university text-coklat-muda text-xl"></i>
                            </label>
                        </div>
                    </div>

                    <!-- Panel Konten Pembayaran -->
                    <div class="p-6 bg-krem/30">
                        <!-- QRIS Panel -->
                        <div id="panel-qris" class="text-center">
                            <div class="w-40 h-40 bg-white rounded-2xl border-2 border-coklat-muda/30 mx-auto mb-3 flex items-center justify-center overflow-hidden shadow-sm">
                                <?php if (file_exists(FCPATH . 'assets/img/qris.png')): ?>
                                <img src="<?php echo base_url('assets/img/qris.png'); ?>" alt="QRIS" class="w-full h-full object-contain">
                                <?php else: ?>
                                <div class="text-center text-gray-400">
                                    <i class="fas fa-qrcode text-4xl mb-2"></i>
                                    <p class="text-xs">QRIS akan ditampilkan di sini</p>
                                </div>
                                <?php endif; ?>
                            </div>
                            <p class="text-xs text-gray-500">Scan QRIS untuk pembayaran</p>
                        </div>

                        <!-- Transfer Bank Panel -->
                        <div id="panel-transfer" class="hidden">
                            <div class="bg-white rounded-xl p-4 border border-coklat-muda/20 space-y-3">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Nama Bank</p>
                                    <p class="font-bold text-gray-800">[PLACEHOLDER_NAMA_BANK]</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Nomor Rekening</p>
                                    <div class="flex items-center gap-2">
                                        <p class="font-mono font-bold text-coklat-tua text-lg select-all">[PLACEHOLDER_NO_REKENING]</p>
                                        <button type="button" onclick="copyRekening(this)" class="px-3 py-1.5 bg-coklat-tua text-white rounded-lg text-xs font-medium hover:bg-coklat transition flex items-center gap-1 flex-shrink-0">
                                            <i class="fas fa-copy"></i> Salin
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Atas Nama</p>
                                    <p class="font-semibold text-gray-800">[PLACEHOLDER_NAMA_PEMILIK]</p>
                                </div>
                            </div>
                            <p class="text-xs text-gray-400 text-center mt-3">* Silakan transfer sesuai nominal dan upload bukti pembayaran di kolom sebelah</p>
                        </div>
                    </div>
                </div>

                <!-- Card Ringkasan Pesanan + Total + Submit -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-coklat-muda/20 shadow-sm">
                    <h3 class="font-bold text-gray-800 mb-4 text-lg">Ringkasan Pesanan</h3>
                    <div class="bg-krem/40 rounded-xl p-4 mb-4 border border-coklat-muda/20">
                        <p class="font-bold text-gray-800"><?php echo $order['nama_produk'] ?? $order['nama_paket'] ?? 'Produk'; ?></p>
                        <?php if (isset($order['jumlah'])): ?>
                        <p class="text-sm text-gray-500">Jumlah: <span class="font-semibold text-coklat-tua"><?php echo $order['jumlah']; ?></span></p>
                        <?php endif; ?>
                        <?php if (isset($order['jumlah_dus'])): ?>
                        <p class="text-sm text-gray-500">Jumlah Dus: <span class="font-semibold text-coklat-tua"><?php echo $order['jumlah_dus']; ?></span></p>
                        <?php endif; ?>
                        <?php if (isset($order['jumlah_box'])): ?>
                        <p class="text-sm text-gray-500">Jumlah Box: <span class="font-semibold text-coklat-tua"><?php echo $order['jumlah_box']; ?></span></p>
                        <?php endif; ?>
                        <?php if (isset($order['harga'])): ?>
                        <p class="text-sm text-gray-500">Harga: <span class="font-semibold text-coklat-tua">Rp <?php echo number_format($order['harga'], 0, ',', '.'); ?></span></p>
                        <?php endif; ?>
                        <?php if (isset($order['harga_per_box'])): ?>
                        <p class="text-sm text-gray-500">Harga per Box: <span class="font-semibold text-coklat-tua">Rp <?php echo number_format($order['harga_per_box'], 0, ',', '.'); ?></span></p>
                        <?php endif; ?>
                    </div>
                    <div class="border-t border-coklat-muda/30 pt-4 mb-4">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-lg text-gray-800">Total Pembayaran</span>
                            <span class="font-extrabold text-2xl text-coklat-tua" id="total-preview">Menghitung...</span>
                        </div>
                    </div>
                    <input type="hidden" name="jumlah" id="form-jumlah" value="<?php echo $order['jumlah'] ?? 1; ?>">
                    <input type="hidden" name="harga_satuan" id="form-harga" value="<?php echo $order['harga'] ?? $order['harga_per_box'] ?? $order['harga_per_dus'] ?? 0; ?>">
                    <button type="submit" class="block w-full py-3.5 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-coklat-tua/25 transition-all hover:scale-[1.02] flex items-center justify-center gap-2">
                        <i class="fas fa-check-circle text-lg"></i> Konfirmasi Pesanan
                    </button>
                    <a href="<?php echo base_url('produk'); ?>" class="block w-full py-3 text-coklat-tua rounded-xl font-medium hover:bg-krem/80 transition text-center mt-2 text-sm">
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

<?php $this->load->view('templates/footer_pelanggan'); ?>
