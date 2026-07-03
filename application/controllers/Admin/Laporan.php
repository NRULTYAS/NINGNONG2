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
            $data['total_pendapatan'] = $this->pesanan_model->total_pendapatan_periode($dari, $sampai);
        } else {
            $data['laporan'] = [];
            $data['total_pendapatan'] = 0;
        }

        $data['dari'] = $dari;
        $data['sampai'] = $sampai;
        $this->load->view('admin/laporan', $data);
    }

    public function cetak()
    {
        $dari = $this->input->get('dari');
        $sampai = $this->input->get('sampai');

        if (!$dari || !$sampai) {
            $this->session->set_flashdata('error', 'Pilih periode tanggal terlebih dahulu.');
            redirect('admin/laporan');
            return;
        }

        // Ambil data SAMA PERSIS dengan method yang dipakai di index()
        $data['laporan'] = $this->pesanan_model->laporan_periode($dari, $sampai);
        $data['total_pendapatan'] = $this->pesanan_model->total_pendapatan_periode($dari, $sampai);
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        // Render HTML dari view khusus PDF
        $html = $this->load->view('admin/laporan_pdf', $data, TRUE);

        // Load Dompdf via composer autoload
        require_once FCPATH . 'vendor/autoload.php';

        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Nama file: laporan-pesanan-selesai-tanggal.pdf
        $filename = 'laporan-pesanan-selesai-' . date('Ymd') . '.pdf';

        // Output sebagai download attachment
        $dompdf->stream($filename, array('Attachment' => 1));
        exit;
    }
}
