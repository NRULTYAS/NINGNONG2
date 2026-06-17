<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('kategori_model');
        $this->load->model('keranjang_model');
        $this->load->model('rekomendasi');
    }

    public function index()
    {
        $keyword = $this->input->get('q', TRUE);
        $id_kategori = $this->input->get('kategori', TRUE);

        if ($keyword || $id_kategori) {
            $data['produk'] = $this->produk_model->search($keyword, $id_kategori ?: null);
        } else {
            $data['produk'] = $this->produk_model->get_all();
        }

        $data['kategori'] = $this->kategori_model->get_all();
        $data['keyword'] = $keyword;
        $data['id_kategori'] = $id_kategori;
        $data['jumlah_keranjang'] = $this->session->userdata('id_user') 
            ? $this->keranjang_model->count_by_user($this->session->userdata('id_user')) 
            : 0;
        
        $this->load->view('pelanggan/produk', $data);
    }

    public function detail($id)
    {
        $data['produk'] = $this->produk_model->get_by_id($id);
        if (!$data['produk']) {
            show_404();
        }
        $data['rekomendasi'] = $this->rekomendasi->get_rekomendasi($id, 4);
        $data['kategori'] = $this->kategori_model->get_all();
        $data['jumlah_keranjang'] = $this->session->userdata('id_user') 
            ? $this->keranjang_model->count_by_user($this->session->userdata('id_user')) 
            : 0;
        
        $this->load->view('pelanggan/detail_produk', $data);
    }
}
