<?php $this->load->view('templates/header_admin'); ?>

<div class="flex items-center gap-3 py-6">
    <div class="w-12 h-12 rounded-2xl bg-accent flex items-center justify-center text-white shadow-md shadow-accent/20">
        <i class="fas fa-file-invoice-dollar text-lg"></i>
    </div>
    <div>
        <h1 class="text-2xl font-bold text-primary font-heading">Laporan Penjualan</h1>
        <p class="text-text-muted">Ringkasan pesanan berdasarkan rentang tanggal</p>
    </div>
</div>

<div class="bg-surface rounded-2xl shadow-sm border border-border-subtle p-6 mb-6">
    <form method="get" action="<?php echo base_url('admin/laporan'); ?>" class="flex flex-col sm:flex-row items-end gap-3">
        <div class="flex-1 w-full">
            <label class="block text-sm font-medium text-text-main mb-1.5">Dari Tanggal</label>
            <input type="date" name="dari" value="<?php echo $dari ?? ''; ?>" required class="w-full px-4 py-2.5 rounded-xl border border-border-subtle focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-background/30 transition-colors duration-200">
        </div>
        <div class="flex-1 w-full">
            <label class="block text-sm font-medium text-text-main mb-1.5">Sampai Tanggal</label>
            <input type="date" name="sampai" value="<?php echo $sampai ?? ''; ?>" required class="w-full px-4 py-2.5 rounded-xl border border-border-subtle focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-background/30 transition-colors duration-200">
        </div>
        <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-primary text-white rounded-xl font-medium hover:bg-primary-hover transition-all duration-200 flex items-center justify-center gap-2 shadow-md shadow-primary/20">
            <i class="fas fa-search text-sm"></i> Tampilkan
        </button>
        <?php if (isset($dari) && $dari && isset($sampai) && $sampai): ?>
        <a href="<?php echo base_url('admin/laporan/cetak?dari='.$dari.'&sampai='.$sampai); ?>" target="_blank" class="w-full sm:w-auto px-6 py-2.5 bg-accent text-white rounded-xl font-medium hover:bg-accent-hover transition-all duration-200 flex items-center justify-center gap-2 shadow-md shadow-accent/20">
            <i class="fas fa-print text-sm"></i> Cetak Laporan
        </a>
        <?php endif; ?>
    </form>
</div>

<?php if (isset($dari) && isset($sampai) && $dari && $sampai): ?>
<div class="bg-surface rounded-2xl shadow-sm border border-border-subtle p-6 mb-6 flex items-center justify-between">
    <div>
        <p class="text-text-muted mb-1">Total Pendapatan</p>
        <h2 class="text-3xl font-bold text-primary font-heading">Rp <?php echo number_format($total_pendapatan,0,',','.'); ?></h2>
        <p class="text-sm text-text-subtle mt-1">Periode: <?php echo date('d M Y', strtotime($dari)); ?> - <?php echo date('d M Y', strtotime($sampai)); ?></p>
    </div>
    <div class="w-14 h-14 rounded-2xl bg-accent flex items-center justify-center text-white shadow-md shadow-accent/20">
        <i class="fas fa-wallet text-xl"></i>
    </div>
</div>

<div class="bg-surface rounded-2xl shadow-sm border border-border-subtle overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-accent-light">
                    <th class="px-6 py-4 font-semibold text-text-main">Kode</th>
                    <th class="px-6 py-4 font-semibold text-text-main">Pelanggan</th>
                    <th class="px-6 py-4 font-semibold text-text-main">Total</th>
                    <th class="px-6 py-4 font-semibold text-text-main">Metode</th>
                    <th class="px-6 py-4 font-semibold text-text-main">Bukti Pembayaran</th>
                    <th class="px-6 py-4 font-semibold text-text-main">Status</th>
                    <th class="px-6 py-4 font-semibold text-text-main">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-subtle">
                <?php if (!empty($laporan)): ?>
                    <?php foreach($laporan as $p): ?>
                    <tr class="hover:bg-accent-light/40 transition">
                        <td class="px-6 py-4 font-bold text-primary"><?php echo $p->kode_pesanan; ?></td>
                        <td class="px-6 py-4 text-text-muted">
                            <p class="font-semibold text-text-main"><?php echo $p->nama_penerima; ?></p>
                            <p class="text-sm text-text-subtle"><?php echo $p->no_hp_penerima; ?></p>
                        </td>
                        <td class="px-6 py-4 font-bold text-primary">Rp <?php echo number_format($p->total_harga,0,',','.'); ?></td>
                        <td class="px-6 py-4 text-text-muted">
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-lg text-xs font-medium bg-accent-light border border-border-subtle">
                                <i class="fas fa-wallet text-primary/60"></i> <?php echo $p->metode_pembayaran; ?>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <?php if (!empty($p->bukti_pembayaran)): ?>
                                <?php
                                    $filePath = FCPATH . 'assets/upload/' . $p->bukti_pembayaran;
                                    $fileUrl = base_url('assets/upload/' . $p->bukti_pembayaran);
                                    $fileExists = file_exists($filePath);
                                ?>
                                <?php if ($fileExists): ?>
                                    <img 
                                        src="<?php echo $fileUrl; ?>" 
                                        alt="Bukti Pembayaran" 
                                        class="w-[70px] h-[70px] object-cover rounded-lg border border-border-subtle cursor-pointer hover:opacity-80 transition-opacity"
                                        onclick="openBuktiModal('<?php echo $fileUrl; ?>', '<?php echo htmlspecialchars($p->kode_pesanan, ENT_QUOTES); ?>')"
                                        title="Klik untuk memperbesar"
                                    >
                                <?php else: ?>
                                    <span class="text-xs text-red-500">File tidak ditemukan</span>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="text-xs text-text-subtle">Tidak ada bukti</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold border
                                <?php 
                                switch($p->status) {
                                    case 'pending': echo 'bg-accent-light text-accent border-accent-light'; break;
                                    case 'diproses': echo 'bg-secondary-light text-secondary border-border-subtle'; break;
                                    case 'dikirim': echo 'bg-purple-50 text-purple-600 border-purple-100'; break;
                                    case 'selesai': echo 'bg-secondary-light text-secondary border-border-subtle'; break;
                                    case 'dibatalkan': echo 'bg-red-50 text-red-700 border-red-200'; break;
                                }
                                ?>">
                                <span class="w-1.5 h-1.5 rounded-full
                                    <?php 
                                    switch($p->status) {
                                        case 'pending': echo 'bg-accent'; break;
                                        case 'diproses': echo 'bg-secondary'; break;
                                        case 'dikirim': echo 'bg-purple-500'; break;
                                        case 'selesai': echo 'bg-secondary'; break;
                                        case 'dibatalkan': echo 'bg-red-500'; break;
                                    }
                                    ?>"></span>
                                <?php echo ucfirst($p->status); ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-text-subtle text-sm"><?php echo date('d M Y', strtotime($p->created_at)); ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-text-muted">Tidak ada data laporan untuk rentang tanggal ini</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <?php if (!empty($laporan)): ?>
            <tfoot>
                <tr class="bg-accent-light font-bold">
                    <td class="px-6 py-4 text-text-main">TOTAL</td>
                    <td></td>
                    <td class="px-6 py-4 text-primary">Rp <?php echo number_format($total_pendapatan,0,',','.'); ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
            <?php endif; ?>
        </table>
    </div>
</div>
<?php endif; ?>

<!-- Modal Bukti Pembayaran -->
<div id="buktiModal" class="fixed inset-0 z-[9999] bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4" onclick="closeBuktiModal(event)">
    <div class="bg-surface rounded-3xl max-w-lg w-full shadow-2xl border border-border-subtle/20 overflow-hidden" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between p-6 border-b border-border-subtle/20">
            <div>
                <h3 class="font-bold text-text-main font-heading">Bukti Pembayaran</h3>
                <p id="buktiModalKode" class="text-xs text-text-subtle"></p>
            </div>
            <div class="flex items-center gap-2">
                <a id="buktiModalLink" href="#" target="_blank" class="px-3 py-1.5 bg-primary text-white rounded-lg text-xs font-medium hover:bg-primary-hover transition flex items-center gap-1.5">
                    <i class="fas fa-external-link-alt"></i> Buka Tab Baru
                </a>
                <button onclick="closeBuktiModal()" class="w-8 h-8 rounded-full bg-background hover:bg-secondary-light flex items-center justify-center text-text-muted hover:text-text-main transition-all duration-200">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
        </div>
        <div class="p-6 text-center">
            <img id="buktiModalImg" src="" alt="Bukti Pembayaran" class="max-w-full max-h-[60vh] mx-auto rounded-xl border border-border-subtle/20 shadow-sm">
        </div>
    </div>
</div>

<script>
function openBuktiModal(url, kode) {
    const modal = document.getElementById('buktiModal');
    const img = document.getElementById('buktiModalImg');
    const kodeEl = document.getElementById('buktiModalKode');
    const link = document.getElementById('buktiModalLink');
    img.src = url;
    kodeEl.textContent = 'Kode Pesanan: ' + kode;
    link.href = url;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeBuktiModal(e) {
    if (e && e.target !== e.currentTarget) return;
    const modal = document.getElementById('buktiModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') { closeBuktiModal(); }
});
</script>

<?php $this->load->view('templates/footer_admin'); ?>