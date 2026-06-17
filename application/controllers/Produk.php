<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function index()
    {
        $this->load->view('pelanggan/produk');
    }

    public function detail($id)
    {
        $this->load->view('pelanggan/detail_produk');
    }
}
