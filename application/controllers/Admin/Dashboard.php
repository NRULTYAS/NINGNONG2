<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->cek_admin();
        $this->load->model('produk_model');
        $this->load->model('kategori_model');
        $this->load->model('pesanan_model');
        $this->load->model('user_model');
    }

    private function cek_admin() {
        if (!$this->session->userdata('id_user') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['total_produk'] = $this->produk_model->count_all();
        $data['total_kategori'] = $this->kategori_model->count_all();
        $data['total_pesanan'] = $this->pesanan_model->count_all();
        $data['total_pelanggan'] = $this->user_model->count_all();
        $data['total_penjualan'] = $this->pesanan_model->total_penjualan();
        $data['pesanan_pending'] = $this->pesanan_model->count_by_status('pending');
        $data['pesanan_diproses'] = $this->pesanan_model->count_by_status('diproses');
        $data['pesanan_dikirim'] = $this->pesanan_model->count_by_status('dikirim');
        $data['pesanan_selesai'] = $this->pesanan_model->count_by_status('selesai');
        $this->load->view('admin/dashboard', $data);
    }
}
