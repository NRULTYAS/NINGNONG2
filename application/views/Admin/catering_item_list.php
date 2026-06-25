<?php $this->load->view('templates/header_admin'); ?>

<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h3 class="text-xl font-bold text-primary font-heading">Item Kustomisasi: <?php echo $paket->nama_paket; ?></h3>
        <p class="text-sm text-text-muted mt-1">Atur item per kategori untuk kustomisasi paket catering</p>
    </div>
    <div class="flex gap-2">
        <a href="<?php echo base_url('admin/catering'); ?>" class="px-4 py-2 border border-border-subtle rounded-xl text-sm font-medium text-text-muted hover:bg-accent-light transition flex items-center gap-1.5">
            <i class="fas fa-arrow-left text-xs"></i> Kembali
        </a>
        <a href="<?php echo base_url('admin/catering/item/tambah/'.$paket->id); ?>" class="px-4 py-2 bg-primary text-white rounded-xl text-sm font-medium hover:shadow-lg transition flex items-center gap-1.5">
            <i class="fas fa-plus text-xs"></i> Tambah Item
        </a>
    </div>
</div>

<?php if (!empty($kategori_list)): ?>
    <?php foreach ($kategori_list as $kat): 
        $kategori = $kat->kategori;
        $items_kategori = array_filter($items, function($i) use ($kategori) { return $i->kategori == $kategori; });
    ?>
    <div class="bg-surface rounded-2xl shadow-sm border border-border-subtle overflow-hidden mb-6">
        <div class="px-5 py-3 bg-accent-light/50 border-b border-border-subtle">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-primary flex items-center justify-center text-white text-xs font-bold shadow-sm">
                    <?php
                    $icons = ['Nasi' => 'fa-utensils', 'Lauk' => 'fa-drumstick-bite', 'Sayur' => 'fa-carrot', 'Tambahan' => 'fa-plus-circle'];
                    echo '<i class="fas ' . ($icons[$kategori] ?? 'fa-box') . '"></i>';
                    ?>
                </div>
                <h4 class="font-bold text-text-main"><?php echo $kategori; ?></h4>
                <span class="text-xs text-text-subtle">(<?php echo count($items_kategori); ?> item)</span>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-background text-left">
                        <th class="px-5 py-3 font-semibold text-text-muted">Nama Item</th>
                        <th class="px-5 py-3 font-semibold text-text-muted">Harga Tambahan</th>
                        <th class="px-5 py-3 font-semibold text-text-muted">Default</th>
                        <th class="px-5 py-3 font-semibold text-text-muted text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-subtle">
                    <?php foreach ($items_kategori as $item): ?>
                    <tr class="hover:bg-accent-light/50 transition">
                        <td class="px-5 py-3 font-medium text-text-main"><?php echo $item->nama_item; ?></td>
                        <td class="px-5 py-3">
                            <?php if ($item->harga > 0): ?>
                            <span class="text-primary font-medium">+Rp <?php echo number_format($item->harga, 0, ',', '.'); ?></span>
                            <?php else: ?>
                            <span class="text-secondary text-xs font-medium">Gratis</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-5 py-3">
                            <?php if ($item->is_default): ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 bg-secondary-light text-secondary rounded-full text-xs font-medium border border-border-subtle">
                                <i class="fas fa-check-circle text-[10px]"></i> Default
                            </span>
                            <?php else: ?>
                            <a href="<?php echo base_url('admin/catering/item/set_default/'.$paket->id.'/'.$item->id); ?>" class="text-xs text-primary hover:text-primary-hover underline" onclick="return confirm('Jadikan item ini sebagai default untuk kategori <?php echo $kategori; ?>?')">
                                Set Default
                            </a>
                            <?php endif; ?>
                        </td>
                        <td class="px-5 py-3 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="<?php echo base_url('admin/catering/item/edit/'.$item->id); ?>" class="p-2 text-secondary hover:bg-secondary-light rounded-lg transition" title="Edit">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <a href="<?php echo base_url('admin/catering/item/hapus/'.$item->id); ?>" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus" onclick="return confirm('Hapus item <?php echo $item->nama_item; ?>?')">
                                    <i class="fas fa-trash text-xs"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endforeach; ?>
<?php else: ?>
<div class="text-center py-16 bg-surface rounded-2xl shadow-sm border border-border-subtle">
    <div class="w-16 h-16 bg-secondary-light rounded-full flex items-center justify-center mx-auto mb-4">
        <i class="fas fa-box-open text-2xl text-secondary/50"></i>
    </div>
    <h4 class="text-lg font-bold text-text-main mb-1">Belum Ada Item</h4>
    <p class="text-sm text-text-muted mb-4">Tambahkan item kustomisasi untuk paket ini</p>
    <a href="<?php echo base_url('admin/catering/item/tambah/'.$paket->id); ?>" class="inline-flex items-center gap-1.5 px-4 py-2 bg-primary text-white rounded-xl text-sm font-medium hover:bg-primary-hover transition">
        <i class="fas fa-plus text-xs"></i> Tambah Item
    </a>
</div>
<?php endif; ?>

<?php $this->load->view('templates/footer_admin'); ?>
