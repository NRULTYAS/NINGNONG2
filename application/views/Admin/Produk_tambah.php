<?php $this->load->view('templates/header_admin'); ?>

<div class="max-w-2xl">
    <div class="flex items-center gap-4 mb-8">
        <a href="<?php echo base_url('admin/produk'); ?>" class="w-10 h-10 bg-krem rounded-xl flex items-center justify-center text-coklat-tua hover:bg-coklat-muda/30 transition"><i class="fas fa-arrow-left"></i></a>
        <div>
            <h1 class="text-2xl font-bold text-coklat-tua">Tambah Produk</h1>
            <p class="text-gray-500">Tambah produk kue basah baru</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-8 border border-coklat-muda/20">
        <?php echo validation_errors('<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-lg mb-4 text-sm">', '</div>'); ?>
        <form action="<?php echo base_url('admin/produk/tambah'); ?>" method="post" enctype="multipart/form-data">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                <input type="text" name="nama_produk" required class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30">
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select name="id_kategori" required class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30">
                        <option value="">Pilih Kategori</option>
                        <?php foreach($kategori as $k): ?>
                        <option value="<?php echo $k->id_kategori; ?>"><?php echo $k->nama_kategori; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rasa</label>
                    <input type="text" name="rasa" required class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp)</label>
                    <input type="number" name="harga" required class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                    <input type="number" name="stok" required class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30"></textarea>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30">
            </div>
            <div class="flex gap-3">
                <button type="submit" class="px-8 py-3 bg-coklat-tua text-white rounded-xl font-medium hover:bg-coklat transition">Simpan</button>
                <a href="<?php echo base_url('admin/produk'); ?>" class="px-8 py-3 border border-coklat-muda text-gray-600 rounded-xl font-medium hover:bg-krem transition">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php $this->load->view('templates/footer_admin'); ?>
