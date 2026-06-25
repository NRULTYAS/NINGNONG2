<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang extends CI_Controller {

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
        $this->load->model('kategori_model');
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        $data['keranjang'] = $this->keranjang_model->get_by_user($id_user);
        $data['kategori'] = $this->kategori_model->get_all();
        $data['jumlah_keranjang'] = $this->keranjang_model->count_by_user($id_user);
        $this->load->view('pelanggan/keranjang', $data);
    }

    public function tambah()
    {
        $id_user = $this->session->userdata('id_user');
        $id_produk = $this->input->post('id_produk');
        $jumlah = (int) $this->input->post('jumlah', 1);

        $produk = $this->produk_model->get_by_id($id_produk);
        if (!$produk || $produk->stok < $jumlah) {
            $this->session->set_flashdata('error', 'Stok tidak mencukupi');
            redirect($_SERVER['HTTP_REFERER'] ?: 'produk');
        }

        $existing = $this->keranjang_model->get_by_user_produk($id_user, $id_produk);
        if ($existing) {
            $new_jumlah = $existing->jumlah + $jumlah;
            if ($new_jumlah > $produk->stok) {
                $this->session->set_flashdata('error', 'Stok tidak mencukupi');
                redirect($_SERVER['HTTP_REFERER'] ?: 'produk');
            }
            $this->keranjang_model->update($existing->id_keranjang, ['jumlah' => $new_jumlah]);
        } else {
            $this->keranjang_model->insert([
                'id_user' => $id_user,
                'id_produk' => $id_produk,
                'jumlah' => $jumlah
            ]);
        }

        $this->session->set_flashdata('success', 'Produk ditambahkan ke keranjang');
        redirect($_SERVER['HTTP_REFERER'] ?: 'produk');
    }

    public function update($id)
    {
        $jumlah = (int) $this->input->post('jumlah');
        if ($jumlah < 1) {
            $this->hapus($id);
            return;
        }
        $this->keranjang_model->update($id, ['jumlah' => $jumlah]);
        redirect('keranjang');
    }

    public function hapus($id)
    {
        $this->keranjang_model->delete($id);
        redirect('keranjang');
    }

    // ===================== AJAX =====================
    public function tambah_ajax()
    {
        if (!$this->session->userdata('id_user')) {
            echo json_encode(['ok' => false, 'msg' => 'Silakan login terlebih dahulu']);
            return;
        }
        if ($this->session->userdata('role') == 'admin') {
            echo json_encode(['ok' => false, 'msg' => 'Admin tidak dapat menambahkan produk']);
            return;
        }

        $id_user  = $this->session->userdata('id_user');
        $id_produk = $this->input->post('id_produk');
        $jumlah   = (int) $this->input->post('jumlah');

        if (!$id_produk || $jumlah < 1) {
            echo json_encode(['ok' => false, 'msg' => 'Data tidak valid']);
            return;
        }

        $produk = $this->produk_model->get_by_id($id_produk);
        if (!$produk || $produk->stok < $jumlah) {
            echo json_encode(['ok' => false, 'msg' => 'Stok tidak mencukupi']);
            return;
        }

        $existing = $this->keranjang_model->get_by_user_produk($id_user, $id_produk);
        if ($existing) {
            $new_jumlah = $existing->jumlah + $jumlah;
            if ($new_jumlah > $produk->stok) {
                echo json_encode(['ok' => false, 'msg' => 'Stok tidak mencukupi']);
                return;
            }
            $this->keranjang_model->update($existing->id_keranjang, ['jumlah' => $new_jumlah]);
        } else {
            $this->keranjang_model->insert([
                'id_user'   => $id_user,
                'id_produk' => $id_produk,
                'jumlah'    => $jumlah
            ]);
        }

        $total_item = $this->keranjang_model->count_by_user($id_user);
        echo json_encode([
            'ok'          => true,
            'msg'         => 'Berhasil ditambahkan ke keranjang',
            'total_item'  => $total_item
        ]);
    }
}
