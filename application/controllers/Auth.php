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
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');

        $error_message = '';

        if ($this->form_validation->run() == FALSE) {
            // Tampilkan pesan error yang jelas dalam Bahasa Indonesia (tanpa pesan framework bawaan)
            $errors = $this->form_validation->error_array();

            if (!empty($errors['email'])) {
                if (strpos(strtolower($errors['email']), 'is_unique') !== false) {
                    $error_message = 'Email sudah terdaftar. Silakan gunakan email lain.';
                } else {
                    $error_message = 'Email tidak valid. Silakan periksa kembali.';
                }
            } elseif (!empty($errors['nama'])) {
                $error_message = 'Nama Lengkap wajib diisi.';
            } elseif (!empty($errors['no_hp'])) {
                $error_message = 'No HP wajib diisi.';
            } elseif (!empty($errors['password'])) {
                $error_message = 'Password wajib diisi minimal 6 karakter.';
            } else {
                $error_message = 'Registrasi gagal. Silakan periksa data Anda.';
            }

            $this->load->view('auth/register', ['error_message' => $error_message]);
            return;
        }

        $data = [
            'nama' => $this->input->post('nama', TRUE),
            'email' => $this->input->post('email', TRUE),
            'password' => $this->input->post('password', TRUE),
            'no_hp' => $this->input->post('no_hp', TRUE),
        ];

        $insert_id = $this->auth_model->register($data);

        // Login otomatis setelah registrasi
        $user = $this->auth_model->get_by_email($data['email']);
        if ($user) {
            $session = [
                'id_user' => $user->id_user,
                'nama' => $user->nama,
                'email' => $user->email,
                'role' => $user->role
            ];
            $this->session->set_userdata($session);
            redirect('home');
        }

        // fallback jika user tidak ditemukan setelah insert
        $this->session->set_flashdata('error', 'Registrasi gagal. Silakan coba lagi.');
        redirect('auth/register');
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