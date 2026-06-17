<?php $this->load->view('templates/header_admin'); ?>

<div class="mb-8">
    <h1 class="text-2xl font-bold text-coklat-tua">Kelola Pesanan</h1>
    <p class="text-gray-500">Daftar semua pesanan pelanggan</p>
</div>

<div class="bg-white rounded-2xl border border-coklat-muda/20 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-krem">
                <tr>
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
                <tr class="hover:bg-krem/50 transition">
                    <td class="px-6 py-4 font-medium text-coklat-tua"><?php echo $p->kode_pesanan; ?></td>
                    <td class="px-6 py-4 text-gray-600">
                        <p class="font-medium text-gray-800"><?php echo $p->nama_penerima; ?></p>
                        <p class="text-sm"><?php echo $p->no_hp_penerima; ?></p>
                    </td>
                    <td class="px-6 py-4 font-medium text-coklat-tua">Rp <?php echo number_format($p->total_harga,0,',','.'); ?></td>
                    <td class="px-6 py-4 text-gray-600"><?php echo $p->metode_pembayaran; ?></td>
                    <td class="px-6 py-4">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-medium
                            <?php 
                            switch($p->status) {
                                case 'pending': echo 'bg-yellow-100 text-yellow-700'; break;
                                case 'diproses': echo 'bg-blue-100 text-blue-700'; break;
                                case 'dikirim': echo 'bg-purple-100 text-purple-700'; break;
                                case 'selesai': echo 'bg-green-100 text-green-700'; break;
                                case 'dibatalkan': echo 'bg-red-100 text-red-700'; break;
                            }
                            ?>">
                            <?php echo ucfirst($p->status); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-500 text-sm"><?php echo date('d M Y', strtotime($p->created_at)); ?></td>
                    <td class="px-6 py-4 text-right">
                        <form action="<?php echo base_url('admin/pesanan/update_status/'.$p->id_pesanan); ?>" method="post" class="inline-flex items-center gap-2">
                            <select name="status" onchange="this.form.submit()" class="text-sm px-3 py-2 rounded-lg border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30">
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
</div>

<?php $this->load->view('templates/footer_admin'); ?>
