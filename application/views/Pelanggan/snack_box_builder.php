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

        <!-- Hero Header -->
        <div class="text-center mb-12">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-secondary-light/50 text-primary rounded-full text-sm font-medium mb-4 border border-secondary/20">
                <i class="fas fa-gift text-accent text-xs"></i> 🎁 Snack Box
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-text-main mb-3 font-heading">Susun Box Favoritmu</h1>
            <p class="text-text-muted max-w-lg mx-auto">Susun snack box sesuai kebutuhan Anda dengan mudah dan praktis.</p>
        </div>

        <div class="flex flex-col md:flex-row gap-6 md:gap-8">
            <!-- Main (katalog) -->
            <div class="flex-1 order-1 md:order-1">
                <!-- Radio Button: Semua box sama isi -->
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

                <div id="produkGrid" class="grid grid-cols-3 sm:grid-cols-3 xl:grid-cols-4 gap-2 sm:gap-4">
                    <?php foreach ($produk as $p): ?>
                        <div class="bg-white rounded-2xl border border-coklat-muda/20 p-2 sm:p-3 shadow-sm card-hover flex flex-col h-full" data-kategori="<?php echo $p->id_kategori; ?>">
                            <div class="w-full aspect-square rounded-xl bg-gradient-to-br from-coklat-muda/20 to-krem flex items-center justify-center overflow-hidden border border-coklat-muda/20 mb-2">
                                <?php if($p->gambar && file_exists(FCPATH . 'assets/upload/'.$p->gambar)): ?>
                                    <img src="<?php echo base_url('assets/upload/'.$p->gambar); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <i class="fas fa-cookie-bite text-xl text-coklat-tua/25"></i>
                                <?php endif; ?>
                            </div>
                            <h3 class="font-semibold text-gray-800 text-xs sm:text-sm mb-1 line-clamp-1"><?php echo $p->nama_produk; ?></h3>
                            <p class="text-xs text-gray-400 mb-2">Rp <?php echo number_format($p->harga,0,',','.'); ?></p>

                            <div class="mt-auto flex flex-col gap-1">
                                <div class="flex items-center justify-between bg-krem rounded-lg border border-coklat-muda/30 w-full">
                                    <button type="button"
                                            class="btnMinus w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center text-gray-500 hover:text-coklat-tua transition"
                                            data-item-id="<?php echo $p->id_produk; ?>"
                                            aria-label="Kurangi">
                                        <i class="fas fa-minus text-[10px] sm:text-xs"></i>
                                    </button>
                                    <div class="px-1 text-center">
                                        <div class="text-[10px] text-gray-400">Qty</div>
                                        <div class="font-bold text-coklat-tua text-xs sm:text-sm" id="qty_<?php echo $p->id_produk; ?>">0</div>
                                    </div>
                                    <button type="button"
                                            class="btnPlus w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center text-gray-500 hover:text-coklat-tua transition"
                                            data-item-id="<?php echo $p->id_produk; ?>"
                                            aria-label="Tambah">
                                        <i class="fas fa-plus text-[10px] sm:text-xs"></i>
                                    </button>
                                </div>

                                <button type="button"
                                        class="btnQuickAdd w-full px-1 sm:px-2 py-1 bg-coklat-tua text-white rounded-lg font-semibold text-[10px] sm:text-xs hover:bg-coklat transition">
                                    <i class="fas fa-cart-plus mr-1"></i> Tambah
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <div id="paginationContainer" class="mt-6 flex justify-center items-center gap-1 sm:gap-2">
                    <button id="prevPage" class="px-3 py-1.5 text-sm border border-border-subtle/30 rounded-lg hover:bg-background/50 transition disabled:opacity-50" disabled>
                        <i class="fas fa-chevron-left text-xs"></i>
                    </button>
                    <div id="pageNumbers" class="flex items-center gap-1">
                        <!-- Page numbers will be generated by JS -->
                    </div>
                    <button id="nextPage" class="px-3 py-1.5 text-sm border border-border-subtle/30 rounded-lg hover:bg-background/50 transition disabled:opacity-50" disabled>
                        <i class="fas fa-chevron-right text-xs"></i>
                    </button>
                </div>

                <div class="mt-4 text-center text-xs text-text-subtle">
                    * Klik "Tambah" untuk menambahkan produk ke dalam box.
                </div>
            </div>

            <!-- Sidebar (Ringkasan Pesanan) - Desktop Only -->
            <aside class="w-full md:w-96 order-2 md:order-2 hidden md:block">
                <div class="bg-surface/80 backdrop-blur-sm rounded-3xl border border-border-subtle/20 shadow-sm">
                    <div class="p-4 md:p-6">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h2 class="font-extrabold text-text-main text-lg md:text-xl">Ringkasan Pesanan</h2>
                                <p class="text-text-muted text-xs md:text-sm mt-1">Daftar produk yang telah Anda pilih</p>
                            </div>
                        </div>

                        <div class="mt-4 md:mt-6">
                            <div class="text-[10px] md:text-xs text-text-subtle mb-2">Produk Pilihan</div>
                            <div id="boxItems" class="space-y-2 md:space-y-3 max-h-60 md:max-h-72 overflow-auto pr-1">
                                <!-- terisi dari AJAX -->
                            </div>
                        </div>

                        <div class="mt-4 md:mt-5 border-t border-border-subtle/20 pt-3 md:pt-4">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-text-main text-sm md:text-base">Total Box</span>
                                <span id="totalBox" class="font-extrabold text-xl md:text-2xl text-primary">Rp 0</span>
                            </div>
                        </div>

                        <div class="mt-3 md:mt-4 flex flex-col gap-2">
                            <button id="btnReset" type="button" class="px-3 md:px-4 py-2 md:py-2.5 rounded-xl border border-border-subtle/20 text-text-main font-semibold hover:bg-background/80 transition flex items-center gap-2 text-sm md:text-base">
                                <i class="fas fa-rotate-left text-xs md:text-sm"></i> Reset Box
                            </button>
                            <a href="<?php echo base_url('box_checkout'); ?>" id="btnCheckout" class="px-3 md:px-4 py-2 md:py-3 bg-primary text-white rounded-xl font-semibold hover:bg-primary-hover hover:shadow-lg shadow-primary/20 transition text-center text-sm md:text-base">
                                <i class="fas fa-credit-card mr-1 md:mr-2"></i> Lanjut Checkout
                            </a>
                            <p class="text-[10px] md:text-[11px] text-text-subtle leading-relaxed">
                                Silakan periksa kembali pilihan produk Anda sebelum melanjutkan ke proses checkout.
                            </p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<!-- Mobile Bottom Bar (Ringkasan Singkat) -->
<div id="mobileBottomBar" class="fixed bottom-0 left-0 right-0 bg-white border-t border-border-subtle/30 shadow-[0_-2px_10px_rgba(0,0,0,0.1)] p-3 flex items-center justify-between z-50 md:hidden">
    <div class="flex-1 cursor-pointer" onclick="toggleModal()">
        <div class="text-xs text-text-subtle">Ringkasan</div>
        <div class="font-semibold text-sm" id="mobileSummary">0 item • Rp 0</div>
    </div>
    <a href="<?php echo base_url('box_checkout'); ?>" id="mobileCheckoutBtn" class="px-4 py-2 bg-primary text-white rounded-lg font-semibold text-sm hover:bg-primary-hover transition">
        Lanjut Checkout
    </a>
</div>

<!-- Mobile Modal (Detail Ringkasan) -->
<div id="mobileModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-sm max-h-[80vh] flex flex-col">
        <div class="p-4 border-b border-border-subtle/20">
            <div class="flex items-center justify-between">
                <h3 class="font-bold text-lg">Ringkasan Pesanan</h3>
                <button onclick="toggleModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="p-4 flex-1 overflow-auto">
            <div id="modalBoxItems" class="space-y-2">
                <!-- terisi dari AJAX -->
            </div>
        </div>
        <div class="p-4 border-t border-border-subtle/20">
            <div class="flex justify-between items-center mb-3">
                <span class="font-semibold">Total Box</span>
                <span id="modalTotalBox" class="font-extrabold text-primary">Rp 0</span>
            </div>
            <div class="flex gap-2">
                <button onclick="toggleModal()" class="flex-1 px-3 py-2 border border-border-subtle/20 rounded-lg text-sm">Tutup</button>
                <button id="btnResetMobile" class="px-3 py-2 border border-border-subtle/20 rounded-lg text-sm">
                    <i class="fas fa-rotate-left"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
(function(){
    const endpoint = "<?php echo base_url('pesanan/snack_box_action'); ?>";

    let currentState = null;

    function formatIDR(n){
        const x = Number(n || 0);
        return "Rp " + x.toLocaleString('id-ID');
    }

    function renderBoxesSummary(state){
        const boxItems = document.getElementById('boxItems');
        if(boxItems) {
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
                            "<div class='font-semibold text-gray-800 text-sm truncate'>" + (it.nama_produk || "Item #" + (it.product_id ?? it.item_id)) + "</div>" +
                            "<div class='text-xs text-gray-500'>Qty: <span class='font-semibold'>" + (it.quantity ?? 0) +"</span></div>" +
                        "</div>" +
                        "<div class='text-right'>" +
                            "<div class='text-xs text-gray-500'>Subtotal</div>" +
                            "<div class='font-bold text-coklat-tua'>" + formatIDR(it.subtotal ?? 0) +"</div>" +
                        "</div>";
                    boxItems.appendChild(row);
                });
            }
        }

        // Update desktop total
        const totalBoxEl = document.getElementById('totalBox');
        if(totalBoxEl) totalBoxEl.textContent = formatIDR(state && state.total_box ? state.total_box : 0);

        // Update mobile summary
        const mobileSummary = document.getElementById('mobileSummary');
        if(mobileSummary) {
            const itemCount = state && state.items ? state.items.length : 0;
            mobileSummary.textContent = itemCount + " item • " + formatIDR(state && state.total_box ? state.total_box : 0);
        }

        // Update modal total
        const modalTotalBox = document.getElementById('modalTotalBox');
        if(modalTotalBox) modalTotalBox.textContent = formatIDR(state && state.total_box ? state.total_box : 0);

        // Update modal items
        const modalBoxItems = document.getElementById('modalBoxItems');
        if(modalBoxItems) {
            modalBoxItems.innerHTML = '';
            const items = (state && state.items) ? state.items : [];
            if(items.length === 0){
                modalBoxItems.innerHTML = "<div class='text-sm text-gray-500'>Belum ada produk yang ditambahkan ke dalam box.</div>";
            } else {
                items.forEach(it => {
                    const row = document.createElement('div');
                    row.className = "flex items-start justify-between gap-2 bg-krem/40 border border-coklat-muda/20 rounded-xl p-2";
                    row.innerHTML =
                        "<div class='min-w-0'>" +
                            "<div class='font-semibold text-gray-800 text-xs truncate'>" + (it.nama_produk || "Item #" + (it.product_id ?? it.item_id)) + "</div>" +
                            "<div class='text-[10px] text-gray-500'>Qty: <span class='font-semibold'>" + (it.quantity ?? 0) +"</span></div>" +
                        "</div>" +
                        "<div class='text-right'>" +
                            "<div class='font-bold text-coklat-tua text-xs'>" + formatIDR(it.subtotal ?? 0) +"</div>" +
                        "</div>";
                    modalBoxItems.appendChild(row);
                });
            }
        }
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
            currentState = state;
            renderBoxesSummary(state);
            syncQtyInputs();
        })
        .catch(err => {
            console.error(err);
        });
    }

    // Hook tombol
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

    // Reset button
    const btnReset = document.getElementById('btnReset');
    if(btnReset){
        btnReset.addEventListener('click', () => {
            snackBoxAction({ action:'reset', product_id: null, qty: 0 });
        });
    }

    const btnResetMobile = document.getElementById('btnResetMobile');
    if(btnResetMobile){
        btnResetMobile.addEventListener('click', () => {
            snackBoxAction({ action:'reset', product_id: null, qty: 0 });
        });
    }

    // Load initial state
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
                    
                    // Re-attach event listeners
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

                    syncQtyInputs();
                }
            })
            .catch(err => console.error(err));
        });
    }
})();

// Pagination variables
let currentPage = 1;
let itemsPerPage = 9; // 3 kolom x 3 baris
let allProducts = [];

// Initialize pagination
function initPagination() {
    const grid = document.getElementById('produkGrid');
    if (!grid) return;
    
    allProducts = Array.from(grid.children);
    renderPage(currentPage);
    renderPageNumbers();
}

function renderPage(page) {
    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    
    allProducts.forEach((card, index) => {
        card.style.display = (index >= start && index < end) ? '' : 'none';
    });
    
    // Update button states
    const prevBtn = document.getElementById('prevPage');
    const nextBtn = document.getElementById('nextPage');
    
    if (prevBtn) prevBtn.disabled = page <= 1;
    if (nextBtn) nextBtn.disabled = page >= Math.ceil(allProducts.length / itemsPerPage);
}

function renderPageNumbers() {
    const container = document.getElementById('pageNumbers');
    if (!container) return;
    
    const totalPages = Math.ceil(allProducts.length / itemsPerPage);
    container.innerHTML = '';
    
    for (let i = 1; i <= totalPages; i++) {
        const btn = document.createElement('button');
        btn.className = `w-8 h-8 rounded-lg text-sm font-medium transition ${i === currentPage ? 'bg-primary text-white' : 'border border-border-subtle/30 hover:bg-background/50'}`;
        btn.textContent = i;
        btn.onclick = () => {
            currentPage = i;
            renderPage(currentPage);
            renderPageNumbers();
        };
        container.appendChild(btn);
    }
}

// Mobile modal functions
function toggleModal() {
    const modal = document.getElementById('mobileModal');
    if(modal) {
        modal.classList.toggle('hidden');
        modal.classList.toggle('flex');
    }
}

// Initialize on load
document.addEventListener('DOMContentLoaded', function() {
    initPagination();
    
    // Prev/Next buttons
    const prevBtn = document.getElementById('prevPage');
    const nextBtn = document.getElementById('nextPage');
    
    if (prevBtn) {
        prevBtn.onclick = () => {
            if (currentPage > 1) {
                currentPage--;
                renderPage(currentPage);
                renderPageNumbers();
            }
        };
    }
    
    if (nextBtn) {
        nextBtn.onclick = () => {
            if (currentPage < Math.ceil(allProducts.length / itemsPerPage)) {
                currentPage++;
                renderPage(currentPage);
                renderPageNumbers();
            }
        };
    }
});
</script>

<?php $this->load->view('templates/footer_pelanggan'); ?>