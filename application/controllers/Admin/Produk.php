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

    public function index($page = 1)
    {
        $per_page = 10;
        $page = (int)$page;
        if ($page < 1) $page = 1;

        $offset = ($page - 1) * $per_page;

        $total_rows = $this->produk_model->count_all();
        $data['produk'] = $this->produk_model->get_all($per_page, $offset);

        $config = [
            'base_url' => base_url('admin/produk'),
            'total_rows' => $total_rows,
            'per_page' => $per_page,
            'uri_segment' => 3,
            'page_query_string' => FALSE,
            'use_page_numbers' => TRUE,
        ];

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $page;
        $data['per_page'] = $per_page;
        $data['offset'] = $offset;

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
                $config['max_size'] = 10240;
                $config['max_width'] = 4000;
                $config['max_height'] = 4000;
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

        // Capture page parameter to preserve pagination
        $data['page'] = $this->input->get('page') ? (int)$this->input->get('page') : 1;

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
                $config['max_size'] = 10240;
                $config['max_width'] = 4000;
                $config['max_height'] = 4000;
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

            // Redirect back to the page the user came from
            $page = $this->input->post('page') ? (int)$this->input->post('page') : 1;
            if ($page > 1) {
                redirect('admin/produk/' . $page);
            } else {
                redirect('admin/produk');
            }
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

