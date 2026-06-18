<?php $this->load->view('templates/header_admin'); ?>

<div class="flex justify-between items-center mb-8">
    <div class="flex items-center gap-3">
        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-oranye to-kuning flex items-center justify-center text-white shadow-md shadow-oranye/20">
            <i class="fas fa-folder-open text-lg"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-coklat-tua">Kelola Kategori</h1>
            <p class="text-gray-500">Daftar kategori kue basah</p>
        </div>
    </div>
    <a href="<?php echo base_url('admin/kategori/tambah'); ?>" class="px-6 py-3 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-semibold shadow-lg shadow-coklat-tua/25 hover:shadow-xl hover:shadow-coklat-tua/30 hover:scale-[1.02] transition-all flex items-center gap-2">
        <i class="fas fa-plus"></i> Tambah Kategori
    </a>
</div>

<div class="bg-white/80 backdrop-blur-sm rounded-3xl border border-coklat-muda/20 overflow-hidden shadow-lg shadow-coklat-muda/10">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gradient-to-r from-krem to-coklat-susu/50">
                    <th class="px-6 py-4 font-semibold text-gray-700">ID</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Nama Kategori</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Deskripsi</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-coklat-muda/20">
                <?php foreach($kategori as $k): ?>
                <tr class="hover:bg-krem/40 transition">
                    <td class="px-6 py-4 text-gray-500 font-medium">#<?php echo $k->id_kategori; ?></td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-coklat-muda to-coklat-susu flex items-center justify-center text-coklat-tua text-xs">
                                <i class="fas fa-folder"></i>
                            </div>
                            <span class="font-semibold text-gray-800"><?php echo $k->nama_kategori; ?></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600"><?php echo $k->deskripsi ?: '-'; ?></td>
                    <td class="px-6 py-4 text-right">
                        <a href="<?php echo base_url('admin/kategori/edit/'.$k->id_kategori); ?>" class="inline-flex items-center justify-center w-9 h-9 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-lg hover:shadow-md hover:shadow-blue-500/30 hover:scale-105 transition-all mr-1"><i class="fas fa-edit text-sm"></i></a>
                        <a href="<?php echo base_url('admin/kategori/hapus/'.$k->id_kategori); ?>" onclick="return confirm('Yakin hapus kategori ini?')" class="inline-flex items-center justify-center w-9 h-9 bg-gradient-to-br from-red-500 to-red-600 text-white rounded-lg hover:shadow-md hover:shadow-red-500/30 hover:scale-105 transition-all"><i class="fas fa-trash text-sm"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if(empty($kategori)): ?>
    <div class="p-16 text-center">
        <div class="w-20 h-20 bg-gradient-to-br from-coklat-muda/40 to-coklat-susu/40 rounded-full flex items-center justify-center mx-auto mb-4 shadow-inner">
            <i class="fas fa-folder-open text-3xl text-coklat-tua/40"></i>
        </div>
        <p class="text-gray-500">Belum ada kategori</p>
    </div>
    <?php endif; ?>
</div>

<?php $this->load->view('templates/footer_admin'); ?>
