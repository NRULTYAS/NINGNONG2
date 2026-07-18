<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Box_checkout extends CI_Controller {

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
        $this->load->model('produk_model');
        $this->load->model('pesanan_model');
        $this->load->library('upload');
    }

    public function index()
    {
        $state = $this->session->userdata('snack_box_state');
        if (!is_array($state) || empty($state['active_box_items'])) {
            $this->session->set_flashdata('error', 'Tidak ada produk dalam box');
            redirect('pesanan/snack_box_builder');
        }

        $items = [];
        $total_box = 0;
        $productIds = array_keys($state['active_box_items']);
        $productRows = [];
        $all = $this->produk_model->get_all();
        foreach ($all as $row) {
            $pid = (int)$row->id_produk;
            if (in_array($pid, $productIds, true)) {
                $productRows[$pid] = $row;
            }
        }

        $activeItems = [];
        foreach ($state['active_box_items'] as $pid => $quantity) {
            $pid = (int)$pid;
            $quantity = (int)$quantity;
            $price = 0;
            $nama = '';
            if (isset($productRows[$pid])) {
                $price = (int)($productRows[$pid]->harga ?? 0);
                $nama = $productRows[$pid]->nama_produk ?? '';
            }
            $subtotal = $price * $quantity;
            $activeItems[] = [
                'id_produk' => $pid,
                'nama_produk' => $nama,
                'harga' => $price,
                'quantity' => $quantity,
                'subtotal' => $subtotal
            ];
            $total_box += $subtotal;
        }

        // Hapus session dari pesanan sebelumnya agar tidak tercampur
        $this->session->unset_userdata('order_referrer');
        $this->session->unset_userdata('last_order_success');

        $this->session->set_userdata('selected_order', [
            'type' => 'snack_box',
            'items' => $activeItems,
            'jumlah_dus' => 15,
            'harga_per_dus' => $total_box
        ]);

        redirect('checkout_umum');
    }

    public function proses()
    {
        // Validasi form
        $this->form_validation->set_rules('nama_penerima', 'Nama Penerima', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomor Telepon', 'required|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'required');
        $this->form_validation->set_rules('tanggal_kirim', 'Tanggal Pengiriman', 'required');

        $jumlah_dus = (int)$this->input->post('jumlah_dus', TRUE);
        if ($jumlah_dus < 15) {
            $this->session->set_flashdata('error', 'Minimal pemesanan adalah 15 dus');
            redirect('box_checkout');
        }

        if ($this->form_validation->run() == FALSE) {
            // Kembali ke form checkout dengan error
            $state = $this->session->userdata('snack_box_state');
            $items = [];
            $total_box = 0;
            $productIds = [];
            if (!empty($state['active_box_items'])) {
                $productIds = array_keys($state['active_box_items']);
            }
            $productRows = [];
            $all = $this->produk_model->get_all();
            foreach ($all as $row) {
                $pid = (int)$row->id_produk;
                if (in_array($pid, $productIds, true)) {
                    $productRows[$pid] = $row;
                }
            }
            foreach ($state['active_box_items'] as $pid => $quantity) {
                $pid = (int)$pid;
                $quantity = (int)$quantity;
                $price = 0;
                $nama = '';
                $gambar = '';
                if (isset($productRows[$pid])) {
                    $price = (int)($productRows[$pid]->harga ?? 0);
                    $nama = $productRows[$pid]->nama_produk ?? '';
                    $gambar = $productRows[$pid]->gambar ?? '';
                }
                $subtotal = $price * $quantity;
                $items[] = [
                    'id_produk' => $pid,
                    'nama_produk' => $nama,
                    'gambar' => $gambar,
                    'harga' => $price,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal
                ];
                $total_box += $subtotal;
            }
            $data['items'] = $items;
            $data['total_box'] = $total_box;
            $data['harga_per_dus'] = $total_box;
            $data['kode_pesanan'] = $this->pesanan_model->generate_kode_pesanan();
            $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row();
            $this->load->view('pelanggan/box_checkout', $data);
            return;
        }

        $id_user = $this->session->userdata('id_user');
        $state = $this->session->userdata('snack_box_state');

        if (!is_array($state) || empty($state['active_box_items'])) {
            $this->session->set_flashdata('error', 'Tidak ada produk dalam box');
            redirect('pesanan/snack_box_builder');
        }

        // Ambil metode pembayaran
        $metode = $this->input->post('metode_pembayaran', TRUE);
        if (empty($metode)) {
            $this->session->set_flashdata('error', 'Metode pembayaran harus dipilih');
            redirect('box_checkout');
        }

        // Hitung total
        $productIds = array_keys($state['active_box_items']);
        $productRows = [];
        $all = $this->produk_model->get_all();
        foreach ($all as $row) {
            $pid = (int)$row->id_produk;
            if (in_array($pid, $productIds, true)) {
                $productRows[$pid] = $row;
            }
        }

        $total_box = 0;
        $detail_items = [];
        foreach ($state['active_box_items'] as $pid => $quantity) {
            $pid = (int)$pid;
            $quantity = (int)$quantity;
            $price = 0;
            if (isset($productRows[$pid])) {
                $price = (int)($productRows[$pid]->harga ?? 0);
            }
            $subtotal = $price * $quantity;
            $detail_items[] = [
                'id_produk' => $pid,
                'nama_produk' => $productRows[$pid]->nama_produk ?? '',
                'harga' => $price,
                'quantity' => $quantity,
                'subtotal' => $subtotal
            ];
            $total_box += $subtotal;
        }

        $harga_per_dus = (int)$total_box;
        $jumlah_dus = (int)$this->input->post('jumlah_dus', TRUE);
        if ($jumlah_dus < 15) {
            $this->session->set_flashdata('error', 'Minimal pemesanan adalah 15 dus');
            redirect('box_checkout');
        }

        $total_harga = $harga_per_dus * $jumlah_dus;

        $nama_penerima = $this->input->post('nama_penerima', TRUE);
        $no_hp_penerima = $this->input->post('no_hp', TRUE);
        $alamat_pengiriman = $this->input->post('alamat', TRUE);
        $tanggal_kirim = $this->input->post('tanggal_kirim', TRUE);
        $catatan = $this->input->post('catatan', TRUE);

        // Validasi bukti pembayaran untuk Transfer / QRIS (bukan COD)
        $is_paid_method = in_array(strtolower($metode), ['transfer bank', 'qris', 'e-wallet']);
        $bukti_pembayaran = null;

        if ($is_paid_method) {
            if (empty($_FILES['bukti_pembayaran']['name'])) {
                $this->session->set_flashdata('error', 'Bukti pembayaran wajib dilampirkan untuk metode Transfer/QRIS.');
                redirect('box_checkout');
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
                redirect('box_checkout');
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

        $kode_pesanan = $this->pesanan_model->generate_kode_pesanan();

        // Simpan ke tabel pesanan
        $pesanan = [
            'id_user' => $id_user,
            'kode_pesanan' => $kode_pesanan,
            'nama_penerima' => $this->input->post('nama_penerima', TRUE),
            'no_hp_penerima' => $this->input->post('no_hp', TRUE),
            'alamat_pengiriman' => $this->input->post('alamat', TRUE),
            'total_harga' => $total_harga,
            'status' => 'pending',
            'metode_pembayaran' => $metode,
            'tanggal_kirim' => $this->input->post('tanggal_kirim', TRUE),
            'catatan' => $this->input->post('catatan', TRUE),
            'detail_box' => json_encode([
                'items' => $detail_items,
                'harga_per_dus' => $harga_per_dus,
                'jumlah_dus' => $jumlah_dus,
                'total_harga' => $total_harga
            ]),
            'bukti_pembayaran' => $bukti_pembayaran
        ];

        $id_pesanan = $this->pesanan_model->insert($pesanan);

        // Simpan detail pesanan (untuk relasi)
        foreach ($detail_items as $item) {
            $this->pesanan_model->insert_detail([
                'id_pesanan' => $id_pesanan,
                'id_produk' => $item['id_produk'],
                'jumlah' => $item['quantity'],
                'harga_satuan' => $item['harga'],
                'subtotal' => $item['subtotal']
            ]);

            // Kurangi stok
            if (isset($productRows[$item['id_produk']])) {
                $stok_baru = $productRows[$item['id_produk']]->stok - $item['quantity'];
                $this->produk_model->update($item['id_produk'], ['stok' => $stok_baru]);
            }
        }

        // Hapus state box
        $this->session->unset_userdata('snack_box_state');

        // Build pesan WhatsApp — format harus sesuai requirement
        $metode_label = strtoupper(str_replace('_', ' ', $metode));

        $pesan = "Halo NINGNONG Kue Basah,%0A%0A";
        $pesan .= "Saya ingin konfirmasi pesanan *Snack Box* dengan kode: *" . $kode_pesanan . "*%0A%0A";
        $pesan .= "*Detail:*%0A";
        $pesan .= "  • Isi Box:%0A";
        foreach ($detail_items as $item) {
            $pesan .= "    - " . $item['nama_produk'] . " x" . $item['quantity'] . "%0A";
        }
        $pesan .= "  • Total Dus: " . $jumlah_dus . "%0A%0A";
        $pesan .= "*Metode Pembayaran: TRANSFER BANK*%0A";
        $pesan .= "*Total Pembayaran: Rp " . number_format($total_harga, 0, ',', '.') . "*%0A";
        $pesan .= "Tanggal Kirim: " . date('d/m/Y', strtotime($tanggal_kirim)) . "%0A%0A";
        $pesan .= "*Data Pengiriman:*%0A";
        $pesan .= "Nama: " . $nama_penerima . "%0A";
        $pesan .= "No HP: " . $no_hp_penerima . "%0A";
        $pesan .= "Alamat: " . $alamat_pengiriman . "%0A";
        $pesan .= "%0ATerima kasih!";


        $this->session->set_flashdata('success', 'Pesanan Snack Box berhasil dibuat! Mengarahkan ke WhatsApp penjual...');
        // Saat user kembali dari WhatsApp, arahkan lagi ke halaman sukses (bukan box_checkout)
        redirect('https://wa.me/' . NOMOR_WA_PENJUAL . '?text=' . $pesan . '&app_absent=1&source=web');
    }

    public function sukses($id_pesanan)
    {
        $pesanan = $this->pesanan_model->get_by_id($id_pesanan);
        if (!$pesanan) show_404();

        $data['pesanan'] = $pesanan;
        $data['detail'] = json_decode($pesanan->detail_box, true);
        if (!$data['detail']) {
            $data['detail'] = $this->pesanan_model->get_detail($id_pesanan);
        }
        $this->load->view('pelanggan/box_checkout_sukses', $data);
    }
}