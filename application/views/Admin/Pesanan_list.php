<?php $this->load->view('templates/header_admin'); ?>

<div class="mb-8 flex items-center gap-3">
    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-coklat-tua to-coklat flex items-center justify-center text-white shadow-md shadow-coklat-tua/20">
        <i class="fas fa-clipboard-list text-lg"></i>
    </div>
    <div>
        <h1 class="text-2xl font-bold text-coklat-tua">Kelola Pesanan</h1>
        <p class="text-gray-500">Daftar semua pesanan pelanggan</p>
    </div>
</div>

<div class="bg-white/80 backdrop-blur-sm rounded-3xl border border-coklat-muda/20 overflow-hidden shadow-lg shadow-coklat-muda/10">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gradient-to-r from-krem to-coklat-susu/50">
                    <th class="px-6 py-4 font-semibold text-gray-700">Kode</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Pelanggan</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Total</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Metode</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Status</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Tanggal</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-coklat-muda/20">
                <?php foreach($pesanan as $p): ?>
                <tr class="hover:bg-krem/40 transition">
                    <td class="px-6 py-4 font-bold text-coklat-tua"><?php echo $p->kode_pesanan; ?></td>
                    <td class="px-6 py-4 text-gray-600">
                        <p class="font-semibold text-gray-800"><?php echo $p->nama_penerima; ?></p>
                        <p class="text-sm text-gray-400"><?php echo $p->no_hp_penerima; ?></p>
                    </td>
                    <td class="px-6 py-4 font-bold text-coklat-tua">Rp <?php echo number_format($p->total_harga,0,',','.'); ?></td>
                    <td class="px-6 py-4 text-gray-600">
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-lg text-xs font-medium bg-krem border border-coklat-muda/30">
                            <i class="fas fa-wallet text-coklat-tua/60"></i> <?php echo $p->metode_pembayaran; ?>
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold border
                            <?php 
                            switch($p->status) {
                                case 'pending': echo 'bg-yellow-50 text-yellow-700 border-yellow-200'; break;
                                case 'diproses': echo 'bg-blue-50 text-blue-700 border-blue-200'; break;
                                case 'dikirim': echo 'bg-purple-50 text-purple-700 border-purple-200'; break;
                                case 'selesai': echo 'bg-green-50 text-green-700 border-green-200'; break;
                                case 'dibatalkan': echo 'bg-red-50 text-red-700 border-red-200'; break;
                            }
                            ?>">
                            <span class="w-1.5 h-1.5 rounded-full
                                <?php 
                                switch($p->status) {
                                    case 'pending': echo 'bg-yellow-500'; break;
                                    case 'diproses': echo 'bg-blue-500'; break;
                                    case 'dikirim': echo 'bg-purple-500'; break;
                                    case 'selesai': echo 'bg-green-500'; break;
                                    case 'dibatalkan': echo 'bg-red-500'; break;
                                }
                                ?>"></span>
                            <?php echo ucfirst($p->status); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-400 text-sm"><?php echo date('d M Y', strtotime($p->created_at)); ?></td>
                    <td class="px-6 py-4 text-right">
                        <form action="<?php echo base_url('admin/pesanan/update_status/'.$p->id_pesanan); ?>" method="post" class="inline-flex items-center gap-2">
                            <select name="status" onchange="this.form.submit()" class="text-sm px-3 py-2 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-white shadow-sm transition cursor-pointer">
                                <option value="pending" <?php echo $p->status == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="diproses" <?php echo $p->status == 'diproses' ? 'selected' : ''; ?>>Diproses</option>
                                <option value="dikirim" <?php echo $p->status == 'dikirim' ? 'selected' : ''; ?>>Dikirim</option>
                                <option value="selesai" <?php echo $p->status == 'selesai' ? 'selected' : ''; ?>>Selesai</option>
                                <option value="dibatalkan" <?php echo $p->status == 'dibatalkan' ? 'selected' : ''; ?>>Dibatalkan</option>
                            </select>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if(empty($pesanan)): ?>
    <div class="p-16 text-center">
        <div class="w-20 h-20 bg-gradient-to-br from-coklat-muda/40 to-coklat-susu/40 rounded-full flex items-center justify-center mx-auto mb-4 shadow-inner">
            <i class="fas fa-clipboard-list text-3xl text-coklat-tua/40"></i>
        </div>
        <p class="text-gray-500">Belum ada pesanan</p>
    </div>
    <?php endif; ?>
</div>

<?php $this->load->view('templates/footer_admin'); ?>
