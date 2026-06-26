<?php $this->load->view('templates/header_admin'); ?>

<div class="max-w-2xl py-6">
    <div class="flex items-center gap-4 mb-8">
        <a href="<?php echo base_url('admin/produk'); ?>" class="w-12 h-12 bg-secondary rounded-2xl flex items-center justify-center text-white shadow-md shadow-secondary/20 hover:shadow-lg hover:scale-105 transition-all">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-primary font-heading">Tambah Produk</h1>
            <p class="text-text-muted">Tambah produk kue basah baru</p>
        </div>
    </div>

    <div class="bg-surface rounded-2xl shadow-sm border border-border-subtle p-6">
        <?php echo validation_errors('<div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-5 text-sm flex items-center gap-2"><i class="fas fa-exclamation-circle"></i>', '</div>'); ?>
        <form action="<?php echo base_url('admin/produk/tambah'); ?>" method="post" enctype="multipart/form-data">
            <div class="mb-5">
                <label class="block text-sm font-semibold text-text-main mb-2 flex items-center gap-2">
                    <div class="w-6 h-6 rounded-lg bg-primary flex items-center justify-center text-white text-xs"><i class="fas fa-tag"></i></div>
                    Nama Produk
                </label>
                <input type="text" name="nama_produk" required class="w-full px-4 py-3 rounded-xl border border-border-subtle focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-surface shadow-sm transition">
            </div>
            <div class="grid grid-cols-2 gap-6 mb-5">
                <div>
                    <label class="block text-sm font-semibold text-text-main mb-2 flex items-center gap-2">
                        <div class="w-6 h-6 rounded-lg bg-accent flex items-center justify-center text-white text-xs"><i class="fas fa-folder"></i></div>
                        Kategori
                    </label>
                    <select name="id_kategori" required class="w-full px-4 py-3 rounded-xl border border-border-subtle focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-surface shadow-sm transition">
                        <option value="">Pilih Kategori</option>
                        <?php foreach($kategori as $k): ?>
                        <option value="<?php echo $k->id_kategori; ?>"><?php echo $k->nama_kategori; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-text-main mb-2 flex items-center gap-2">
                        <div class="w-6 h-6 rounded-lg bg-pink-400 flex items-center justify-center text-white text-xs"><i class="fas fa-heart"></i></div>
                        Rasa
                    </label>
                    <input type="text" name="rasa" required class="w-full px-4 py-3 rounded-xl border border-border-subtle focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-surface shadow-sm transition">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6 mb-5">
                <div>
                    <label class="block text-sm font-semibold text-text-main mb-2 flex items-center gap-2">
                        <div class="w-6 h-6 rounded-lg bg-secondary flex items-center justify-center text-white text-xs"><i class="fas fa-money-bill-wave"></i></div>
                        Harga (Rp)
                    </label>
                    <input type="number" name="harga" required class="w-full px-4 py-3 rounded-xl border border-border-subtle focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-surface shadow-sm transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-text-main mb-2 flex items-center gap-2">
                        <div class="w-6 h-6 rounded-lg bg-secondary flex items-center justify-center text-white text-xs"><i class="fas fa-boxes"></i></div>
                        Stok
                    </label>
                    <input type="number" name="stok" required class="w-full px-4 py-3 rounded-xl border border-border-subtle focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-surface shadow-sm transition">
                </div>
            </div>
            <div class="mb-5">
                <label class="block text-sm font-semibold text-text-main mb-2 flex items-center gap-2">
                    <div class="w-6 h-6 rounded-lg bg-purple-500 flex items-center justify-center text-white text-xs"><i class="fas fa-align-left"></i></div>
                    Deskripsi
                </label>
                <textarea name="deskripsi" rows="3" class="w-full px-4 py-3 rounded-xl border border-border-subtle focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-surface shadow-sm transition resize-none"></textarea>
            </div>
            <div class="mb-8">
                <label class="block text-sm font-semibold text-text-main mb-2 flex items-center gap-2">
                    <div class="w-6 h-6 rounded-lg bg-secondary flex items-center justify-center text-white text-xs"><i class="fas fa-image"></i></div>
                    Gambar
                </label>

                <div class="flex items-start gap-6">
                    <div class="w-40 h-40 flex-shrink-0 bg-accent-light/20 border border-border-subtle rounded-xl overflow-hidden flex items-center justify-center">
                        <span class="text-text-muted text-sm">Preview</span>
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center">
                            <input type="file" name="gambar" accept="image/*" class="block w-full px-4 py-3 rounded-xl border border-dashed border-border-subtle focus:outline-none focus:border-primary bg-accent-light/20 hover:bg-accent-light/40 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white file:cursor-pointer">
                        </div>
                        <p class="mt-2 text-xs text-text-muted">Dukungan: JPG, PNG, WEBP • Max 10MB</p>
                    </div>
                </div>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="px-8 py-3 bg-primary text-white rounded-xl font-semibold shadow-lg shadow-primary/25 hover:shadow-xl hover:shadow-primary/30 hover:scale-[1.02] transition-all flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="<?php echo base_url('admin/produk'); ?>" class="px-8 py-3 border border-border-subtle text-text-muted rounded-xl font-medium hover:bg-accent-light/50 hover:border-secondary transition flex items-center gap-2">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<?php $this->load->view('templates/footer_admin'); ?>
