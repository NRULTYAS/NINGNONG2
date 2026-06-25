<?php $this->load->view('templates/header_admin'); ?>

<div class="max-w-2xl mx-auto py-6">
    <div class="mb-6">
        <a href="<?php echo base_url('admin/catering/item/'.$item->paket_id); ?>" class="text-sm text-primary hover:text-primary-hover transition flex items-center gap-1.5">
            <i class="fas fa-arrow-left text-xs"></i> Kembali ke daftar item
        </a>
    </div>

    <div class="bg-surface rounded-2xl shadow-sm border border-border-subtle p-6">
        <h3 class="text-xl font-bold text-primary mb-1 font-heading">Edit Item</h3>
        <p class="text-sm text-text-muted mb-6">Mengedit: <span class="font-semibold text-text-main"><?php echo $item->nama_item; ?></span></p>

        <?php echo form_open(); ?>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-text-main mb-1">Kategori <span class="text-red-500">*</span></label>
                <select name="kategori" class="w-full px-4 py-2.5 border border-border-subtle rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition" required>
                    <option value="Nasi" <?php echo $item->kategori == 'Nasi' ? 'selected' : ''; ?>>Nasi</option>
                    <option value="Lauk" <?php echo $item->kategori == 'Lauk' ? 'selected' : ''; ?>>Lauk</option>
                    <option value="Sayur" <?php echo $item->kategori == 'Sayur' ? 'selected' : ''; ?>>Sayur</option>
                    <option value="Tambahan" <?php echo $item->kategori == 'Tambahan' ? 'selected' : ''; ?>>Tambahan</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-text-main mb-1">Nama Item <span class="text-red-500">*</span></label>
                <input type="text" name="nama_item" value="<?php echo $item->nama_item; ?>" class="w-full px-4 py-2.5 border border-border-subtle rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-text-main mb-1">Harga Tambahan <span class="text-red-500">*</span></label>
                <input type="number" name="harga" value="<?php echo $item->harga; ?>" min="0" class="w-full px-4 py-2.5 border border-border-subtle rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition" required>
            </div>
        </div>

        <div class="mt-6 flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl font-medium hover:shadow-lg transition">
                <i class="fas fa-save mr-1.5"></i> Update Item
            </button>
            <a href="<?php echo base_url('admin/catering/item/'.$item->paket_id); ?>" class="px-6 py-2.5 border border-border-subtle rounded-xl text-text-muted font-medium hover:bg-accent-light transition">
                Batal
            </a>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php $this->load->view('templates/footer_admin'); ?>
