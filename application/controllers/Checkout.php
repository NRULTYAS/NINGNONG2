<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

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
        $this->load->model('keranjang_model');
        $this->load->model('produk_model');
        $this->load->model('pesanan_model');
        $this->load->model('user_model');
        $this->load->model('kategori_model');
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        $data['keranjang'] = $this->keranjang_model->get_by_user($id_user);
        if (empty($data['keranjang'])) {
            redirect('keranjang');
        }
        $data['user'] = $this->user_model->get_by_id($id_user);
        $data['kategori'] = $this->kategori_model->get_all();
        $data['jumlah_keranjang'] = $this->keranjang_model->count_by_user($id_user);
        $this->load->view('pelanggan/checkout', $data);
    }

    public function proses()
    {
        $id_user = $this->session->userdata('id_user');
        $items = $this->keranjang_model->get_by_user($id_user);

        if (empty($items)) {
            redirect('keranjang');
        }

        $nama_penerima = $this->input->post('nama_penerima', TRUE);
        $no_hp = $this->input->post('no_hp', TRUE);
        $alamat = $this->input->post('alamat', TRUE);
        $metode = $this->input->post('metode_pembayaran', TRUE);
        $catatan = $this->input->post('catatan', TRUE);

        $total = 0;
        foreach ($items as $item) {
            $total += $item->harga * $item->jumlah;
        }

        $kode_pesanan = 'NN-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));

        $pesanan = [
            'id_user' => $id_user,
            'kode_pesanan' => $kode_pesanan,
            'nama_penerima' => $nama_penerima,
            'no_hp_penerima' => $no_hp,
            'alamat_pengiriman' => $alamat,
            'total_harga' => $total,
            'status' => 'pending',
            'metode_pembayaran' => $metode,
            'catatan' => $catatan
        ];

        $id_pesanan = $this->pesanan_model->insert($pesanan);

        foreach ($items as $item) {
            $this->pesanan_model->insert_detail([
                'id_pesanan' => $id_pesanan,
                'id_produk' => $item->id_produk,
                'jumlah' => $item->jumlah,
                'harga_satuan' => $item->harga,
                'subtotal' => $item->harga * $item->jumlah
            ]);

            // Kurangi stok
            $produk = $this->produk_model->get_by_id($item->id_produk);
            $this->produk_model->update($item->id_produk, [
                'stok' => $produk->stok - $item->jumlah
            ]);
        }

        $this->keranjang_model->delete_by_user($id_user);

        // Buat pesan WhatsApp
        $kode_pesanan = 'NN-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
        $pesan = "Halo NINGNONG Kue Basah,%0A%0A";
        $pesan .= "Saya ingin konfirmasi pesanan *Pesan Satuan* dengan kode: *" . $kode_pesanan . "*%0A%0A";
        $pesan .= "*Detail Pesanan:*%0A";
        $total_items = 0;
        foreach ($items as $item) {
            $pesan .= "  • {$item->nama_produk} x{$item->jumlah} = Rp " . number_format($item->harga * $item->jumlah, 0, ',', '.') . "%0A";
            $total_items += $item->jumlah;
        }
        $pesan .= "%0A*Harga per item: Rp " . number_format($total / max($total_items, 1), 0, ',', '.') . "*%0A";
        $pesan .= "*Jumlah: " . $total_items . " item*%0A";
        $pesan .= "*Total Pembayaran: Rp " . number_format($total, 0, ',', '.') . "*%0A";
        $pesan .= "Metode Pembayaran: " . ucfirst($metode) . "%0A";
        $pesan .= "Tanggal Kirim: " . date('d/m/Y', strtotime($this->input->post('tanggal_kirim', TRUE))) . "%0A%0A";
        $pesan .= "*Data Pengiriman:*%0A";
        $pesan .= "Nama: " . $nama_penerima . "%0A";
        $pesan .= "No HP: " . $no_hp . "%0A";
        $pesan .= "Alamat: " . $alamat . "%0A";
        $pesan .= "%0ATerima kasih!";

        $this->session->set_flashdata('success', 'Pesanan berhasil dibuat! Mengarahkan ke WhatsApp penjual...');
        redirect('https://wa.me/' . NOMOR_WA_PENJUAL . '?text=' . $pesan);
    }
}