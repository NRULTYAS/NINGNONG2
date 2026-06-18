<?php $this->load->view('templates/header_admin'); ?>

<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-2xl font-bold text-coklat-tua">Kelola Produk</h1>
        <p class="text-gray-400">Daftar semua produk kue basah</p>
    </div>
    <a href="<?php echo base_url('admin/produk/tambah'); ?>" class="px-6 py-3 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-medium hover:shadow-lg hover:shadow-coklat-tua/25 transition flex items-center gap-2">
        <i class="fas fa-plus text-sm"></i> Tambah Produk
    </a>
</div>

<div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-coklat-muda/20 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-krem/80">
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
                <tr class="hover:bg-krem/40 transition">
                    <td class="px-6 py-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-coklat-muda/20 to-krem rounded-xl flex items-center justify-center overflow-hidden">
                            <?php if($p->gambar && file_exists(FCPATH . 'assets/upload/'.$p->gambar)): ?>
                            <img src="<?php echo base_url('assets/upload/'.$p->gambar); ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                            <i class="fas fa-cookie-bite text-coklat-tua/30"></i>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-800"><?php echo $p->nama_produk; ?></td>
                    <td class="px-6 py-4 text-gray-500"><?php echo $p->nama_kategori; ?></td>
                    <td class="px-6 py-4 text-gray-500"><?php echo $p->rasa; ?></td>
                    <td class="px-6 py-4 font-bold text-coklat-tua">Rp <?php echo number_format($p->harga,0,',','.'); ?></td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium <?php echo $p->stok > 5 ? 'bg-green-50 text-green-700 border border-green-200' : ($p->stok > 0 ? 'bg-yellow-50 text-yellow-700 border border-yellow-200' : 'bg-red-50 text-red-700 border border-red-200'); ?>">
                            <?php echo $p->stok; ?> tersedia
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="<?php echo base_url('admin/produk/edit/'.$p->id_produk); ?>" class="inline-flex items-center justify-center w-9 h-9 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition mr-1 border border-blue-100"><i class="fas fa-edit text-sm"></i></a>
                        <a href="<?php echo base_url('admin/produk/hapus/'.$p->id_produk); ?>" onclick="return confirm('Yakin hapus produk ini?')" class="inline-flex items-center justify-center w-9 h-9 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition border border-red-100"><i class="fas fa-trash text-sm"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->load->view('templates/footer_admin'); ?>
