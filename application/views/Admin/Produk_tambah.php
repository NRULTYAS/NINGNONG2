<?php $this->load->view('templates/header_admin'); ?>

<div class="max-w-2xl">
    <div class="flex items-center gap-4 mb-8">
        <a href="<?php echo base_url('admin/produk'); ?>" class="w-12 h-12 bg-gradient-to-br from-coklat-muda to-coklat-susu rounded-2xl flex items-center justify-center text-coklat-tua shadow-md shadow-coklat-muda/20 hover:shadow-lg hover:scale-105 transition-all">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-coklat-tua">Tambah Produk</h1>
            <p class="text-gray-500">Tambah produk kue basah baru</p>
        </div>
    </div>

    <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-coklat-muda/20 shadow-lg shadow-coklat-muda/10">
        <?php echo validation_errors('<div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-5 text-sm flex items-center gap-2"><i class="fas fa-exclamation-circle"></i>', '</div>'); ?>
        <form action="<?php echo base_url('admin/produk/tambah'); ?>" method="post" enctype="multipart/form-data">
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-coklat-tua to-coklat flex items-center justify-center text-white text-xs"><i class="fas fa-tag"></i></div>
                    Nama Produk
                </label>
                <input type="text" name="nama_produk" required class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-white shadow-sm transition">
            </div>
            <div class="grid grid-cols-2 gap-4 mb-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-oranye to-kuning flex items-center justify-center text-white text-xs"><i class="fas fa-folder"></i></div>
                        Kategori
                    </label>
                    <select name="id_kategori" required class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-white shadow-sm transition">
                        <option value="">Pilih Kategori</option>
                        <?php foreach($kategori as $k): ?>
                        <option value="<?php echo $k->id_kategori; ?>"><?php echo $k->nama_kategori; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-pink-400 to-rose-400 flex items-center justify-center text-white text-xs"><i class="fas fa-heart"></i></div>
                        Rasa
                    </label>
                    <input type="text" name="rasa" required class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-white shadow-sm transition">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center text-white text-xs"><i class="fas fa-money-bill-wave"></i></div>
                        Harga (Rp)
                    </label>
                    <input type="number" name="harga" required class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-white shadow-sm transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center text-white text-xs"><i class="fas fa-boxes"></i></div>
                        Stok
                    </label>
                    <input type="number" name="stok" required class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-white shadow-sm transition">
                </div>
            </div>
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-purple-500 to-violet-500 flex items-center justify-center text-white text-xs"><i class="fas fa-align-left"></i></div>
                    Deskripsi
                </label>
                <textarea name="deskripsi" rows="3" class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-white shadow-sm transition resize-none"></textarea>
            </div>
            <div class="mb-8">
                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-white text-xs"><i class="fas fa-image"></i></div>
                    Gambar
                </label>
                <div class="relative">
                    <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-3 rounded-xl border border-dashed border-coklat-muda/40 focus:outline-none focus:border-coklat-tua bg-krem/20 hover:bg-krem/40 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-coklat-tua file:text-white file:cursor-pointer">
                </div>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-semibold shadow-lg shadow-coklat-tua/25 hover:shadow-xl hover:shadow-coklat-tua/30 hover:scale-[1.02] transition-all flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="<?php echo base_url('admin/produk'); ?>" class="px-8 py-3 border border-coklat-muda/40 text-gray-600 rounded-xl font-medium hover:bg-krem/50 hover:border-coklat-muda transition flex items-center gap-2">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<?php $this->load->view('templates/footer_admin'); ?>
