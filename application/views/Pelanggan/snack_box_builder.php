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
            <span class="text-primary font-medium">SNACK BOX</span>
        </div>

        <!-- Hero Header (Gaya A - center-aligned, matching Beli Satuan/Nyiru/Catering) -->
        <div class="text-center mb-12">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-secondary-light/50 text-primary rounded-full text-sm font-medium mb-4 border border-secondary/20">
                <i class="fas fa-gift text-accent text-xs"></i> 🎁 Snack Box
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-text-main mb-3 font-heading">Susun Box Favoritmu</h1>
            <p class="text-text-muted max-w-lg mx-auto">Susun snack box sesuai kebutuhan Anda dengan mudah dan praktis.</p>
        </div>

        <div style="display:flex !important; flex-direction:row !important; align-items:flex-start !important; gap:2rem;">
            <!-- Main kiri (katalog) + Sidebar kanan (Isi Box) -->

            <aside style="flex:0 0 24rem !important; width:24rem !important; order:2;">
                <div class="bg-surface/80 backdrop-blur-sm rounded-3xl border border-border-subtle/20 shadow-sm" style="position: sticky; top: 100px;">




                    <div class="p-6">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h2 class="font-extrabold text-text-main text-xl">Ringkasan Pesanan</h2>
                                <p class="text-text-muted text-sm mt-1">Daftar produk yang telah Anda pilih</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <div class="text-xs text-text-subtle mb-2">Produk Pilihan</div>
                            <div id="boxItems" class="space-y-3 max-h-72 overflow-auto pr-1">
                                <!-- terisi dari AJAX -->
                            </div>
                        </div>

                        <div class="mt-5 border-t border-border-subtle/20 pt-4">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-text-main">Total Box</span>
                                <span id="totalBox" class="font-extrabold text-2xl text-primary">Rp 0</span>
                            </div>
                        </div>

                        <div class="mt-4 flex flex-col gap-2">
                            <button id="btnReset" type="button" class="px-4 py-2.5 rounded-xl border border-border-subtle/20 text-text-main font-semibold hover:bg-background/80 transition flex items-center gap-2">
                                <i class="fas fa-rotate-left"></i> Reset Box
                            </button>
                            <a href="<?php echo base_url('box_checkout'); ?>" id="btnCheckout" class="px-4 py-3 bg-primary text-white rounded-xl font-semibold hover:bg-primary-hover hover:shadow-lg shadow-primary/20 transition text-center">
                                <i class="fas fa-credit-card mr-2"></i> Lanjut Checkout
                            </a>
                            <p class="text-[11px] text-text-subtle leading-relaxed">
                                Silakan periksa kembali pilihan produk Anda sebelum melanjutkan ke proses checkout.
                            </p>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main -->
            <div class="flex-1" style="order:1;">

                <!-- Radio Button: Semua box sama isi (moved out of hero card) -->
                <div class="mb-4 text-right">
                    <label class="flex items-center justify-end gap-2 text-sm text-text-main font-semibold cursor-pointer select-none">
                        <input id="radioSameAll" type="radio" name="dist_mode" value="same_all" checked class="h-4 w-4 text-primary" />
                        Semua box sama isi
                    </label>
                </div>

                <!-- Filter Kategori -->
                <div class="mb-4 bg-surface/80 backdrop-blur-sm rounded-2xl p-4 border border-border-subtle/20 shadow-sm">
                    <div class="flex flex-wrap items-center gap-3">
                        <label class="flex items-center gap-2 text-sm font-semibold text-text-main">
                            <i class="fas fa-filter text-xs"></i> Filter Kategori:
                        </label>
                        <select id="kategoriFilter" class="select-filter px-4 py-2.5 rounded-xl border border-secondary bg-surface text-text-main font-body transition text-sm min-w-[180px]">
                            <option value="all">Semua Kategori</option>
                            <?php foreach ($kategori_list as $k): ?>
                            <option value="<?php echo $k->id_kategori; ?>"><?php echo $k->nama_kategori; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span id="produkCount" class="text-xs text-text-subtle ml-auto"><?php echo count($produk); ?> produk</span>
                    </div>
                </div>

                <div id="produkGrid" class="grid sm:grid-cols-2 xl:grid-cols-3 gap-5">
                        <?php foreach ($produk as $p): ?>
                            <?php
                                // catatan: builder menyimpan state quantity di server session (AJAX).
                                // di view ini kita mulai dari state kosong; quantity per box akan tampil setelah AJAX pertama.
                            ?>
                            <div class="bg-white rounded-2xl border border-coklat-muda/20 p-5 shadow-sm card-hover">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-coklat-muda/20 to-krem flex items-center justify-center overflow-hidden border border-coklat-muda/20">
                                        <?php if($p->gambar && file_exists(FCPATH . 'assets/upload/'.$p->gambar)): ?>
                                            <img src="<?php echo base_url('assets/upload/'.$p->gambar); ?>" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <i class="fas fa-cookie-bite text-2xl text-coklat-tua/25"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h3 class="font-bold text-gray-800 truncate"><?php echo $p->nama_produk; ?></h3>
                                        <p class="text-sm text-gray-400 truncate">Rp <?php echo number_format($p->harga,0,',','.'); ?></p>
                                    </div>
                                </div>

                                <div class="mt-4 flex items-center justify-between gap-3">
                                    <div class="flex items-center bg-krem rounded-xl border border-coklat-muda/30">
                                        <button type="button"
                                                class="btnMinus px-3 py-2 text-gray-500 hover:text-coklat-tua transition"
                                                data-item-id="<?php echo $p->id_produk; ?>"
                                                aria-label="Kurangi">
                                            <i class="fas fa-minus text-xs"></i>
                                        </button>
                                        <div class="px-2 py-2 text-center">
                                            <div class="text-xs text-gray-400">Qty</div>
                                            <div class="font-bold text-coklat-tua" id="qty_<?php echo $p->id_produk; ?>">0</div>
                                        </div>
                                        <button type="button"
                                                class="btnPlus px-3 py-2 text-gray-500 hover:text-coklat-tua transition"
                                                data-item-id="<?php echo $p->id_produk; ?>"
                                                aria-label="Tambah">
                                            <i class="fas fa-plus text-xs"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="button"
                                            class="btnQuickAdd w-full px-3 py-1.5 bg-coklat-tua text-white rounded-xl font-semibold text-sm hover:bg-coklat transition"
                                            data-item-id="<?php echo $p->id_produk; ?>">
                                        <i class="fas fa-cart-plus mr-2"></i> Tambahkan ke Dalam Box
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>


<script>
(function(){
    const endpoint = "<?php echo base_url('pesanan/snack_box_action'); ?>";

    let currentState = null;
    let activeBoxId = 1;

    function formatIDR(n){
        const x = Number(n || 0);
        return "Rp " + x.toLocaleString('id-ID');
    }

    function jsonPost(payload){
        return fetch(endpoint, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json; charset=UTF-8' },
            body: JSON.stringify(payload)
        }).then(r => r.json());
    }

    function renderBoxesSummary(state){
        const boxItems = document.getElementById('boxItems');
        if(!boxItems) return;

        currentState = state;

        boxItems.innerHTML = '';
        const items = (state && state.items) ? state.items : [];

        if(items.length === 0){
            boxItems.innerHTML = "<div class='text-sm text-gray-500'>Belum ada produk yang ditambahkan ke dalam box.</div>";
        } else {
            items.forEach(it => {
                const row = document.createElement('div');
                row.className = "flex items-start justify-between gap-3 bg-krem/40 border border-coklat-muda/20 rounded-2xl p-3";
                row.innerHTML =
                    "<div class='min-w-0'>" +
                        "<div class='font-semibold text-gray-800 text-sm truncate'>Item #" + (it.product_id ?? it.item_id) +"</div>" +
                        "<div class='text-xs text-gray-500'>Qty: <span class='font-semibold'>" + (it.quantity ?? 0) +"</span></div>" +
                    "</div>" +
                    "<div class='text-right'>" +
                        "<div class='text-xs text-gray-500'>Subtotal</div>" +
                        "<div class='font-bold text-coklat-tua'>" + formatIDR(it.subtotal ?? 0) +"</div>" +
                    "</div>";
                boxItems.appendChild(row);
            });
        }

        const totalBoxEl = document.getElementById('totalBox');
        if(totalBoxEl) totalBoxEl.textContent = formatIDR(state && state.total_box ? state.total_box : 0);
    }

    function syncQtyInputs(){
        if(!currentState) return;

        <?php foreach ($produk as $p): ?>
            const el_<?php echo $p->id_produk; ?> = document.getElementById('qty_<?php echo $p->id_produk; ?>');
            if(el_<?php echo $p->id_produk; ?>) el_<?php echo $p->id_produk; ?>.textContent = "0";
        <?php endforeach; ?>

        (currentState.items || []).forEach(it => {
            const pid = it.item_id ?? it.product_id;
            const el = document.getElementById('qty_' + pid);
            if(el) el.textContent = String(it.quantity || 0);
        });
    }

    function snackBoxAction(params){
        return fetch(endpoint, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json; charset=UTF-8' },
            body: JSON.stringify(params)
        })
        .then(r => r.json())
        .then(state => {
            if(!state || state.ok !== true) return;
            renderBoxesSummary(state);
            syncQtyInputs();
        })
        .catch(err => {
            console.error(err);
        });
    }




    // Hook tombol (test mode): hanya kirim {action, product_id, qty}
    document.querySelectorAll('.btnPlus').forEach(btn => {
        btn.addEventListener('click', () => {
            const productId = btn.getAttribute('data-item-id');
            snackBoxAction({ action:'tambah', product_id: productId, qty: 1 });
        });
    });

    document.querySelectorAll('.btnMinus').forEach(btn => {
        btn.addEventListener('click', () => {
            const productId = btn.getAttribute('data-item-id');
            snackBoxAction({ action:'kurang', product_id: productId, qty: -1 });
        });
    });

    document.querySelectorAll('.btnQuickAdd').forEach(btn => {
        btn.addEventListener('click', () => {
            const productId = btn.getAttribute('data-item-id');
            snackBoxAction({ action:'tambah', product_id: productId, qty: 1 });
        });
    });

    // Nonaktifkan sementara tombol yang tidak ada di HTML (btnAddBox)
    const btnReset = document.getElementById('btnReset');
    if(btnReset){
        btnReset.addEventListener('click', () => {
            snackBoxAction({ action:'reset', product_id: null, qty: 0 });
        });
    }

    // Load initial state (tanpa render kompleks)
    snackBoxAction({ action:'init', product_id: null, qty: 0 });

    // Filter kategori AJAX
    const kategoriFilter = document.getElementById('kategoriFilter');
    const produkGrid = document.getElementById('produkGrid');
    const produkCount = document.getElementById('produkCount');
    const filterEndpoint = "<?php echo base_url('pesanan/filter_produk'); ?>";

    if (kategoriFilter) {
        kategoriFilter.addEventListener('change', function() {
            const id_kategori = this.value;
            
            fetch(filterEndpoint, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json; charset=UTF-8' },
                body: JSON.stringify({ id_kategori: id_kategori })
            })
            .then(r => r.json())
            .then(data => {
                if (data.ok && data.html) {
                    produkGrid.innerHTML = data.html;
                    produkCount.textContent = data.produk.length + ' produk';
                    
                    // Re-attach event listeners for the new buttons
                    document.querySelectorAll('.btnPlus').forEach(btn => {
                        btn.addEventListener('click', () => {
                            const productId = btn.getAttribute('data-item-id');
                            snackBoxAction({ action:'tambah', product_id: productId, qty: 1 });
                        });
                    });
                    document.querySelectorAll('.btnMinus').forEach(btn => {
                        btn.addEventListener('click', () => {
                            const productId = btn.getAttribute('data-item-id');
                            snackBoxAction({ action:'kurang', product_id: productId, qty: -1 });
                        });
                    });
                    document.querySelectorAll('.btnQuickAdd').forEach(btn => {
                        btn.addEventListener('click', () => {
                            const productId = btn.getAttribute('data-item-id');
                            snackBoxAction({ action:'tambah', product_id: productId, qty: 1 });
                        });
                    });

                    // Sync qty display with current state
                    syncQtyInputs();
                }
            })
            .catch(err => console.error(err));
        });
    }
})();
</script>


<?php $this->load->view('templates/footer_pelanggan'); ?>