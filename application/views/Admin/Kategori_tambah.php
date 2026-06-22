<?php $this->load->view('templates/header_admin'); ?>

<div class="max-w-2xl">
    <div class="flex items-center gap-4 mb-8">
        <a href="<?php echo base_url('admin/kategori'); ?>" class="w-12 h-12 bg-gradient-to-br from-coklat-muda to-coklat-susu rounded-2xl flex items-center justify-center text-coklat-tua shadow-md shadow-coklat-muda/20 hover:shadow-lg hover:scale-105 transition-all">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-coklat-tua">Tambah Kategori</h1>
            <p class="text-gray-500">Tambah kategori kue basah baru</p>
        </div>
    </div>

    <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-coklat-muda/20 shadow-lg shadow-coklat-muda/10">
        <?php echo validation_errors('<div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-5 text-sm flex items-center gap-2"><i class="fas fa-exclamation-circle"></i>', '</div>'); ?>
        <form action="<?php echo base_url('admin/kategori/tambah'); ?>" method="post">
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-coklat-tua to-coklat flex items-center justify-center text-white text-xs"><i class="fas fa-tag"></i></div>
                    Nama Kategori
                </label>
                <input type="text" name="nama_kategori" required class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-white shadow-sm transition">
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
                    <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center text-white text-xs"><i class="fas fa-toggle-on"></i></div>
                    Status
                </label>
                <select name="status" class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-white shadow-sm transition">
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-semibold shadow-lg shadow-coklat-tua/25 hover:shadow-xl hover:shadow-coklat-tua/30 hover:scale-[1.02] transition-all flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="<?php echo base_url('admin/kategori'); ?>" class="px-8 py-3 border border-coklat-muda/40 text-gray-600 rounded-xl font-medium hover:bg-krem/50 hover:border-coklat-muda transition flex items-center gap-2">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<?php $this->load->view('templates/footer_admin'); ?>
