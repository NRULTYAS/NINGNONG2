<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class Catering_checkout extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu');
            redirect('auth/login');
        }
        if ($this->session->userdata('role') == 'admin') {
            $this->session->set_flashdata('error', 'Admin tidak dapat mengakses fitur pelanggan');
            redirect('admin/dashboard');
        }
        $this->load->model('paket_catering_model');
        $this->load->model('item_paket_model');
        $this->load->model('pesanan_model');
        $this->load->model('user_model');
        $this->load->model('keranjang_model');
        $this->load->library('upload');
    }

    public function index()
    {
        $catering_order = $this->session->userdata('catering_order');
        if (!$catering_order) {
            redirect('catering');
        }

        $id_user = $this->session->userdata('id_user');
        $data['user'] = $this->user_model->get_by_id($id_user);
        $data['catering_order'] = $catering_order;
        $data['jumlah_keranjang'] = $this->keranjang_model->count_by_user($id_user);

        $this->load->view('pelanggan/catering_checkout', $data);
    }

    public function proses()
    {
        $catering_order = $this->session->userdata('catering_order');
        if (!$catering_order) {
            redirect('catering');
        }

        $id_user = $this->session->userdata('id_user');

        $nama_penerima = $this->input->post('nama_penerima', TRUE);
        $no_hp = $this->input->post('no_hp', TRUE);
        $alamat = $this->input->post('alamat', TRUE);
        $metode = $this->input->post('metode_pembayaran', TRUE);
        $catatan = $this->input->post('catatan', TRUE);
        $tanggal_kirim = $this->input->post('tanggal_kirim', TRUE);
        $jumlah_box = (int)$this->input->post('jumlah_box', TRUE);

        if (empty($nama_penerima)) {
            $this->session->set_flashdata('error', 'Nama penerima harus diisi');
            redirect('catering_checkout');
        }
        if (empty($no_hp)) {
            $this->session->set_flashdata('error', 'No. HP harus diisi');
            redirect('catering_checkout');
        }
        if (empty($alamat)) {
            $this->session->set_flashdata('error', 'Alamat pengiriman harus diisi');
            redirect('catering_checkout');
        }
        if (empty($metode)) {
            $this->session->set_flashdata('error', 'Metode pembayaran harus dipilih');
            redirect('catering_checkout');
        }
        if (empty($tanggal_kirim)) {
            $this->session->set_flashdata('error', 'Tanggal kirim harus diisi');
            redirect('catering_checkout');
        }
        if (empty($jumlah_box) || $jumlah_box < 25) {
            $this->session->set_flashdata('error', 'Jumlah box minimal 25');
            redirect('catering_checkout');
        }

        // Validasi bukti pembayaran untuk Transfer / QRIS (bukan COD)
        $is_paid_method = in_array(strtolower($metode), ['transfer bank', 'qris', 'e-wallet']);
        $bukti_pembayaran = null;
        
        if ($is_paid_method) {
            if (empty($_FILES['bukti_pembayaran']['name'])) {
                $this->session->set_flashdata('error', 'Bukti pembayaran wajib dilampirkan untuk metode Transfer/QRIS.');
                redirect('catering_checkout');
            }
            // Upload
            $config['upload_path'] = FCPATH . 'assets/upload/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size'] = 2048;
            $config['file_name'] = 'bukti_' . time() . '_' . rand(100,999);
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, true);
            }
            $this->upload->initialize($config);
            if ($this->upload->do_upload('bukti_pembayaran')) {
                $bukti_pembayaran = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', 'Upload bukti pembayaran gagal: ' . $this->upload->display_errors('', ''));
                redirect('catering_checkout');
            }
        } else {
            // COD - upload opsional
            if (!empty($_FILES['bukti_pembayaran']['name'])) {
                $config['upload_path'] = FCPATH . 'assets/upload/';
                $config['allowed_types'] = 'jpg|jpeg|png|webp';
                $config['max_size'] = 2048;
                $config['file_name'] = 'bukti_' . time() . '_' . rand(100,999);
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, true);
                }
                $this->upload->initialize($config);
                if ($this->upload->do_upload('bukti_pembayaran')) {
                    $bukti_pembayaran = $this->upload->data('file_name');
                }
            }
        }

        $harga_per_box = (float)$catering_order['harga_per_box'];
        $total_harga = $harga_per_box * $jumlah_box;

        $kode_pesanan = $this->pesanan_model->generate_kode_pesanan();

        $detail_kustom = json_encode([
            'paket_id' => $catering_order['paket_id'],
            'nama_paket' => $catering_order['nama_paket'],
            'harga_paket' => $catering_order['harga_paket'],
            'total_tambahan' => $catering_order['total_tambahan'],
            'harga_per_box' => $harga_per_box,
            'jumlah_box' => $jumlah_box,
            'total_harga' => $total_harga,
            'items_terpilih' => $catering_order['items']
        ], JSON_UNESCAPED_UNICODE);

        $pesanan = [
            'id_user' => $id_user,
            'kode_pesanan' => $kode_pesanan,
            'nama_penerima' => $nama_penerima,
            'no_hp_penerima' => $no_hp,
            'alamat_pengiriman' => $alamat,
            'total_harga' => $total_harga,
            'status' => 'pending',
            'metode_pembayaran' => $metode,
            'bukti_pembayaran' => $bukti_pembayaran,
            'catatan' => $catatan,
            'tanggal_kirim' => $tanggal_kirim,
            'detail_kustom' => $detail_kustom
        ];

        $id_pesanan = $this->pesanan_model->insert($pesanan);

        // Hapus session catering
        $this->session->unset_userdata('catering_order');

        // Buat pesan WhatsApp — format dinamis sesuai requirement
        $nama_label = $catering_order['nama_paket'];
        $metode_label = strtoupper(str_replace('_', ' ', $metode));

        $pesan = "Halo NINGNONG Kue Basah,%0A%0A";
        $pesan .= "Saya ingin konfirmasi pesanan *" . $nama_label . "* dengan kode: *" . $kode_pesanan . "*%0A%0A";
        $pesan .= "*Detail:*%0A";

        // Isi Paket — list semua item yang dipilih customer (actual pilihan, bukan default)
        $pesan .= "  • Paket: " . $catering_order['nama_paket'] . "%0A";
        $pesan .= "  • Isi Menu:%0A";
        $items_detail = $catering_order['items'];
        foreach ($items_detail as $item) {
            $harga_item = (int)$item['harga'];
            $pesan .= "    - " . $item['nama_item'] . ($harga_item > 0 ? " (+Rp " . number_format($harga_item, 0, ',', '.') . ")" : "") . "%0A";
        }
        $pesan .= "  • Jumlah Box: " . $jumlah_box . "%0A%0A";
        $pesan .= "*Metode Pembayaran: " . $metode_label . "*%0A";
        $pesan .= "*Total Pembayaran: Rp " . number_format($total_harga, 0, ',', '.') . "*%0A";
        if ($metode === 'COD') {
            $pesan .= "Status Pembayaran: Bayar di Tempat%0A";
        }
        $pesan .= "Tanggal Kirim: " . date('d/m/Y', strtotime($tanggal_kirim)) . "%0A%0A";
        $pesan .= "*Data Pengiriman:*%0A";
        $pesan .= "Nama: " . $nama_penerima . "%0A";
        $pesan .= "No HP: " . $no_hp . "%0A";
        $pesan .= "Alamat: " . $alamat . "%0A";
        $pesan .= "%0ATerima kasih!";

        $this->session->set_flashdata('success', 'Pesanan catering berhasil dibuat! Mengarahkan ke WhatsApp penjual...');
        redirect('https://wa.me/' . NOMOR_WA_PENJUAL . '?text=' . $pesan);
    }
}