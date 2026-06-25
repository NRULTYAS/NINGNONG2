<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout_umum extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu');
            redirect('auth/login');
        }
        $this->load->model('pesanan_model');
        $this->load->model('user_model');
        $this->load->model('produk_model');
        $this->load->helper(['url', 'form']);
        $this->load->library('upload');
    }

    public function index()
    {
        $order = $this->session->userdata('selected_order');

        // Jika belum ada di session, cek parameter GET (untukNyiru)
        if (!$order && $this->input->get('type') === 'nyiru') {
            $id_produk = (int)$this->input->get('id_produk');
            $jumlah = (int)$this->input->get('jumlah');
            $produk = $this->produk_model->get_by_id($id_produk);
            if ($produk) {
                $order = [
                    'type' => 'nyiru',
                    'id_produk' => $produk->id_produk,
                    'nama_produk' => $produk->nama_produk,
                    'harga' => (int)$produk->harga,
                    'jumlah' => $jumlah
                ];
                $this->session->set_userdata('selected_order', $order);
            }
        }

        if (!$order || !isset($order['type'])) {
            $this->session->set_flashdata('error', 'Silakan pilih produk terlebih dahulu');
            redirect('produk');
        }

        $data['order'] = $order;
        $data['user'] = $this->user_model->get_by_id($this->session->userdata('id_user'));
        $this->load->view('pelanggan/checkout_umum', $data);
    }

    public function proses()
    {
        $order = $this->session->userdata('selected_order');
        if (!$order || !isset($order['type'])) {
            $this->session->set_flashdata('error', 'Silakan pilih produk terlebih dahulu');
            redirect('produk');
        }

        $nama_penerima = $this->input->post('nama_penerima', TRUE);
        $no_hp = $this->input->post('no_hp', TRUE);
        $alamat = $this->input->post('alamat', TRUE);
        $catatan = $this->input->post('catatan', TRUE);
        $tanggal_kirim = $this->input->post('tanggal_kirim', TRUE);
        $metode_pembayaran = $this->input->post('metode_pembayaran', TRUE);
        $jumlah = (int)$this->input->post('jumlah', TRUE);

        if (empty($nama_penerima) || empty($no_hp) || empty($alamat) || empty($tanggal_kirim) || empty($metode_pembayaran)) {
            $this->session->set_flashdata('error', 'Semua field wajib diisi');
            redirect('checkout_umum');
        }

        if ($jumlah < 1) {
            $this->session->set_flashdata('error', 'Jumlah minimal 1');
            redirect('checkout_umum');
        }

        if ($order['type'] === 'catering' && $jumlah < 25) {
            $this->session->set_flashdata('error', 'Minimal pemesanan catering adalah 25 box');
            redirect('checkout_umum');
        }

        if ($order['type'] === 'snack_box' && $jumlah < 15) {
            $this->session->set_flashdata('error', 'Minimal pemesanan adalah 15 dus');
            redirect('checkout_umum');
        }

        // Hitung total berdasarkan tipe pesanan
        $total_harga = 0;
        $nama_produk = '';
        $detail_text = '';
        $id_produk = null;

        switch ($order['type']) {
            case 'pesan_satuan':
                $id_produk = (int)$order['id_produk'];
                $produk = $this->produk_model->get_by_id($id_produk);
                if (!$produk) {
                    $this->session->set_flashdata('error', 'Produk tidak ditemukan');
                    redirect('produk');
                }
                $total_harga = (int)$produk->harga * $jumlah;
                $nama_produk = $produk->nama_produk;
                $detail_text = $produk->nama_produk . ' (x' . $jumlah . ')';
                break;

            case 'snack_box':
                $harga_per_dus = 0;
                foreach ($order['items'] as $item) {
                    $p = $this->produk_model->get_by_id($item['id_produk']);
                    $harga_per_dus += ($p ? (int)$p->harga : 0) * $item['quantity'];
                }
                $total_harga = $harga_per_dus * $jumlah;
                $nama_produk = 'Snack Box';
                $detail_text = count($order['items']) . ' produk dalam box';
                break;

            case 'catering':
                $harga_per_box = (float)$order['harga_per_box'];
                $total_harga = $harga_per_box * $jumlah;
                $nama_produk = $order['nama_paket'];
                $detail_text = count($order['items']) . ' item kustom';
                break;

            case 'nyiru':
                $id_produk = (int)$order['id_produk'];
                $produk = $this->produk_model->get_by_id($id_produk);
                if (!$produk) {
                    $this->session->set_flashdata('error', 'Produk tidak ditemukan');
                    redirect('produk');
                }
                $total_harga = (int)$produk->harga * $jumlah;
                $nama_produk = 'Nyiru / Tampah';
                $detail_text = $produk->nama_produk . ' (x' . $jumlah . ')';
                break;

            default:
                $this->session->set_flashdata('error', 'Tipe pesanan tidak dikenali');
                redirect('produk');
        }

        $kode_pesanan = $this->pesanan_model->generate_kode_pesanan();

        // Upload bukti pembayaran (opsional)
        $bukti_pembayaran = null;
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

        $pesanan = [
            'id_user' => $this->session->userdata('id_user'),
            'jenis_pesanan' => $order['type'],
            'kode_pesanan' => $kode_pesanan,
            'nama_penerima' => $nama_penerima,
            'no_hp_penerima' => $no_hp,
            'alamat_pengiriman' => $alamat,
            'total_harga' => $total_harga,
            'status' => 'pending',
            'status_pembayaran' => 'Menunggu Konfirmasi',
            'metode_pembayaran' => $metode_pembayaran,
            'bukti_pembayaran' => $bukti_pembayaran,
            'catatan' => $catatan,
            'tanggal_kirim' => $tanggal_kirim,
            'detail_kustom' => json_encode($order)
        ];

        $id_pesanan = $this->pesanan_model->insert($pesanan);

        // Kurangi stok jika ada id_produk
        if ($id_produk && isset($produk)) {
            $this->produk_model->update($id_produk, [
                'stok' => $produk->stok - $jumlah
            ]);
        }

        // Kurangi stok untuk snack_box
        if ($order['type'] === 'snack_box') {
            foreach ($order['items'] as $item) {
                $p = $this->produk_model->get_by_id($item['id_produk']);
                if ($p) {
                    $this->produk_model->update($item['id_produk'], [
                        'stok' => $p->stok - $item['quantity']
                    ]);
                }
            }
        }

        // Build pesan WhatsApp
        $kode_pesanan = $this->pesanan_model->generate_kode_pesanan();
        $nama_label = str_replace(['_', '-'], ' ', $order['type']);
        $nama_label = ucwords($nama_label);

        $pesan = "Halo NINGNONG Kue Basah,%0A%0A";
        $pesan .= "Saya ingin konfirmasi pesanan *" . $nama_label . "* dengan kode: *" . $kode_pesanan . "*%0A%0A";
        $pesan .= "*Detail:*%0A";

        switch ($order['type']) {
            case 'pesan_satuan':
                $pesan .= "  • Produk: " . $produk->nama_produk . "%0A";
                $pesan .= "  • Jumlah: " . $jumlah . "%0A";
                break;
            case 'snack_box':
                $pesan .= "  • Isi Box:%0A";
                foreach ($order['items'] as $item) {
                    $pesan .= "    - " . $item['nama_produk'] . " x" . $item['quantity'] . "%0A";
                }
                $pesan .= "  • Total Dus: " . $jumlah . "%0A";
                break;
            case 'catering':
                $pesan .= "  • Paket: " . $order['nama_paket'] . "%0A";
                $pesan .= "  • Jumlah Box: " . $jumlah . "%0A";
                break;
            case 'nyiru':
                $pesan .= "  • Ukuran: " . $produk->nama_produk . "%0A";
                $pesan .= "  • Jumlah: " . $jumlah . "%0A";
                break;
        }

        $pesan .= "%0A*Metode Pembayaran: " . strtoupper(str_replace('_', ' ', $metode_pembayaran)) . "*%0A";
        $pesan .= "*Total Pembayaran: Rp " . number_format($total_harga, 0, ',', '.') . "*%0A";
        $pesan .= "Tanggal Kirim: " . date('d/m/Y', strtotime($tanggal_kirim)) . "%0A%0A";
        $pesan .= "*Data Pengiriman:*%0A";
        $pesan .= "Nama: " . $nama_penerima . "%0A";
        $pesan .= "No HP: " . $no_hp . "%0A";
        $pesan .= "Alamat: " . $alamat . "%0A";
        $pesan .= "%0ATerima kasih!";

        // Hapus session pesanan
        $this->session->unset_userdata('selected_order');

        redirect('https://wa.me/' . NOMOR_WA_PENJUAL . '?text=' . $pesan);
    }
}
