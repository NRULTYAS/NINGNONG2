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

    public function index($page = 1)
    {
        $per_page = 12;
        $page = (int)$page;
        if ($page < 1) $page = 1;
        $offset = ($page - 1) * $per_page;

        $keyword = $this->input->get('q', TRUE);
        $id_kategori = $this->input->get('kategori', TRUE);

        $filter_kategori = (!empty($id_kategori)) ? $id_kategori : null;

        // Pagination: jika ada keyword/kategori, pakai query paginated
        if ($keyword || $filter_kategori) {
            $data['produk'] = $this->produk_model->search_paginated($keyword, $filter_kategori, $per_page, $offset);
            $total_rows = $this->produk_model->count_search($keyword, $filter_kategori);
        } else {
            $data['produk'] = $this->produk_model->get_all($per_page, $offset);
            $total_rows = $this->produk_model->count_all();
        }

        $data['kategori'] = $this->kategori_model->get_all();
        $data['keyword'] = $keyword;
        $data['id_kategori'] = $id_kategori;
        $data['jumlah_keranjang'] = $this->session->userdata('id_user') 
            ? $this->keranjang_model->count_by_user($this->session->userdata('id_user')) 
            : 0;

        $config = [
            'base_url' => base_url('produk'),
            'total_rows' => (int)$total_rows,
            'per_page' => $per_page,
            'uri_segment' => 2,
            'page_query_string' => FALSE,
            'use_page_numbers' => TRUE,
        ];

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $page;
        $data['per_page'] = $per_page;
        $data['offset'] = $offset;

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

    public function pesan($id)
    {
        $produk = $this->produk_model->get_by_id($id);
        if (!$produk) {
            $this->session->set_flashdata('error', 'Produk tidak ditemukan');
            redirect('produk');
        }

        if ($produk->stok < 1) {
            $this->session->set_flashdata('error', 'Stok habis');
            redirect('produk');
        }

        // Hapus session dari pesanan sebelumnya agar tidak tercampur
        $this->session->unset_userdata('order_referrer');
        $this->session->unset_userdata('last_order_success');

        $this->session->set_userdata('selected_order', [
            'type' => 'pesan_satuan',
            'id_produk' => $produk->id_produk,
            'nama_produk' => $produk->nama_produk,
            'harga' => (int)$produk->harga,
            'jumlah' => 1
        ]);

        redirect('checkout_umum');
    }
}
