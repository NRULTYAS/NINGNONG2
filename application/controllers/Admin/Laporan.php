<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->cek_admin();
        $this->load->model('pesanan_model');
    }


    private function cek_admin() {
        if (!$this->session->userdata('id_user') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $dari = $this->input->get('dari');
        $sampai = $this->input->get('sampai');

        if ($dari && $sampai) {
            $data['laporan'] = $this->pesanan_model->laporan_periode($dari, $sampai);
        } else {
            $data['laporan'] = [];
        }

        $data['dari'] = $dari;
        $data['sampai'] = $sampai;
        $this->load->view('admin/laporan', $data);
    }

    // PDF export feature removed - using web-based report view instead

}






