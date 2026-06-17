<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat extends CI_Controller {

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
        $this->load->model('pesanan_model');
        $this->load->model('keranjang_model');
        $this->load->model('kategori_model');
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        $data['pesanan'] = $this->pesanan_model->get_by_user($id_user);
        $data['kategori'] = $this->kategori_model->get_all();
        $data['jumlah_keranjang'] = $this->keranjang_model->count_by_user($id_user);
        $this->load->view('pelanggan/riwayat', $data);
    }

    public function detail($id)
    {
        $id_user = $this->session->userdata('id_user');
        $pesanan = $this->pesanan_model->get_by_id($id);
        if (!$pesanan || $pesanan->id_user != $id_user) {
            show_404();
        }
        $data['pesanan'] = $pesanan;
        $data['detail'] = $this->pesanan_model->get_detail($id);
        $data['kategori'] = $this->kategori_model->get_all();
        $data['jumlah_keranjang'] = $this->keranjang_model->count_by_user($id_user);
        $this->load->view('pelanggan/detail_pesanan', $data);
    }
}