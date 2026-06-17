<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {

    public function index()
    {
        $this->load->view('admin/pesanan_list');
    }
}