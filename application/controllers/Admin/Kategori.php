<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->cek_admin();
        $this->load->model('kategori_model');
    }

    private function cek_admin() {
        if (!$this->session->userdata('id_user') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['kategori'] = $this->kategori_model->get_all();
        $this->load->view('admin/kategori_list', $data);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|is_unique[tbl_kategori.nama_kategori]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/kategori_tambah');
        } else {
            $data = [
                'nama_kategori' => $this->input->post('nama_kategori', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE),
                'status' => $this->input->post('status', TRUE)
            ];
            $this->kategori_model->insert($data);
            $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan');
            redirect('admin/kategori');
        }
    }

    public function edit($id)
    {
        $data['kategori'] = $this->kategori_model->get_by_id($id);
        if (!$data['kategori']) show_404();

        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/kategori_edit', $data);
        } else {
            // Cek duplikat nama (kecuali dirinya sendiri)
            $nama = $this->input->post('nama_kategori', TRUE);
            $existing = $this->kategori_model->get_by_nama($nama);
            if ($existing && $existing->id_kategori != $id) {
                $this->session->set_flashdata('error', 'Nama kategori sudah digunakan');
                redirect('admin/kategori/edit/'.$id);
            }

            $update = [
                'nama_kategori' => $this->input->post('nama_kategori', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE),
                'status' => $this->input->post('status', TRUE)
            ];
            $this->kategori_model->update($id, $update);
            $this->session->set_flashdata('success', 'Kategori berhasil diupdate');
            redirect('admin/kategori');
        }
    }

    public function hapus($id)
    {
        $this->kategori_model->delete($id);
        $this->session->set_flashdata('success', 'Kategori berhasil dihapus');
        redirect('admin/kategori');
    }
}
