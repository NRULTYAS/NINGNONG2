<?php $this->load->view('templates/header_admin'); ?>

<div class="flex justify-between items-center py-6">
    <div class="flex items-center gap-3">
        <div class="w-12 h-12 rounded-2xl bg-accent flex items-center justify-center text-white shadow-md shadow-accent/20">
            <i class="fas fa-folder-open text-lg"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-primary font-heading">Kelola Kategori</h1>
            <p class="text-text-muted">Daftar kategori kue basah</p>
        </div>
    </div>
    <a href="<?php echo base_url('admin/kategori/tambah'); ?>" class="px-6 py-3 bg-primary text-white rounded-xl font-semibold shadow-lg shadow-primary/25 hover:shadow-xl hover:shadow-primary/30 hover:scale-[1.02] transition-all flex items-center gap-2">
        <i class="fas fa-plus"></i> Tambah Kategori
    </a>
</div>

<div class="bg-surface rounded-2xl shadow-sm border border-border-subtle overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-accent-light">
                    <th class="px-6 py-4 font-semibold text-text-main">ID</th>
                    <th class="px-6 py-4 font-semibold text-text-main">Nama Kategori</th>
                    <th class="px-6 py-4 font-semibold text-text-main">Deskripsi</th>
                    <th class="px-6 py-4 font-semibold text-text-main">Status</th>
                    <th class="px-6 py-4 font-semibold text-text-main text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-subtle">
                <?php foreach($kategori as $k): ?>
                <tr class="hover:bg-accent-light/40 transition">
                    <td class="px-6 py-4 text-text-muted font-medium">#<?php echo $k->id_kategori; ?></td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-secondary-light flex items-center justify-center text-primary text-xs">
                                <i class="fas fa-folder"></i>
                            </div>
                            <span class="font-semibold text-text-main"><?php echo $k->nama_kategori; ?></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-text-muted"><?php echo $k->deskripsi ?: '-'; ?></td>
                    <td class="px-6 py-4">
                        <?php if(isset($k->status) && $k->status == 'aktif'): ?>
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
                        <a href="<?php echo base_url('admin/kategori/edit/'.$k->id_kategori); ?>" class="inline-flex items-center justify-center w-9 h-9 bg-secondary text-white rounded-lg hover:shadow-md hover:shadow-secondary/30 hover:scale-105 transition-all mr-1"><i class="fas fa-edit text-sm"></i></a>
                        <a href="<?php echo base_url('admin/kategori/hapus/'.$k->id_kategori); ?>" onclick="return confirm('Yakin hapus kategori ini?')" class="inline-flex items-center justify-center w-9 h-9 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 hover:shadow-md hover:shadow-red-500/30 hover:scale-105 transition-all"><i class="fas fa-trash text-sm"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if(empty($kategori)): ?>
    <div class="py-16 text-center">
        <div class="w-20 h-20 bg-secondary/20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-inner">
            <i class="fas fa-folder-open text-3xl text-primary/40"></i>
        </div>
        <p class="text-text-muted">Belum ada kategori</p>
    </div>
    <?php endif; ?>
</div>

<?php $this->load->view('templates/footer_admin'); ?>
