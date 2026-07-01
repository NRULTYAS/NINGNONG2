<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('id_user')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu');
            redirect('auth/login');
        }

        if ($this->session->userdata('role') == 'admin') {
            $this->session->set_flashdata('error', 'Admin tidak dapat mengakses fitur pelanggan');
            redirect('admin/dashboard');
        }

        $this->load->helper(['url']);
        $this->load->model('produk_model');
        $this->load->model('kategori_model');
    }

    public function pilih_jenis() {
        $this->load->view('pelanggan/pilih_jenis_pesanan');
    }

    /**
     * Halaman builder Snack Box
     */
    public function snack_box_builder() {
        $data['produk'] = $this->produk_model->get_snack_box();
        $data['kategori_list'] = $this->kategori_model->get_active();
        $this->_initSnackBoxSession();
        $this->load->view('Pelanggan/snack_box_builder', $data);
    }

    /**
     * Endpoint AJAX untuk filter produk berdasarkan kategori
     */
    public function filter_produk() {
        if (function_exists('header_remove')) {
            header_remove('X-Powered-By');
        }
        if (!headers_sent()) {
            header('Content-Type: application/json; charset=utf-8');
        }
        $this->output->set_content_type('application/json');
        $this->output->set_status_header(200);

        $raw = file_get_contents('php://input');
        $jsonBody = null;
        if ($raw !== false && $raw !== '') {
            $tmp = json_decode($raw, true);
            if (is_array($tmp)) $jsonBody = $tmp;
        }

        $id_kategori = $jsonBody['id_kategori'] ?? $this->input->post('id_kategori', TRUE);

        if ($id_kategori && $id_kategori != 'all') {
            $produk = $this->produk_model->get_snack_box_by_kategori($id_kategori);
        } else {
            $produk = $this->produk_model->get_snack_box();
        }

        $html = '';
        foreach ($produk as $p) {
            $gambarSrc = $p->gambar && file_exists(FCPATH . 'assets/upload/' . $p->gambar)
                ? base_url('assets/upload/' . $p->gambar)
                : '';
            $html .= '<div class="bg-white rounded-2xl border border-coklat-muda/20 p-5 shadow-sm card-hover">';
            $html .= '<div class="flex items-center gap-4">';
            $html .= '<div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-coklat-muda/20 to-krem flex items-center justify-center overflow-hidden border border-coklat-muda/20">';
            if ($gambarSrc) {
                $html .= '<img src="' . $gambarSrc . '" class="w-full h-full object-cover">';
            } else {
                $html .= '<i class="fas fa-cookie-bite text-2xl text-coklat-tua/25"></i>';
            }
            $html .= '</div>';
            $html .= '<div class="min-w-0 flex-1">';
            $html .= '<h3 class="font-bold text-gray-800 truncate">' . htmlspecialchars($p->nama_produk, ENT_QUOTES, 'UTF-8') . '</h3>';
            $html .= '<p class="text-sm text-gray-400 truncate">Rp ' . number_format($p->harga, 0, ',', '.') . '</p>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="mt-4 flex items-center justify-between gap-3">';
            $html .= '<div class="flex items-center bg-krem rounded-xl border border-coklat-muda/30">';
            $html .= '<button type="button" class="btnMinus px-3 py-2 text-gray-500 hover:text-coklat-tua transition" data-item-id="' . $p->id_produk . '" aria-label="Kurangi"><i class="fas fa-minus text-xs"></i></button>';
            $html .= '<div class="px-2 py-2 text-center">';
            $html .= '<div class="text-xs text-gray-400">Qty</div>';
            $html .= '<div class="font-bold text-coklat-tua" id="qty_' . $p->id_produk . '">0</div>';
            $html .= '</div>';
            $html .= '<button type="button" class="btnPlus px-3 py-2 text-gray-500 hover:text-coklat-tua transition" data-item-id="' . $p->id_produk . '" aria-label="Tambah"><i class="fas fa-plus text-xs"></i></button>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="mt-4">';
            $html .= '<button type="button" class="btnQuickAdd w-full px-3 py-1.5 bg-coklat-tua text-white rounded-xl font-semibold text-sm hover:bg-coklat transition" data-item-id="' . $p->id_produk . '"><i class="fas fa-cart-plus mr-2"></i> Tambahkan ke Dalam Box</button>';
            $html .= '</div>';
            $html .= '</div>';            
        }

        $response = [
            'ok' => true,
            'produk' => $produk,
            'html' => $html
        ];

        $json = json_encode($response);
        $this->output->set_output($json);
        echo $json;
        exit;
    }

    /**
     * Endpoint AJAX untuk mengubah box/item tanpa reload (TEST MODE)
     *
     * Rule test:
     * - selalu return ok:true
     * - tanpa logic box
     * - echo fields dari request: action, box_id, item_id, product_id, qty
     */
    public function snack_box_action() {
        if (function_exists('header_remove')) {
            header_remove('X-Powered-By');
        }
        if (!headers_sent()) {
            header('Content-Type: application/json; charset=utf-8');
        }
        $this->output->set_content_type('application/json');
        $this->output->set_status_header(200);

        $raw = file_get_contents('php://input');
        $jsonBody = null;
        if ($raw !== false && $raw !== '') {
            $tmp = json_decode($raw, true);
            if (is_array($tmp)) $jsonBody = $tmp;
        }

        $action = $jsonBody['action'] ?? $this->input->post('action', TRUE);
        $product_id = $jsonBody['product_id'] ?? $this->input->post('product_id', TRUE);
        $qty = $jsonBody['qty'] ?? $this->input->post('qty', TRUE);

        $product_id_norm = is_numeric($product_id) ? (int)$product_id : null;
        $qty_norm = is_numeric($qty) ? (int)$qty : 0;

        $state = $this->_initSnackBoxSession();

        // Hanya 1 box aktif (tanpa box_id dari frontend)
        if (!isset($state['active_box_items']) || !is_array($state['active_box_items'])) {
            $state['active_box_items'] = [];
        }

        if ($action === 'tambah' || $action === 'kurang') {
            if ($product_id_norm !== null) {
                if (!isset($state['active_box_items'][$product_id_norm])) {
                    $state['active_box_items'][$product_id_norm] = 0;
                }

                // qty dikirim sebagai +1 / -1
                $state['active_box_items'][$product_id_norm] += $qty_norm;

                if ($state['active_box_items'][$product_id_norm] <= 0) {
                    unset($state['active_box_items'][$product_id_norm]);
                }
            }
        } elseif ($action === 'reset') {
            $state['active_box_items'] = [];
        }

        // Ambil harga produk untuk subtotal
        $productRows = [];
        if (!empty($state['active_box_items'])) {
            $productIds = array_map('intval', array_keys($state['active_box_items']));

            if (method_exists($this->produk_model, 'get_by_ids')) {
                $productRows = $this->produk_model->get_by_ids($productIds);
            } else {
                $all = $this->produk_model->get_all();
                foreach ($all as $row) {
                    $pid = (int)$row->id_produk;
                    if (in_array($pid, $productIds, true)) {
                        $productRows[$pid] = $row;
                    }
                }
            }
        }

        $items = [];
        $total_box = 0;

        foreach ($state['active_box_items'] as $pid => $quantity) {
            $pid = (int)$pid;
            $quantity = (int)$quantity;

            $price = 0;
            if (isset($productRows[$pid])) {
                $price = (int)($productRows[$pid]->harga ?? 0);
            }

            $subtotal = $price * $quantity;
            $items[] = [
                'item_id' => $pid,
                'product_id' => $pid,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
                'nama_produk' => $productRows[$pid]->nama_produk ?? 'Item #'.$pid
            ];

            $total_box += $subtotal;
        }

        $response = [
            'ok' => true,
            'active_box_id' => 1,
            'items' => $items,
            'total_box' => $total_box,
            'boxes' => [
                [
                    'box_id' => 1
                ]
            ]
        ];

        $this->session->set_userdata('snack_box_state', $state);

        $json = json_encode($response);
        $this->output->set_output($json);
        echo $json;
        exit;
    }




    private function _initSnackBoxSession() {
        $state = $this->session->userdata('snack_box_state');
        if (!is_array($state) || empty($state)) {
            $state = [
                'active_box_id' => 1,
                'next_box_id' => 2,
                'boxes' => [
                    '1' => []
                ]
            ];
            $this->session->set_userdata('snack_box_state', $state);
        }
        return $state;
    }

    private function _buildBoxesSummary($state) {
        $summary = [];
        $boxes = $state['boxes'] ?? [];
        foreach ($boxes as $boxId => $itemsAssoc) {
            $total = 0;
            $countItems = 0;
            foreach ($itemsAssoc as $it) {
                $countItems++;
                $total += (int)($it['subtotal'] ?? 0);
            }
            $summary[] = [
                'box_id' => (int)$boxId,
                'items_count' => $countItems,
                'total_box' => $total
            ];
        }
        // sort by box_id asc
        usort($summary, function($a,$b){ return $a['box_id'] <=> $b['box_id']; });
        return $summary;
    }

    private function _returnJson($arr) {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($arr));
    }
}
