<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nyiru extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu');
            redirect('auth/login');
        }
        $this->load->model('produk_model');
        $this->load->model('pesanan_model');
        $this->load->model('user_model');
    }

    public function index()
    {
        $data['ukuran_list'] = $this->produk_model->get_nyiru();
        $data['user'] = $this->user_model->get_by_id($this->session->userdata('id_user'));
        $this->load->view('pelanggan/nyiru', $data);
    }

    public function proses()
    {
        $id_produk = (int)$this->input->post('id_produk', TRUE);
        $jumlah = (int)$this->input->post('jumlah', TRUE);
        $nama_penerima = $this->input->post('nama_penerima', TRUE);
        $no_hp = $this->input->post('no_hp', TRUE);
        $alamat = $this->input->post('alamat', TRUE);
        $catatan = $this->input->post('catatan', TRUE);
        $tanggal_kirim = $this->input->post('tanggal_kirim', TRUE);

        if (!$id_produk || !$jumlah || !$nama_penerima || !$no_hp || !$alamat || !$tanggal_kirim) {
            $this->session->set_flashdata('error', 'Semua field harus diisi');
            redirect('nyiru');
        }

        if ($jumlah < 1) {
            $this->session->set_flashdata('error', 'Jumlah minimal 1');
            redirect('nyiru');
        }

        $produk = $this->produk_model->get_by_id($id_produk);
        if (!$produk || $produk->stok < $jumlah) {
            $this->session->set_flashdata('error', 'Stok tidak mencukupi');
            redirect('nyiru');
        }

        // Simpan ke session untuk checkout umum
        $this->session->set_userdata('selected_order', [
            'type' => 'nyiru',
            'id_produk' => $produk->id_produk,
            'nama_produk' => $produk->nama_produk,
            'harga' => (int)$produk->harga,
            'jumlah' => $jumlah
        ]);

        redirect('checkout_umum');
    }
}
