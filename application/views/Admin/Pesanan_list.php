<?php $this->load->view('templates/header_admin'); ?>

<div class="flex items-center gap-3 py-6">
    <div class="w-12 h-12 rounded-2xl bg-primary flex items-center justify-center text-white shadow-md shadow-primary/20">
        <i class="fas fa-clipboard-list text-lg"></i>
    </div>
    <div>
        <h1 class="text-2xl font-bold text-primary font-heading">Kelola Pesanan</h1>
        <p class="text-text-muted">Daftar semua pesanan pelanggan</p>
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
                    <th class="px-6 py-4 font-semibold text-text-main">Status</th>
                    <th class="px-6 py-4 font-semibold text-text-main">Tanggal</th>
                    <th class="px-6 py-4 font-semibold text-text-main text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-subtle">
                <?php foreach($pesanan as $p): ?>
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
                    <td class="px-6 py-4 text-right">
                        <form action="<?php echo base_url('admin/pesanan/update_status/'.$p->id_pesanan); ?>" method="post" class="inline-flex items-center gap-2">
                            <select name="status" onchange="this.form.submit()" class="text-sm px-3 py-2 rounded-xl border border-border-subtle focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-surface shadow-sm transition cursor-pointer">
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
    <div class="py-16 text-center">
        <div class="w-20 h-20 bg-secondary/20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-inner">
            <i class="fas fa-clipboard-list text-3xl text-primary/40"></i>
        </div>
        <p class="text-text-muted">Belum ada pesanan</p>
    </div>
    <?php endif; ?>
</div>

<?php $this->load->view('templates/footer_admin'); ?>
