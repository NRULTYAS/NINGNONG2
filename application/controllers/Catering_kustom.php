<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class Catering_kustom extends CI_Controller {

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
        $this->load->model('paket_catering_model');
        $this->load->model('item_paket_model');
        $this->load->model('pesanan_model');
        $this->load->model('user_model');
        $this->load->model('keranjang_model');
    }

    public function index($paket_id = null)
    {
        if (!$paket_id) redirect('catering');

        $paket = $this->paket_catering_model->get_by_id($paket_id);
        if (!$paket || $paket->status != 'aktif') redirect('catering');

        $data['paket'] = $paket;
        $data['kategori_list'] = $this->item_paket_model->get_kategori_by_paket($paket_id);
        $data['items_by_kategori'] = [];
        foreach ($data['kategori_list'] as $kat) {
            $data['items_by_kategori'][$kat->kategori] = $this->item_paket_model->get_by_paket_kategori($paket_id, $kat->kategori);
        }
        $data['default_items'] = $this->item_paket_model->get_default_by_paket($paket_id);
        $data['jumlah_keranjang'] = $this->session->userdata('id_user')
            ? $this->keranjang_model->count_by_user($this->session->userdata('id_user'))
            : 0;

        $this->load->view('pelanggan/catering_kustom', $data);
    }

    public function proses()
    {
        $paket_id = $this->input->post('paket_id', TRUE);
        $selected_items = $this->input->post('selected_items', TRUE); // array of item_id

        if (!$paket_id || empty($selected_items)) {
            $this->session->set_flashdata('error', 'Pilih item kustomisasi terlebih dahulu');
            redirect('catering');
        }

        $paket = $this->paket_catering_model->get_by_id($paket_id);
        if (!$paket) redirect('catering');

        // Hitung total biaya tambahan dari item yang dipilih
        $total_tambahan = 0;
        $items_detail = [];
        $kategori_terisi = [];

        foreach ($selected_items as $item_id) {
            $item = $this->item_paket_model->get_by_id($item_id);
            if ($item && $item->paket_id == $paket_id) {
                $total_tambahan += (float)$item->harga;
                $items_detail[] = [
                    'id' => $item->id,
                    'kategori' => $item->kategori,
                    'nama_item' => $item->nama_item,
                    'harga' => (float)$item->harga
                ];
                $kategori_terisi[$item->kategori] = true;
            }
        }

        // Validasi: harus pilih minimal 1 item per kategori
        $kategori_wajib = $this->item_paket_model->get_kategori_by_paket($paket_id);
        foreach ($kategori_wajib as $kw) {
            if (!isset($kategori_terisi[$kw->kategori])) {
                $this->session->set_flashdata('error', 'Pilih minimal 1 item di kategori ' . $kw->kategori);
                redirect('catering_kustom/index/' . $paket_id);
            }
        }

        $harga_per_box = (float)$paket->harga + $total_tambahan;

        // Hapus session dari pesanan sebelumnya (misal snack box) agar tidak tercampur
        $this->session->unset_userdata('order_referrer');
        $this->session->unset_userdata('last_order_success');

        $this->session->set_userdata('selected_order', [
            'type' => 'catering',
            'paket_id' => $paket_id,
            'nama_paket' => $paket->nama_paket,
            'harga_paket' => (float)$paket->harga,
            'total_tambahan' => $total_tambahan,
            'harga_per_box' => $harga_per_box,
            'items' => $items_detail,
            'jumlah_box' => 1
        ]);

        redirect('checkout_umum');
    }
}