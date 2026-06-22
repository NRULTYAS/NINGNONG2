<?php $this->load->view('templates/header_admin'); ?>

<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="<?php echo base_url('admin/catering/item/'.$paket->id); ?>" class="text-sm text-coklat hover:text-coklat-tua transition flex items-center gap-1.5">
            <i class="fas fa-arrow-left text-xs"></i> Kembali ke daftar item
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
        <h3 class="text-xl font-bold text-coklat-tua mb-1">Tambah Item Baru</h3>
        <p class="text-sm text-gray-500 mb-6">Paket: <span class="font-semibold text-gray-700"><?php echo $paket->nama_paket; ?></span></p>

        <?php echo form_open(); ?>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                <select name="kategori" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-coklat-tua/20 focus:border-coklat-tua outline-none transition" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Nasi">Nasi</option>
                    <option value="Lauk">Lauk</option>
                    <option value="Sayur">Sayur</option>
                    <option value="Tambahan">Tambahan</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Item <span class="text-red-500">*</span></label>
                <input type="text" name="nama_item" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-coklat-tua/20 focus:border-coklat-tua outline-none transition" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga Tambahan <span class="text-red-500">*</span></label>
                <input type="number" name="harga" value="0" min="0" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-coklat-tua/20 focus:border-coklat-tua outline-none transition" required>
                <p class="text-xs text-gray-400 mt-1">Isi 0 jika item sudah termasuk dalam harga paket (gratis)</p>
            </div>
        </div>

        <div class="mt-6 flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-medium hover:shadow-lg transition">
                <i class="fas fa-save mr-1.5"></i> Simpan Item
            </button>
            <a href="<?php echo base_url('admin/catering/item/'.$paket->id); ?>" class="px-6 py-2.5 border border-gray-300 rounded-xl text-gray-600 font-medium hover:bg-gray-50 transition">
                Batal
            </a>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php $this->load->view('templates/footer_admin'); ?>