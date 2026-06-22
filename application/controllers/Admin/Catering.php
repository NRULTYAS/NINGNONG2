<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catering extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->cek_admin();
        $this->load->model('paket_catering_model');
    }

    private function cek_admin() {
        if (!$this->session->userdata('id_user') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['paket'] = $this->paket_catering_model->get_all();
        $this->load->view('admin/catering_list', $data);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama_paket', 'Nama Paket', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('isi_paket', 'Isi Paket', 'required');
        $this->form_validation->set_rules('porsi', 'Porsi', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/catering_tambah');
        } else {
            $foto = 'default.jpg';
            if (!empty($_FILES['foto']['name'])) {
                $config['upload_path'] = FCPATH . 'assets/upload/';
                $config['allowed_types'] = 'jpg|jpeg|png|webp';
                $config['max_size'] = 2048;
                $config['file_name'] = 'catering_' . time() . '_' . $_FILES['foto']['name'];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    $foto = $this->upload->data('file_name');
                }
            }

            $data = [
                'nama_paket' => $this->input->post('nama_paket', TRUE),
                'harga' => $this->input->post('harga', TRUE),
                'isi_paket' => $this->input->post('isi_paket', TRUE),
                'porsi' => $this->input->post('porsi', TRUE),
                'status' => $this->input->post('status', TRUE),
                'foto' => $foto
            ];

            $this->paket_catering_model->insert($data);
            $this->session->set_flashdata('success', 'Paket catering berhasil ditambahkan');
            redirect('admin/catering');
        }
    }

    public function edit($id)
    {
        $data['paket'] = $this->paket_catering_model->get_by_id($id);
        if (!$data['paket']) show_404();

        $this->form_validation->set_rules('nama_paket', 'Nama Paket', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('isi_paket', 'Isi Paket', 'required');
        $this->form_validation->set_rules('porsi', 'Porsi', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/catering_edit', $data);
        } else {
            $update = [
                'nama_paket' => $this->input->post('nama_paket', TRUE),
                'harga' => $this->input->post('harga', TRUE),
                'isi_paket' => $this->input->post('isi_paket', TRUE),
                'porsi' => $this->input->post('porsi', TRUE),
                'status' => $this->input->post('status', TRUE)
            ];

            if (!empty($_FILES['foto']['name'])) {
                $config['upload_path'] = FCPATH . 'assets/upload/';
                $config['allowed_types'] = 'jpg|jpeg|png|webp';
                $config['max_size'] = 2048;
                $config['file_name'] = 'catering_' . time() . '_' . $_FILES['foto']['name'];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    $old_foto = $data['paket']->foto;
                    if ($old_foto && $old_foto != 'default.jpg' && file_exists(FCPATH . 'assets/upload/' . $old_foto)) {
                        unlink(FCPATH . 'assets/upload/' . $old_foto);
                    }
                    $update['foto'] = $this->upload->data('file_name');
                }
            }

            $this->paket_catering_model->update($id, $update);
            $this->session->set_flashdata('success', 'Paket catering berhasil diupdate');
            redirect('admin/catering');
        }
    }

    public function hapus($id)
    {
        $paket = $this->paket_catering_model->get_by_id($id);
        if ($paket && $paket->foto && $paket->foto != 'default.jpg' && file_exists(FCPATH . 'assets/upload/' . $paket->foto)) {
            unlink(FCPATH . 'assets/upload/' . $paket->foto);
        }
        $this->paket_catering_model->delete($id);
        $this->session->set_flashdata('success', 'Paket catering berhasil dihapus');
        redirect('admin/catering');
    }
}