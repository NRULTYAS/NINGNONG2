<?php $this->load->view('templates/header_admin'); ?>

<div class="mb-8">
    <h1 class="text-2xl font-bold text-coklat-tua">Laporan Penjualan</h1>
    <p class="text-gray-500">Lihat laporan penjualan berdasarkan periode</p>
</div>

<div class="bg-white rounded-2xl p-6 border border-coklat-muda/20 mb-8">
    <form action="<?php echo base_url('admin/laporan'); ?>" method="get" class="flex flex-wrap gap-4 items-end">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
            <input type="date" name="dari" value="<?php echo $dari; ?>" required class="px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
            <input type="date" name="sampai" value="<?php echo $sampai; ?>" required class="px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30">
        </div>
        <button type="submit" class="px-6 py-3 bg-coklat-tua text-white rounded-xl font-medium hover:bg-coklat transition">Tampilkan</button>
    </form>
</div>

<?php if($dari && $sampai): ?>
<div class="bg-white rounded-2xl border border-coklat-muda/20 overflow-hidden">
    <div class="p-6 border-b border-coklat-muda/20 flex justify-between items-center">
        <h3 class="font-semibold text-lg">Hasil Laporan</h3>
        <p class="text-sm text-gray-500"><?php echo date('d M Y', strtotime($dari)); ?> - <?php echo date('d M Y', strtotime($sampai)); ?></p>
    </div>
    <?php if(empty($laporan)): ?>
    <div class="p-16 text-center">
        <div class="w-20 h-20 bg-coklat-muda/30 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-file-invoice text-3xl text-coklat-tua/40"></i>
        </div>
        <p class="text-gray-500">Tidak ada data penjualan pada periode ini</p>
    </div>
    <?php else: ?>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-krem">
                <tr>
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
                <tr class="hover:bg-krem/50 transition">
                    <td class="px-6 py-4 font-medium text-coklat-tua"><?php echo $l->kode_pesanan; ?></td>
                    <td class="px-6 py-4 text-gray-600"><?php echo $l->nama_penerima; ?></td>
                    <td class="px-6 py-4 font-medium text-coklat-tua">Rp <?php echo number_format($l->total_harga,0,',','.'); ?></td>
                    <td class="px-6 py-4">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700"><?php echo ucfirst($l->status); ?></span>
                    </td>
                    <td class="px-6 py-4 text-gray-500 text-sm"><?php echo date('d M Y H:i', strtotime($l->created_at)); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot class="bg-krem font-semibold">
                <tr>
                    <td colspan="2" class="px-6 py-4 text-right">Total Penjualan:</td>
                    <td colspan="3" class="px-6 py-4 text-coklat-tua text-lg">Rp <?php echo number_format($total_semua,0,',','.'); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<?php $this->load->view('templates/footer_admin'); ?>
