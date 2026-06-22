<?php $this->load->view('templates/header_admin'); ?>

<div class="flex justify-between items-center mb-8">
    <div class="flex items-center gap-3">
        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-oranye to-kuning flex items-center justify-center text-white shadow-md shadow-oranye/20">
            <i class="fas fa-box-open text-lg"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-coklat-tua">Kelola Paket Catering</h1>
            <p class="text-gray-500">Daftar paket nasi kotak</p>
        </div>
    </div>
    <a href="<?php echo base_url('admin/catering/tambah'); ?>" class="px-6 py-3 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-semibold shadow-lg shadow-coklat-tua/25 hover:shadow-xl hover:shadow-coklat-tua/30 hover:scale-[1.02] transition-all flex items-center gap-2">
        <i class="fas fa-plus"></i> Tambah Paket
    </a>
</div>

<div class="bg-white/80 backdrop-blur-sm rounded-3xl border border-coklat-muda/20 overflow-hidden shadow-lg shadow-coklat-muda/10">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gradient-to-r from-krem to-coklat-susu/50">
                    <th class="px-6 py-4 font-semibold text-gray-700">ID</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Foto</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Nama Paket</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Harga</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Porsi</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Status</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-coklat-muda/20">
                <?php foreach($paket as $p): ?>
                <tr class="hover:bg-krem/40 transition">
                    <td class="px-6 py-4 text-gray-500 font-medium">#<?php echo $p->id; ?></td>
                    <td class="px-6 py-4">
                        <div class="w-12 h-12 rounded-xl bg-krem overflow-hidden border border-coklat-muda/20">
                            <?php if($p->foto && $p->foto != 'default.jpg' && file_exists(FCPATH . 'assets/upload/'.$p->foto)): ?>
                                <img src="<?php echo base_url('assets/upload/'.$p->foto); ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-coklat-tua/30">
                                    <i class="fas fa-box-open"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-semibold text-gray-800"><?php echo $p->nama_paket; ?></span>
                    </td>
                    <td class="px-6 py-4 text-gray-700">Rp <?php echo number_format($p->harga,0,',','.'); ?></td>
                    <td class="px-6 py-4 text-gray-600"><?php echo $p->porsi; ?> porsi</td>
                    <td class="px-6 py-4">
                        <?php if($p->status == 'aktif'): ?>
                        <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                            <i class="fas fa-check-circle mr-1"></i> Aktif
                        </span>
                        <?php else: ?>
                        <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-xs font-semibold">
                            <i class="fas fa-times-circle mr-1"></i> Nonaktif
                        </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="<?php echo base_url('admin/catering/item/'.$p->id); ?>" class="inline-flex items-center justify-center w-9 h-9 bg-gradient-to-br from-green-500 to-green-600 text-white rounded-lg hover:shadow-md hover:shadow-green-500/30 hover:scale-105 transition-all mr-1" title="Kelola Item Kustomisasi"><i class="fas fa-list text-sm"></i></a>
                        <a href="<?php echo base_url('admin/catering/edit/'.$p->id); ?>" class="inline-flex items-center justify-center w-9 h-9 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-lg hover:shadow-md hover:shadow-blue-500/30 hover:scale-105 transition-all mr-1"><i class="fas fa-edit text-sm"></i></a>
                        <a href="<?php echo base_url('admin/catering/hapus/'.$p->id); ?>" onclick="return confirm('Yakin hapus paket ini?')" class="inline-flex items-center justify-center w-9 h-9 bg-gradient-to-br from-red-500 to-red-600 text-white rounded-lg hover:shadow-md hover:shadow-red-500/30 hover:scale-105 transition-all"><i class="fas fa-trash text-sm"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if(empty($paket)): ?>
    <div class="p-16 text-center">
        <div class="w-20 h-20 bg-gradient-to-br from-coklat-muda/40 to-coklat-susu/40 rounded-full flex items-center justify-center mx-auto mb-4 shadow-inner">
            <i class="fas fa-box-open text-3xl text-coklat-tua/40"></i>
        </div>
        <p class="text-gray-500">Belum ada paket catering</p>
    </div>
    <?php endif; ?>
</div>

<?php $this->load->view('templates/footer_admin'); ?>