<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->cek_admin();
        $this->load->model('produk_model');
        $this->load->model('kategori_model');
    }

    private function cek_admin() {
        if (!$this->session->userdata('id_user') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['produk'] = $this->produk_model->get_all();
        $this->load->view('admin/produk_list', $data);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('rasa', 'Rasa', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['kategori'] = $this->kategori_model->get_all();
            $this->load->view('admin/produk_tambah', $data);
        } else {
            $gambar = 'default.jpg';
            if (!empty($_FILES['gambar']['name'])) {
                $config['upload_path'] = FCPATH . 'assets/upload/';
                $config['allowed_types'] = 'jpg|jpeg|png|webp';
                $config['max_size'] = 2048;
                $config['file_name'] = time() . '_' . $_FILES['gambar']['name'];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar')) {
                    $gambar = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', 'Gagal upload gambar: ' . $this->upload->display_errors('', ''));
                }
            }

            $data = [
                'nama_produk' => $this->input->post('nama_produk', TRUE),
                'id_kategori' => $this->input->post('id_kategori', TRUE),
                'rasa' => $this->input->post('rasa', TRUE),
                'harga' => $this->input->post('harga', TRUE),
                'stok' => $this->input->post('stok', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE),
                'gambar' => $gambar
            ];

            $this->produk_model->insert($data);
            $this->session->set_flashdata('success', 'Produk berhasil ditambahkan');
            redirect('admin/produk');
        }
    }

    public function edit($id)
    {
        $data['produk'] = $this->produk_model->get_by_id($id);
        if (!$data['produk']) show_404();

        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('rasa', 'Rasa', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['kategori'] = $this->kategori_model->get_all();
            $this->load->view('admin/produk_edit', $data);
        } else {
            $update = [
                'nama_produk' => $this->input->post('nama_produk', TRUE),
                'id_kategori' => $this->input->post('id_kategori', TRUE),
                'rasa' => $this->input->post('rasa', TRUE),
                'harga' => $this->input->post('harga', TRUE),
                'stok' => $this->input->post('stok', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE)
            ];

            if (!empty($_FILES['gambar']['name'])) {
                $config['upload_path'] = FCPATH . 'assets/upload/';
                $config['allowed_types'] = 'jpg|jpeg|png|webp';
                $config['max_size'] = 2048;
                $config['file_name'] = time() . '_' . $_FILES['gambar']['name'];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar')) {
                    $old_gambar = $data['produk']->gambar;
                    if ($old_gambar && $old_gambar != 'default.jpg' && file_exists(FCPATH . 'assets/upload/' . $old_gambar)) {
                        unlink(FCPATH . 'assets/upload/' . $old_gambar);
                    }
                    $update['gambar'] = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', 'Gagal upload gambar: ' . $this->upload->display_errors('', ''));
                }
            }

            $this->produk_model->update($id, $update);
            $this->session->set_flashdata('success', 'Produk berhasil diupdate');
            redirect('admin/produk');
        }
    }

    public function hapus($id)
    {
        $produk = $this->produk_model->get_by_id($id);
        if ($produk && $produk->gambar && $produk->gambar != 'default.jpg' && file_exists(FCPATH . 'assets/upload/' . $produk->gambar)) {
            unlink(FCPATH . 'assets/upload/' . $produk->gambar);
        }
        $this->produk_model->delete($id);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus');
        redirect('admin/produk');
    }
}
