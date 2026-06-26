<?php $this->load->view('templates/header_admin'); ?>

<div class="flex justify-between items-center py-6">
    <div>
        <h1 class="text-2xl font-bold text-primary font-heading">Kelola Produk</h1>
        <p class="text-text-subtle">Daftar semua produk kue basah</p>
    </div>
    <a href="<?php echo base_url('admin/produk/tambah'); ?>" class="px-6 py-3 bg-primary text-white rounded-xl font-medium hover:bg-primary-hover transition-all duration-200 flex items-center gap-2 shadow-sm">
        <i class="fas fa-plus text-sm"></i> Tambah Produk
    </a>
</div>

<div class="bg-surface rounded-2xl shadow-sm border border-border-subtle overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-background">
                <tr>
                    <th class="px-6 py-4 font-semibold text-text-main align-middle">Gambar</th>
                    <th class="px-6 py-4 font-semibold text-text-main align-middle">Nama Produk</th>
                    <th class="px-6 py-4 font-semibold text-text-main align-middle">Kategori</th>
                    <th class="px-6 py-4 font-semibold text-text-main align-middle">Rasa</th>
                    <th class="px-6 py-4 font-semibold text-text-main align-middle">Harga</th>
                    <th class="px-6 py-4 font-semibold text-text-main align-middle">Stok</th>
                    <th class="px-6 py-4 font-semibold text-text-main text-right align-middle">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-subtle">
                <?php foreach($produk as $p): ?>
                <tr class="hover:bg-background/60 transition">
                    <td class="px-6 py-4 align-middle">
                        <div class="w-14 h-14 bg-secondary-light rounded-xl flex items-center justify-center overflow-hidden">
                            <?php if($p->gambar && file_exists(FCPATH . 'assets/upload/'.$p->gambar)): ?>
                            <img src="<?php echo base_url('assets/upload/'.$p->gambar); ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                            <i class="fas fa-cookie-bite text-primary/30"></i>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td class="px-6 py-4 font-semibold text-text-main align-middle"><?php echo $p->nama_produk; ?></td>
                    <td class="px-6 py-4 text-text-muted align-middle"><?php echo $p->nama_kategori; ?></td>
                    <td class="px-6 py-4 text-text-muted align-middle"><?php echo $p->rasa; ?></td>
                    <td class="px-6 py-4 font-bold text-primary align-middle">Rp <?php echo number_format($p->harga,0,',','.'); ?></td>
                    <td class="px-6 py-4 align-middle">
                        <span class="px-3 py-1 rounded-full text-xs font-medium <?php echo $p->stok > 5 ? 'bg-secondary-light text-secondary border border-border-subtle' : ($p->stok > 0 ? 'bg-accent-light text-accent border border-accent-light' : 'bg-red-50 text-red-700 border border-red-200'); ?>">
                            <?php echo $p->stok; ?> tersedia
                        </span>
                    </td>
                    <td class="px-6 py-4 align-middle">
                        <div class="flex items-center justify-end gap-2">
                            <a href="<?php echo base_url('admin/produk/edit/'.$p->id_produk . '?page=' . $page); ?>" class="inline-flex items-center justify-center w-9 h-9 bg-secondary-light text-secondary rounded-lg hover:bg-secondary/20 transition border border-border-subtle"><i class="fas fa-edit text-sm"></i></a>
                            <a href="<?php echo base_url('admin/produk/hapus/'.$p->id_produk); ?>" onclick="return confirm('Yakin hapus produk ini?')" class="inline-flex items-center justify-center w-9 h-9 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition border border-red-100"><i class="fas fa-trash text-sm"></i></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php
// Render pagination custom (pill) - replace CI default links
$pagination_html = isset($pagination) ? $pagination : '';


// If CI gave us html, transform it into pill UI
$inside = (string)$pagination_html;
$inside = str_replace('class="current"', 'class="bg-primary text-white"', $inside);
$inside = str_replace('class="active"', 'class="bg-primary text-white"', $inside);
$inside = str_replace('pagination', '', $inside);
$inside = str_replace('<a ', '<a class="h-10 min-w-[40px] px-3 inline-flex items-center justify-center rounded-full bg-secondary-light text-primary font-semibold text-sm hover:-translate-y-[2px] transition-all duration-200 hover:bg-secondary/70" ', $inside);
$inside = str_replace('<span ', '<span class="h-10 min-w-[40px] px-3 inline-flex items-center justify-center rounded-full bg-secondary-light text-primary font-semibold text-sm" ', $inside);
$inside = str_replace('class="bg-primary text-white"', 'class="h-10 min-w-[40px] px-3 inline-flex items-center justify-center rounded-full bg-primary text-white font-semibold text-sm"', $inside);
$inside = str_replace('>Previous<', '><i class="fas fa-chevron-left text-xs mr-2"></i>Previous<', $inside);
$inside = str_replace('>Next<', '><i class="fas fa-chevron-right text-xs ml-2"></i>Next<', $inside);
?>

<div class="mt-6 px-6 pb-6">
    <?php if (!empty($pagination_html)) : ?>
        <div class="flex items-center justify-center flex-wrap gap-2"><?php echo $inside; ?></div>
    <?php endif; ?>
</div>

<?php $this->load->view('templates/footer_admin'); ?>