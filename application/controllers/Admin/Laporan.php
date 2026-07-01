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
            // Ambil data detail pesanan untuk laporan (untuk render tabel di view)
            $data['laporan'] = $this->pesanan_model->laporan_periode($dari, $sampai);

            // Total pendapatan sesuai periode (untuk card ringkasan + baris TOTAL)
            $data['total_pendapatan'] = $this->pesanan_model->total_pendapatan_periode($dari, $sampai);
        } else {
            $data['laporan'] = [];
            $data['total_pendapatan'] = 0;
        }


        $data['dari'] = $dari;
        $data['sampai'] = $sampai;
        $this->load->view('admin/laporan', $data);
    }
    // PDF export feature removed - using web-based report view instead
}