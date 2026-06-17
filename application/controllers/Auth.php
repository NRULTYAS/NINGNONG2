<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->model('user_model');
    }

    public function login()
    {
        $id_user = $this->session->userdata('id_user');
        $role = $this->session->userdata('role');
        if ($id_user && $role) {
            if ($role == 'admin') {
                redirect('admin/dashboard');
            } else {
                redirect('home');
            }
        }
        $this->load->view('auth/login');
    }

    public function register()
    {
        if ($this->session->userdata('id_user')) {
            redirect('home');
        }
        $this->load->view('auth/register');
    }

    public function proses_login()
    {
        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->auth_model->login($email, $password);

        if ($user) {
            $session = [
                'id_user' => $user->id_user,
                'nama' => $user->nama,
                'email' => $user->email,
                'role' => $user->role
            ];
            $this->session->set_userdata($session);

            if ($user->role == 'admin') {
                redirect('admin/dashboard');
            } else {
                redirect('home');
            }
        } else {
            $this->session->set_flashdata('error', 'Email atau password salah!');
            redirect('auth/login');
        }
    }

    public function proses_register()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required|matches[password]');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $data = [
                'nama' => $this->input->post('nama', TRUE),
                'email' => $this->input->post('email', TRUE),
                'password' => $this->input->post('password', TRUE),
                'no_hp' => $this->input->post('no_hp', TRUE),
                'alamat' => $this->input->post('alamat', TRUE)
            ];

            $this->auth_model->register($data);
            $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
            redirect('auth/login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(['id_user', 'nama', 'email', 'role']);
        $this->session->sess_destroy();
        if (isset($_COOKIE['ci_session'])) {
            setcookie('ci_session', '', time() - 3600, '/');
        }
        redirect('auth/login');
    }
}