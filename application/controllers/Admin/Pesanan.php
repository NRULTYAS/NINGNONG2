<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->cek_admin();
        $this->load->model('pesanan_model');
    }

    private function cek_admin() {
        if (!$this->session->userdata('id_user') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['pesanan'] = $this->pesanan_model->get_all();
        $this->load->view('admin/pesanan_list', $data);
    }

    public function detail($id)
    {
        $data['pesanan'] = $this->pesanan_model->get_by_id($id);
        if (!$data['pesanan']) show_404();
        $data['detail'] = $this->pesanan_model->get_detail($id);
        $this->load->view('admin/pesanan_list', $data);
    }

    public function update_status($id)
    {
        $status = $this->input->post('status', TRUE);
        $this->pesanan_model->update_status($id, $status);
        $this->session->set_flashdata('success', 'Status pesanan diupdate');
        redirect('admin/pesanan');
    }
}
