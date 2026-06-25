<?php $this->load->view('templates/header_admin'); ?>

<div class="flex items-center gap-3 py-6">
    <div class="w-12 h-12 rounded-2xl bg-secondary flex items-center justify-center text-white shadow-md shadow-secondary/20">
        <i class="fas fa-chart-line text-lg"></i>
    </div>
    <div>
        <h1 class="text-2xl font-bold text-primary font-heading">Laporan Penjualan</h1>
        <p class="text-text-muted">Lihat laporan penjualan berdasarkan periode</p>
    </div>
</div>

<div class="bg-surface rounded-2xl shadow-sm border border-border-subtle p-6 mb-8">
    <form action="<?php echo base_url('admin/laporan'); ?>" method="get" class="flex flex-wrap gap-6 items-end">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-semibold text-text-main mb-2 flex items-center gap-2">
                <div class="w-5 h-5 rounded-md bg-primary flex items-center justify-center text-white text-[10px]"><i class="fas fa-calendar-alt"></i></div>
                Dari Tanggal
            </label>
            <input type="date" name="dari" value="<?php echo $dari; ?>" required class="w-full px-4 py-3 rounded-xl border border-border-subtle focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-surface shadow-sm transition">
        </div>
        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-semibold text-text-main mb-2 flex items-center gap-2">
                <div class="w-5 h-5 rounded-md bg-primary flex items-center justify-center text-white text-[10px]"><i class="fas fa-calendar-check"></i></div>
                Sampai Tanggal
            </label>
            <input type="date" name="sampai" value="<?php echo $sampai; ?>" required class="w-full px-4 py-3 rounded-xl border border-border-subtle focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-surface shadow-sm transition">
        </div>
        <button type="submit" class="px-6 py-3 bg-primary text-white rounded-xl font-semibold shadow-lg shadow-primary/25 hover:shadow-xl hover:shadow-primary/30 hover:scale-[1.02] transition-all flex items-center gap-2">
            <i class="fas fa-search"></i> Tampilkan
        </button>
    </form>
</div>

<?php if($dari && $sampai): ?>
<div class="bg-surface rounded-2xl shadow-sm border border-border-subtle overflow-hidden">
    <div class="p-6 border-b border-border-subtle flex justify-between items-center bg-accent-light/50">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-secondary flex items-center justify-center text-white shadow-md">
                <i class="fas fa-file-invoice"></i>
            </div>
            <h3 class="font-heading font-bold text-lg text-primary">Hasil Laporan</h3>
        </div>
        <span class="text-sm text-text-muted bg-surface px-3 py-1 rounded-lg border border-border-subtle shadow-sm">
            <?php echo date('d M Y', strtotime($dari)); ?> - <?php echo date('d M Y', strtotime($sampai)); ?>
        </span>
    </div>
    <?php if(empty($laporan)): ?>
    <div class="py-16 text-center">
        <div class="w-20 h-20 bg-secondary/20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-inner">
            <i class="fas fa-file-invoice text-3xl text-primary/40"></i>
        </div>
        <p class="text-text-muted font-medium">Tidak ada data penjualan pada periode ini</p>
    </div>
    <?php else: ?>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-accent-light">
                    <th class="px-6 py-4 font-semibold text-text-main">Kode Pesanan</th>
                    <th class="px-6 py-4 font-semibold text-text-main">Pelanggan</th>
                    <th class="px-6 py-4 font-semibold text-text-main">Total</th>
                    <th class="px-6 py-4 font-semibold text-text-main">Status</th>
                    <th class="px-6 py-4 font-semibold text-text-main">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-subtle">
                <?php 
                $total_semua = 0;
                foreach($laporan as $l): 
                    $total_semua += $l->total_harga;
                ?>
                <tr class="hover:bg-accent-light/40 transition">
                    <td class="px-6 py-4 font-bold text-primary"><?php echo $l->kode_pesanan; ?></td>
                    <td class="px-6 py-4 text-text-muted"><?php echo $l->nama_penerima; ?></td>
                    <td class="px-6 py-4 font-bold text-primary">Rp <?php echo number_format($l->total_harga,0,',','.'); ?></td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold border bg-secondary-light text-secondary border-border-subtle">
                            <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                            <?php echo ucfirst($l->status); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-text-subtle text-sm"><?php echo date('d M Y H:i', strtotime($l->created_at)); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="bg-primary text-white">
                    <td colspan="2" class="px-6 py-5 text-right font-semibold">Total Penjualan:</td>
                    <td colspan="3" class="px-6 py-5 text-xl font-bold">Rp <?php echo number_format($total_semua,0,',','.'); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<?php $this->load->view('templates/footer_admin'); ?>
