<?php $this->load->view('templates/header_admin'); ?>

<div class="flex justify-between items-center py-6">
    <div class="flex items-center gap-3">
        <div class="w-12 h-12 rounded-2xl bg-accent flex items-center justify-center text-white shadow-md shadow-accent/20">
            <i class="fas fa-box-open text-lg"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-primary font-heading">Kelola Paket Catering</h1>
            <p class="text-text-muted">Daftar paket nasi kotak</p>
        </div>
    </div>
    <a href="<?php echo base_url('admin/catering/tambah'); ?>" class="px-6 py-3 bg-primary text-white rounded-xl font-semibold shadow-lg shadow-primary/25 hover:shadow-xl hover:shadow-primary/30 hover:scale-[1.02] transition-all flex items-center gap-2">
        <i class="fas fa-plus"></i> Tambah Paket
    </a>
</div>

<div class="bg-surface rounded-2xl shadow-sm border border-border-subtle overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-accent-light">
                    <th class="px-6 py-4 font-semibold text-text-main">ID</th>
                    <th class="px-6 py-4 font-semibold text-text-main">Foto</th>
                    <th class="px-6 py-4 font-semibold text-text-main">Nama Paket</th>
                    <th class="px-6 py-4 font-semibold text-text-main">Harga</th>
                    <th class="px-6 py-4 font-semibold text-text-main">Porsi</th>
                    <th class="px-6 py-4 font-semibold text-text-main">Status</th>
                    <th class="px-6 py-4 font-semibold text-text-main text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-subtle">
                <?php foreach($paket as $p): ?>
                <tr class="hover:bg-accent-light/40 transition">
                    <td class="px-6 py-4 text-text-muted font-medium">#<?php echo $p->id; ?></td>
                    <td class="px-6 py-4">
                        <div class="w-12 h-12 rounded-xl bg-accent-light overflow-hidden border border-border-subtle">
                            <?php if($p->foto && $p->foto != 'default.jpg' && file_exists(FCPATH . 'assets/upload/'.$p->foto)): ?>
                                <img src="<?php echo base_url('assets/upload/'.$p->foto); ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-primary/30">
                                    <i class="fas fa-box-open"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-semibold text-text-main"><?php echo $p->nama_paket; ?></span>
                    </td>
                    <td class="px-6 py-4 text-text-main">Rp <?php echo number_format($p->harga,0,',','.'); ?></td>
                    <td class="px-6 py-4 text-text-muted"><?php echo $p->porsi; ?> porsi</td>
                    <td class="px-6 py-4">
                        <?php if($p->status == 'aktif'): ?>
                        <span class="inline-flex items-center px-3 py-1 bg-secondary-light text-secondary rounded-full text-xs font-semibold border border-border-subtle">
                            <i class="fas fa-check-circle mr-1"></i> Aktif
                        </span>
                        <?php else: ?>
                        <span class="inline-flex items-center px-3 py-1 bg-white text-text-subtle rounded-full text-xs font-semibold border border-border-subtle">
                            <i class="fas fa-times-circle mr-1"></i> Nonaktif
                        </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="<?php echo base_url('admin/catering/item/'.$p->id); ?>" class="inline-flex items-center justify-center w-9 h-9 bg-secondary text-white rounded-lg hover:shadow-md hover:shadow-secondary/30 hover:scale-105 transition-all mr-1" title="Kelola Item Kustomisasi"><i class="fas fa-list text-sm"></i></a>
                        <a href="<?php echo base_url('admin/catering/edit/'.$p->id); ?>" class="inline-flex items-center justify-center w-9 h-9 bg-secondary text-white rounded-lg hover:shadow-md hover:shadow-secondary/30 hover:scale-105 transition-all mr-1"><i class="fas fa-edit text-sm"></i></a>
                        <a href="<?php echo base_url('admin/catering/hapus/'.$p->id); ?>" onclick="return confirm('Yakin hapus paket ini?')" class="inline-flex items-center justify-center w-9 h-9 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 hover:shadow-md hover:shadow-red-500/30 hover:scale-105 transition-all"><i class="fas fa-trash text-sm"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if(empty($paket)): ?>
    <div class="py-16 text-center">
        <div class="w-20 h-20 bg-secondary/20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-inner">
            <i class="fas fa-box-open text-3xl text-primary/40"></i>
        </div>
        <p class="text-text-muted">Belum ada paket catering</p>
    </div>
    <?php endif; ?>
</div>

<?php $this->load->view('templates/footer_admin'); ?>
