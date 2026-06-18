<?php $this->load->view('templates/header_admin'); ?>

<div class="mb-8 flex items-center gap-3">
    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white shadow-md shadow-green-500/20">
        <i class="fas fa-chart-line text-lg"></i>
    </div>
    <div>
        <h1 class="text-2xl font-bold text-coklat-tua">Laporan Penjualan</h1>
        <p class="text-gray-500">Lihat laporan penjualan berdasarkan periode</p>
    </div>
</div>

<div class="bg-white/80 backdrop-blur-sm rounded-3xl p-6 border border-coklat-muda/20 shadow-lg shadow-coklat-muda/10 mb-8">
    <form action="<?php echo base_url('admin/laporan'); ?>" method="get" class="flex flex-wrap gap-4 items-end">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                <div class="w-5 h-5 rounded-md bg-gradient-to-br from-coklat-tua to-coklat flex items-center justify-center text-white text-[10px]"><i class="fas fa-calendar-alt"></i></div>
                Dari Tanggal
            </label>
            <input type="date" name="dari" value="<?php echo $dari; ?>" required class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-white shadow-sm transition">
        </div>
        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                <div class="w-5 h-5 rounded-md bg-gradient-to-br from-coklat-tua to-coklat flex items-center justify-center text-white text-[10px]"><i class="fas fa-calendar-check"></i></div>
                Sampai Tanggal
            </label>
            <input type="date" name="sampai" value="<?php echo $sampai; ?>" required class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-white shadow-sm transition">
        </div>
        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-semibold shadow-lg shadow-coklat-tua/25 hover:shadow-xl hover:shadow-coklat-tua/30 hover:scale-[1.02] transition-all flex items-center gap-2">
            <i class="fas fa-search"></i> Tampilkan
        </button>
    </form>
</div>

<?php if($dari && $sampai): ?>
<div class="bg-white/80 backdrop-blur-sm rounded-3xl border border-coklat-muda/20 overflow-hidden shadow-lg shadow-coklat-muda/10">
    <div class="p-6 border-b border-coklat-muda/20 flex justify-between items-center bg-gradient-to-r from-krem/50 to-coklat-susu/30">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white shadow-md">
                <i class="fas fa-file-invoice"></i>
            </div>
            <h3 class="font-bold text-lg text-coklat-tua">Hasil Laporan</h3>
        </div>
        <span class="text-sm text-gray-500 bg-white px-3 py-1 rounded-lg border border-coklat-muda/20 shadow-sm">
            <?php echo date('d M Y', strtotime($dari)); ?> - <?php echo date('d M Y', strtotime($sampai)); ?>
        </span>
    </div>
    <?php if(empty($laporan)): ?>
    <div class="p-16 text-center">
        <div class="w-20 h-20 bg-gradient-to-br from-coklat-muda/40 to-coklat-susu/40 rounded-full flex items-center justify-center mx-auto mb-4 shadow-inner">
            <i class="fas fa-file-invoice text-3xl text-coklat-tua/40"></i>
        </div>
        <p class="text-gray-500 font-medium">Tidak ada data penjualan pada periode ini</p>
    </div>
    <?php else: ?>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gradient-to-r from-krem to-coklat-susu/50">
                    <th class="px-6 py-4 font-semibold text-gray-700">Kode Pesanan</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Pelanggan</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Total</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Status</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-coklat-muda/20">
                <?php 
                $total_semua = 0;
                foreach($laporan as $l): 
                    $total_semua += $l->total_harga;
                ?>
                <tr class="hover:bg-krem/40 transition">
                    <td class="px-6 py-4 font-bold text-coklat-tua"><?php echo $l->kode_pesanan; ?></td>
                    <td class="px-6 py-4 text-gray-600"><?php echo $l->nama_penerima; ?></td>
                    <td class="px-6 py-4 font-bold text-coklat-tua">Rp <?php echo number_format($l->total_harga,0,',','.'); ?></td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold border bg-green-50 text-green-700 border-green-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                            <?php echo ucfirst($l->status); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-400 text-sm"><?php echo date('d M Y H:i', strtotime($l->created_at)); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="bg-gradient-to-r from-coklat-tua to-coklat text-white">
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
