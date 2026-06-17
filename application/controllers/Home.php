<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('kategori_model');
        $this->load->model('keranjang_model');
    }

    public function index()
    {
        $data['produk_terbaru'] = $this->produk_model->get_latest(8);
        $data['kategori'] = $this->kategori_model->get_all();
        $data['jumlah_keranjang'] = $this->session->userdata('id_user') 
            ? $this->keranjang_model->count_by_user($this->session->userdata('id_user')) 
            : 0;
        $this->load->view('pelanggan/home', $data);
    }
}