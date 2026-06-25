<?php $this->load->view('templates/header_admin'); ?>

<div class="max-w-2xl py-6">
    <div class="flex items-center gap-4 mb-8">
        <a href="<?php echo base_url('admin/catering'); ?>" class="w-12 h-12 bg-secondary rounded-2xl flex items-center justify-center text-white shadow-md shadow-secondary/20 hover:shadow-lg hover:scale-105 transition-all">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-primary font-heading">Edit Paket Catering</h1>
            <p class="text-text-muted">Ubah data paket nasi kotak</p>
        </div>
    </div>

    <div class="bg-surface rounded-2xl shadow-sm border border-border-subtle p-6">
        <?php echo validation_errors('<div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-5 text-sm flex items-center gap-2"><i class="fas fa-exclamation-circle"></i>', '</div>'); ?>
        <form action="<?php echo base_url('admin/catering/edit/'.$paket->id); ?>" method="post" enctype="multipart/form-data">
            <div class="mb-5">
                <label class="block text-sm font-semibold text-text-main mb-2 flex items-center gap-2">
                    <div class="w-6 h-6 rounded-lg bg-primary flex items-center justify-center text-white text-xs"><i class="fas fa-tag"></i></div>
                    Nama Paket
                </label>
                <input type="text" name="nama_paket" value="<?php echo $paket->nama_paket; ?>" required class="w-full px-4 py-3 rounded-xl border border-border-subtle focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-surface shadow-sm transition">
            </div>
            <div class="grid grid-cols-2 gap-6 mb-5">
                <div>
                    <label class="block text-sm font-semibold text-text-main mb-2 flex items-center gap-2">
                        <div class="w-6 h-6 rounded-lg bg-secondary flex items-center justify-center text-white text-xs"><i class="fas fa-money-bill-wave"></i></div>
                        Harga (Rp)
                    </label>
                    <input type="number" name="harga" value="<?php echo $paket->harga; ?>" required class="w-full px-4 py-3 rounded-xl border border-border-subtle focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-surface shadow-sm transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-text-main mb-2 flex items-center gap-2">
                        <div class="w-6 h-6 rounded-lg bg-secondary flex items-center justify-center text-white text-xs"><i class="fas fa-users"></i></div>
                        Porsi
                    </label>
                    <input type="number" name="porsi" value="<?php echo $paket->porsi; ?>" required class="w-full px-4 py-3 rounded-xl border border-border-subtle focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-surface shadow-sm transition">
                </div>
            </div>
            <div class="mb-5">
                <label class="block text-sm font-semibold text-text-main mb-2 flex items-center gap-2">
                    <div class="w-6 h-6 rounded-lg bg-purple-500 flex items-center justify-center text-white text-xs"><i class="fas fa-list"></i></div>
                    Isi Paket
                </label>
                <textarea name="isi_paket" rows="4" required class="w-full px-4 py-3 rounded-xl border border-border-subtle focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-surface shadow-sm transition resize-none"><?php echo $paket->isi_paket; ?></textarea>
            </div>
            <div class="mb-5">
                <label class="block text-sm font-semibold text-text-main mb-2 flex items-center gap-2">
                    <div class="w-6 h-6 rounded-lg bg-secondary flex items-center justify-center text-white text-xs"><i class="fas fa-image"></i></div>
                    Foto Paket
                </label>
                <?php if($paket->foto && $paket->foto != 'default.jpg' && file_exists(FCPATH . 'assets/upload/'.$paket->foto)): ?>
                <div class="mb-3 p-3 bg-accent-light/30 rounded-xl inline-block">
                    <img src="<?php echo base_url('assets/upload/'.$paket->foto); ?>" class="w-32 h-32 object-cover rounded-xl border border-border-subtle shadow-sm">
                </div>
                <?php endif; ?>
                <div class="relative">
                    <input type="file" name="foto" accept="image/*" class="w-full px-4 py-3 rounded-xl border border-dashed border-border-subtle focus:outline-none focus:border-primary bg-accent-light/20 hover:bg-accent-light/40 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white file:cursor-pointer">
                </div>
            </div>
            <div class="mb-8">
                <label class="block text-sm font-semibold text-text-main mb-2 flex items-center gap-2">
                    <div class="w-6 h-6 rounded-lg bg-secondary flex items-center justify-center text-white text-xs"><i class="fas fa-toggle-on"></i></div>
                    Status
                </label>
                <select name="status" class="w-full px-4 py-3 rounded-xl border border-border-subtle focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-surface shadow-sm transition">
                    <option value="aktif" <?php echo $paket->status == 'aktif' ? 'selected' : ''; ?>>Aktif</option>
                    <option value="nonaktif" <?php echo $paket->status == 'nonaktif' ? 'selected' : ''; ?>>Nonaktif</option>
                </select>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="px-8 py-3 bg-primary text-white rounded-xl font-semibold shadow-lg shadow-primary/25 hover:shadow-xl hover:shadow-primary/30 hover:scale-[1.02] transition-all flex items-center gap-2">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="<?php echo base_url('admin/catering'); ?>" class="px-8 py-3 border border-border-subtle text-text-muted rounded-xl font-medium hover:bg-accent-light/50 hover:border-secondary transition flex items-center gap-2">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<?php $this->load->view('templates/footer_admin'); ?>
