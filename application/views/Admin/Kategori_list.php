<?php $this->load->view('templates/header_admin'); ?>

<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-2xl font-bold text-coklat-tua">Kelola Kategori</h1>
        <p class="text-gray-500">Daftar kategori kue basah</p>
    </div>
    <a href="<?php echo base_url('admin/kategori/tambah'); ?>" class="px-6 py-3 bg-coklat-tua text-white rounded-xl font-medium hover:bg-coklat transition flex items-center gap-2">
        <i class="fas fa-plus"></i> Tambah Kategori
    </a>
</div>

<div class="bg-white rounded-2xl border border-coklat-muda/20 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-krem">
                <tr>
                    <th class="px-6 py-4 font-semibold text-gray-700">ID</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Nama Kategori</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Deskripsi</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-coklat-muda/20">
                <?php foreach($kategori as $k): ?>
                <tr class="hover:bg-krem/50 transition">
                    <td class="px-6 py-4 text-gray-600"><?php echo $k->id_kategori; ?></td>
                    <td class="px-6 py-4 font-medium text-gray-800"><?php echo $k->nama_kategori; ?></td>
                    <td class="px-6 py-4 text-gray-600"><?php echo $k->deskripsi ?: '-'; ?></td>
                    <td class="px-6 py-4 text-right">
                        <a href="<?php echo base_url('admin/kategori/edit/'.$k->id_kategori); ?>" class="inline-flex items-center justify-center w-9 h-9 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition mr-1"><i class="fas fa-edit text-sm"></i></a>
                        <a href="<?php echo base_url('admin/kategori/hapus/'.$k->id_kategori); ?>" onclick="return confirm('Yakin hapus kategori ini?')" class="inline-flex items-center justify-center w-9 h-9 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition"><i class="fas fa-trash text-sm"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->load->view('templates/footer_admin'); ?>
