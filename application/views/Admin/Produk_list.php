<?php $this->load->view('templates/header_admin'); ?>

<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-2xl font-bold text-coklat-tua">Kelola Produk</h1>
        <p class="text-gray-500">Daftar semua produk kue basah</p>
    </div>
    <a href="<?php echo base_url('admin/produk/tambah'); ?>" class="px-6 py-3 bg-coklat-tua text-white rounded-xl font-medium hover:bg-coklat transition flex items-center gap-2">
        <i class="fas fa-plus"></i> Tambah Produk
    </a>
</div>

<div class="bg-white rounded-2xl border border-coklat-muda/20 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-krem">
                <tr>
                    <th class="px-6 py-4 font-semibold text-gray-700">Gambar</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Nama Produk</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Kategori</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Rasa</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Harga</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Stok</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-coklat-muda/20">
                <?php foreach($produk as $p): ?>
                <tr class="hover:bg-krem/50 transition">
                    <td class="px-6 py-4">
                        <div class="w-14 h-14 bg-coklat-muda/20 rounded-xl flex items-center justify-center overflow-hidden">
                            <?php if($p->gambar && file_exists(FCPATH . 'assets/upload/'.$p->gambar)): ?>
                            <img src="<?php echo base_url('assets/upload/'.$p->gambar); ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                            <i class="fas fa-cookie-bite text-coklat-tua/30"></i>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-800"><?php echo $p->nama_produk; ?></td>
                    <td class="px-6 py-4 text-gray-600"><?php echo $p->nama_kategori; ?></td>
                    <td class="px-6 py-4 text-gray-600"><?php echo $p->rasa; ?></td>
                    <td class="px-6 py-4 font-medium text-coklat-tua">Rp <?php echo number_format($p->harga,0,',','.'); ?></td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-sm font-medium <?php echo $p->stok > 5 ? 'bg-green-100 text-green-700' : ($p->stok > 0 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700'); ?>">
                            <?php echo $p->stok; ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="<?php echo base_url('admin/produk/edit/'.$p->id_produk); ?>" class="inline-flex items-center justify-center w-9 h-9 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition mr-1"><i class="fas fa-edit text-sm"></i></a>
                        <a href="<?php echo base_url('admin/produk/hapus/'.$p->id_produk); ?>" onclick="return confirm('Yakin hapus produk ini?')" class="inline-flex items-center justify-center w-9 h-9 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition"><i class="fas fa-trash text-sm"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->load->view('templates/footer_admin'); ?>
