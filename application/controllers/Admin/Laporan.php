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
        // Hindari warning/error PHP ikut ke output sebelum PDF header dikirim.
        if (function_exists('ini_set')) {
            @ini_set('display_errors', 0);
            @error_reporting(0);
        }

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


        // --- FONT CONFIG (fix FontNotFoundException) ---
        // Gunakan font yang tersedia di vendor/dompdf/dompdf/lib/fonts
        $fontDir = FCPATH . 'vendor/dompdf/dompdf/lib/fonts';
        $fontCacheDir = FCPATH . 'application/cache/dompdf-fonts';

        if (!is_dir($fontCacheDir)) {
            @mkdir($fontCacheDir, 0775, true);
        }

        // Pastikan writable (jika tidak, fallback akan gagal lagi)
        if (is_dir($fontCacheDir) && !is_writable($fontCacheDir)) {
            // Jika server tidak mengizinkan, jangan silent fail tanpa info.
            // Namun tetap lanjut agar existing dompdf bisa coba fallback.
        }

        $opts = $dompdf->getOptions();
        // Izinkan akses ke folder project agar Dompdf bisa membaca asset seperti logo.
        $opts->setChroot('/Applications/XAMPP/xamppfiles/htdocs/NINGNONG2');
        // Default dompdf lebih suka absolute filesystem path (jadi isRemoteEnabled tidak wajib).
        // Tapi jika image tetap tidak kebaca, opsi ini akan membantu.
        $opts->set('isRemoteEnabled', true);
        $opts->set('DOMPDF_FONT_DIR', $fontDir);
        $opts->set('DOMPDF_FONT_CACHE', $fontCacheDir);
        $dompdf->setOptions($opts);




        // Bersihkan cache font lama agar tidak corrupt
        // (dompdf menyimpan json cache/font metrics)
        foreach (glob($fontCacheDir . '/*') as $f) {
            @unlink($f);
        }

        // Daftarkan font via user font cache file
        // php-font-lib's FontMetrics tidak menyediakan method static registerFont() pada versi ini.
        // Jadi konfigurasi utama dilakukan lewat DOMPDF_FONT_DIR + DOMPDF_FONT_CACHE.

        // --- render ---

        // Jika ada image yang gagal dirender, dompdf kadang tetap tanpa output jelas.
        // Pastikan dompdf tahu root untuk akses file image.
        $dompdf->setBasePath('/Applications/XAMPP/xamppfiles/htdocs/NINGNONG2');

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();




        // Nama file: laporan-pesanan-selesai-tanggal.pdf
        $filename = 'laporan-pesanan-selesai-' . date('Ymd') . '.pdf';

        // Output: tampilkan inline dulu (Attachment false), biar user bisa preview.
        $dompdf->stream($filename, array('Attachment' => 0));
        exit;

    }
}
