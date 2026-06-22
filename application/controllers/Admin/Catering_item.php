<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catering_item extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->cek_admin();
        $this->load->model('paket_catering_model');
        $this->load->model('item_paket_model');
    }

    private function cek_admin() {
        if (!$this->session->userdata('id_user') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }
    }

    public function index($paket_id)
    {
        $paket = $this->paket_catering_model->get_by_id($paket_id);
        if (!$paket) show_404();

        $data['paket'] = $paket;
        $data['items'] = $this->item_paket_model->get_by_paket($paket_id);
        $data['kategori_list'] = $this->item_paket_model->get_kategori_by_paket($paket_id);
        $this->load->view('admin/catering_item_list', $data);
    }

    public function tambah($paket_id)
    {
        $paket = $this->paket_catering_model->get_by_id($paket_id);
        if (!$paket) show_404();

        $data['paket'] = $paket;

        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('nama_item', 'Nama Item', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/catering_item_tambah', $data);
        } else {
            $insert = [
                'paket_id' => $paket_id,
                'kategori' => $this->input->post('kategori', TRUE),
                'nama_item' => $this->input->post('nama_item', TRUE),
                'harga' => $this->input->post('harga', TRUE),
                'is_default' => 0
            ];

            $this->item_paket_model->insert($insert);
            $this->session->set_flashdata('success', 'Item berhasil ditambahkan');
            redirect('admin/catering/item/' . $paket_id);
        }
    }

    public function edit($id)
    {
        $item = $this->item_paket_model->get_by_id($id);
        if (!$item) show_404();

        $data['item'] = $item;

        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('nama_item', 'Nama Item', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/catering_item_edit', $data);
        } else {
            $update = [
                'kategori' => $this->input->post('kategori', TRUE),
                'nama_item' => $this->input->post('nama_item', TRUE),
                'harga' => $this->input->post('harga', TRUE)
            ];

            $this->item_paket_model->update($id, $update);
            $this->session->set_flashdata('success', 'Item berhasil diupdate');
            redirect('admin/catering/item/' . $item->paket_id);
        }
    }

    public function hapus($id)
    {
        $item = $this->item_paket_model->get_by_id($id);
        if (!$item) show_404();

        $paket_id = $item->paket_id;
        $this->item_paket_model->delete($id);
        $this->session->set_flashdata('success', 'Item berhasil dihapus');
        redirect('admin/catering/item/' . $paket_id);
    }

    public function set_default($paket_id, $item_id)
    {
        $item = $this->item_paket_model->get_by_id($item_id);
        if (!$item || $item->paket_id != $paket_id) show_404();

        // Unset default untuk kategori ini
        $this->item_paket_model->unset_defaults($paket_id, $item->kategori);

        // Set item ini sebagai default
        $this->item_paket_model->update($item_id, ['is_default' => 1]);

        $this->session->set_flashdata('success', 'Item default berhasil diubah');
        redirect('admin/catering/item/' . $paket_id);
    }
}