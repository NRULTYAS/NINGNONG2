<?php $this->load->view('templates/header_pelanggan'); ?>


<section class="py-12 bg-background min-h-screen relative overflow-hidden">
    <div class="absolute top-10 right-0 w-72 h-72 bg-secondary-light/15 blob opacity-30"></div>
    <div class="absolute bottom-10 left-0 w-72 h-72 bg-primary/10 blob opacity-30"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-text-muted mb-8">
            <a href="<?php echo base_url('home'); ?>" class="hover:text-primary transition-colors duration-200">Beranda</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="<?php echo base_url('pesanan/pilih_jenis'); ?>" class="hover:text-primary transition-colors duration-200">Pesan Sekarang</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-primary font-medium">Beli Satuan</span>
        </div>

        <!-- Header -->
        <div class="text-center mb-12">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-secondary-light/50 text-primary rounded-full text-sm font-medium mb-4 border border-secondary/20">
                <i class="fas fa-shopping-bag text-accent text-xs"></i> 🛍️ Katalog
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-text-main mb-3 font-heading">Daftar Produk</h1>
            <p class="text-text-muted max-w-lg mx-auto">Temukan berbagai kue basah lezat pilihanmu</p>
        </div>

        <!-- Search & Filter -->
        <div class="bg-surface/80 backdrop-blur-sm rounded-2xl p-6 shadow-sm mb-10 border border-border-subtle/20">
            <form action="<?php echo base_url('produk'); ?>" method="get" class="flex flex-col md:flex-row gap-4">

                <div class="flex-1 relative group">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-text-subtle"></i>

                    <input
                        type="text"
                        name="q"
                        value="<?php echo $keyword; ?>"
                        placeholder="Cari produk..."
                        class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-border-subtle/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-background/30 transition-colors duration-200">
                </div>

                <select name="kategori" onchange="this.form.submit()" class="px-4 py-3.5 rounded-xl border border-border-subtle/30 bg-background/30 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors duration-200">
                    <option value="" <?php echo (!isset($id_kategori) || $id_kategori === '' || $id_kategori === null) ? 'selected' : ''; ?>>Semua Kategori</option>

                    <?php foreach($kategori as $k): ?>
                        <option value="<?php echo (int)$k->id_kategori; ?>"
                            <?php echo (string)(int)$id_kategori === (string)(int)$k->id_kategori ? 'selected' : ''; ?>>
                            <?php echo $k->nama_kategori; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button type="submit"
                    class="px-8 py-3.5 bg-primary text-white rounded-full hover:bg-primary-hover transition-all duration-200 shadow-md shadow-primary/20">
                    Cari
                </button>
            </form>
        </div>

        <?php if(empty($produk)): ?>

            <div class="text-center py-20">
                <h3 class="text-xl font-semibold text-text-main mb-2">
                    Produk tidak ditemukan
                </h3>

                <p class="text-text-muted">
                    Coba kata kunci atau kategori lain
                </p>
            </div>

        <?php else: ?>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <?php foreach($produk as $p): ?>

                    <div class="bg-surface rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-200">

                        <div class="aspect-[4/3] bg-gradient-to-br from-primary/10 to-background flex items-center justify-center relative overflow-hidden">

                            <?php if($p->gambar && file_exists(FCPATH . 'assets/upload/'.$p->gambar)): ?>
                                <img src="<?php echo base_url('assets/upload/'.$p->gambar); ?>"
                                     alt="<?php echo $p->nama_produk; ?>"
                                     class="w-full h-full object-cover">
                            <?php else: ?>
                                <i class="fas fa-cookie-bite text-6xl text-primary/15"></i>
                            <?php endif; ?>

                        </div>

                        <div class="p-6">
                            <h3 class="font-bold text-text-main mb-1">
                                <?php echo $p->nama_produk; ?>
                            </h3>

                            <p class="text-sm text-text-muted mb-3">
                                Rasa <?php echo $p->rasa; ?>
                                •
                                Stok <?php echo $p->stok; ?>
                            </p>

                            <div class="flex items-center justify-between mb-3">
                                <span class="text-primary font-bold text-lg">
                                    Rp <?php echo number_format($p->harga,0,',','.'); ?>
                                </span>

                                <!-- Qty Selector -->
                                <div class="flex items-center bg-background rounded-xl border border-border-subtle/30">
                                    <button type="button"
                                            class="btnQtyMinus px-3 py-2 text-text-subtle hover:text-primary transition"
                                            data-id="<?php echo $p->id_produk; ?>">
                                        <i class="fas fa-minus text-xs"></i>
                                    </button>
                                    <span class="qtyDisplay px-2 py-2 font-bold text-text-main text-sm min-w-[28px] text-center"
                                          id="qty_<?php echo $p->id_produk; ?>">1</span>
                                    <button type="button"
                                            class="btnQtyPlus px-3 py-2 text-text-subtle hover:text-primary transition"
                                            data-id="<?php echo $p->id_produk; ?>">
                                        <i class="fas fa-plus text-xs"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Tombol Tambah ke Keranjang -->
                            <button type="button"
                                    class="btnAddCart w-full px-4 py-2.5 bg-primary text-white rounded-full text-sm font-semibold hover:bg-primary-hover transition-all duration-200 flex items-center justify-center gap-2 shadow-md shadow-primary/20"
                                    data-id="<?php echo $p->id_produk; ?>"
                                    data-stok="<?php echo $p->stok; ?>">
                                <i class="fas fa-cart-plus text-xs"></i> Tambah ke Keranjang
                            </button>
                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>
    </div>
</section>

<!-- Toast Notification -->
<div id="toast-notif" class="fixed top-24 right-4 z-[9999] bg-surface border border-border-subtle shadow-lg rounded-2xl px-5 py-3.5 flex items-center gap-3 transform translate-x-[150%] transition-transform duration-300 ease-in-out">
    <span class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center text-green-600">
        <i class="fas fa-check text-xs"></i>
    </span>
    <span id="toast-msg" class="text-sm font-medium text-text-main"></span>
</div>

<script>
(function() {
    // ===== Qty +/- =====
    document.querySelectorAll('.btnQtyPlus').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const el = document.getElementById('qty_' + id);
            const stok = parseInt(this.closest('.bg-surface').querySelector('.btnAddCart').dataset.stok) || 999;
            let val = parseInt(el.textContent) || 1;
            if (val < stok) {
                el.textContent = val + 1;
            } else {
                showToast('Stok maksimal ' + stok);
            }
        });
    });

    document.querySelectorAll('.btnQtyMinus').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const el = document.getElementById('qty_' + id);
            let val = parseInt(el.textContent) || 1;
            if (val > 1) {
                el.textContent = val - 1;
            }
        });
    });

    // ===== Tambah ke Keranjang (AJAX) =====
    function showToast(msg) {
        const toast = document.getElementById('toast-notif');
        const msgEl = document.getElementById('toast-msg');
        msgEl.textContent = msg;
        toast.classList.remove('translate-x-[150%]');
        toast.classList.add('translate-x-0');
        setTimeout(() => {
            toast.classList.remove('translate-x-0');
            toast.classList.add('translate-x-[150%]');
        }, 2500);
    }

    function updateCartBadge(total) {
        const badge = document.querySelector('a[href="<?php echo base_url('keranjang'); ?>"] .rounded-full');
        if (badge) {
            badge.textContent = total;
        } else if (total > 0) {
            // Jika badge belum ada, tambahkan
            const cartLink = document.querySelector('a[href="<?php echo base_url('keranjang'); ?>"]');
            if (cartLink) {
                const span = document.createElement('span');
                span.className = 'absolute -top-0.5 -right-0.5 bg-accent text-white text-[10px] rounded-full w-5 h-5 flex items-center justify-center font-bold shadow-md';
                span.textContent = total;
                cartLink.appendChild(span);
            }
        }
    }

    document.querySelectorAll('.btnAddCart').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const qtyEl = document.getElementById('qty_' + id);
            const qty = parseInt(qtyEl.textContent) || 1;

            // Disable tombol sementara
            this.disabled = true;
            this.innerHTML = '<i class="fas fa-spinner fa-spin text-xs"></i> Menambahkan...';

            const formData = new FormData();
            formData.append('id_produk', id);
            formData.append('jumlah', qty);

            fetch('<?php echo base_url('keranjang/tambah_ajax'); ?>', {
                method: 'POST',
                body: formData
            })
            .then(r => r.json())
            .then(res => {
                if (res.ok) {
                    showToast(res.msg);
                    updateCartBadge(res.total_item);
                    // Reset qty ke 1 setelah berhasil
                    qtyEl.textContent = 1;
                } else {
                    showToast(res.msg || 'Gagal menambahkan');
                }
            })
            .catch(() => {
                showToast('Terjadi kesalahan, coba lagi');
            })
            .finally(() => {
                this.disabled = false;
                this.innerHTML = '<i class="fas fa-cart-plus text-xs"></i> Tambah ke Keranjang';
            });
        });
    });
})();
</script>

<?php $this->load->view('templates/footer_pelanggan'); ?>