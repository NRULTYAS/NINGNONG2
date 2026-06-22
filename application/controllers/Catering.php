<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catering extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('paket_catering_model');
        $this->load->model('keranjang_model');
    }

    public function index()
    {
        $data['paket'] = $this->paket_catering_model->get_active();
        $data['jumlah_keranjang'] = $this->session->userdata('id_user') 
            ? $this->keranjang_model->count_by_user($this->session->userdata('id_user')) 
            : 0;
        $this->load->view('pelanggan/catering', $data);
    }
}