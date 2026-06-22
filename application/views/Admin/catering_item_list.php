<?php $this->load->view('templates/header_admin'); ?>

<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h3 class="text-xl font-bold text-coklat-tua">Item Kustomisasi: <?php echo $paket->nama_paket; ?></h3>
        <p class="text-sm text-gray-500 mt-1">Atur item per kategori untuk kustomisasi paket catering</p>
    </div>
    <div class="flex gap-2">
        <a href="<?php echo base_url('admin/catering'); ?>" class="px-4 py-2 border border-gray-300 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 transition flex items-center gap-1.5">
            <i class="fas fa-arrow-left text-xs"></i> Kembali
        </a>
        <a href="<?php echo base_url('admin/catering/item/tambah/'.$paket->id); ?>" class="px-4 py-2 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl text-sm font-medium hover:shadow-lg transition flex items-center gap-1.5">
            <i class="fas fa-plus text-xs"></i> Tambah Item
        </a>
    </div>
</div>

<?php if (!empty($kategori_list)): ?>
    <?php foreach ($kategori_list as $kat): 
        $kategori = $kat->kategori;
        $items_kategori = array_filter($items, function($i) use ($kategori) { return $i->kategori == $kategori; });
    ?>
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-6">
        <div class="px-5 py-3 bg-gradient-to-r from-coklat-tua/5 to-coklat/5 border-b border-gray-200">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-coklat-tua to-coklat flex items-center justify-center text-white text-xs font-bold shadow-sm">
                    <?php
                    $icons = ['Nasi' => 'fa-utensils', 'Lauk' => 'fa-drumstick-bite', 'Sayur' => 'fa-carrot', 'Tambahan' => 'fa-plus-circle'];
                    echo '<i class="fas ' . ($icons[$kategori] ?? 'fa-box') . '"></i>';
                    ?>
                </div>
                <h4 class="font-bold text-gray-800"><?php echo $kategori; ?></h4>
                <span class="text-xs text-gray-400">(<?php echo count($items_kategori); ?> item)</span>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-left">
                        <th class="px-5 py-3 font-semibold text-gray-600">Nama Item</th>
                        <th class="px-5 py-3 font-semibold text-gray-600">Harga Tambahan</th>
                        <th class="px-5 py-3 font-semibold text-gray-600">Default</th>
                        <th class="px-5 py-3 font-semibold text-gray-600 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($items_kategori as $item): ?>
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-5 py-3 font-medium text-gray-800"><?php echo $item->nama_item; ?></td>
                        <td class="px-5 py-3">
                            <?php if ($item->harga > 0): ?>
                            <span class="text-coklat font-medium">+Rp <?php echo number_format($item->harga, 0, ',', '.'); ?></span>
                            <?php else: ?>
                            <span class="text-green-600 text-xs font-medium">Gratis</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-5 py-3">
                            <?php if ($item->is_default): ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 bg-green-50 text-green-700 rounded-full text-xs font-medium border border-green-200">
                                <i class="fas fa-check-circle text-[10px]"></i> Default
                            </span>
                            <?php else: ?>
                            <a href="<?php echo base_url('admin/catering/item/set_default/'.$paket->id.'/'.$item->id); ?>" class="text-xs text-coklat hover:text-coklat-tua underline" onclick="return confirm('Jadikan item ini sebagai default untuk kategori <?php echo $kategori; ?>?')">
                                Set Default
                            </a>
                            <?php endif; ?>
                        </td>
                        <td class="px-5 py-3 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="<?php echo base_url('admin/catering/item/edit/'.$item->id); ?>" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
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
<div class="text-center py-16 bg-white rounded-2xl border border-gray-200">
    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <i class="fas fa-box-open text-2xl text-gray-300"></i>
    </div>
    <h4 class="text-lg font-bold text-gray-600 mb-1">Belum Ada Item</h4>
    <p class="text-sm text-gray-400 mb-4">Tambahkan item kustomisasi untuk paket ini</p>
    <a href="<?php echo base_url('admin/catering/item/tambah/'.$paket->id); ?>" class="inline-flex items-center gap-1.5 px-4 py-2 bg-coklat-tua text-white rounded-xl text-sm font-medium hover:bg-coklat transition">
        <i class="fas fa-plus text-xs"></i> Tambah Item
    </a>
</div>
<?php endif; ?>

<?php $this->load->view('templates/footer_admin'); ?>