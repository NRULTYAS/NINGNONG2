<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->model('user_model');

        $this->load->helper(['url', 'form']);
        $this->load->library(['form_validation', 'email', 'session']);
        $this->load->helper('date');
    }

    public function login() {
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

    public function register() {
        if ($this->session->userdata('id_user')) {
            redirect('home');
        }
        $this->load->view('auth/register');
    }

    public function proses_login() {
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

    public function proses_register() {
        // Bersihkan input dulu sebelum validasi (trim + cegah whitespace tersembunyi)
        $nama  = trim($this->input->post('nama', TRUE));
        $email = trim($this->input->post('email', TRUE));
        $no_hp = trim($this->input->post('no_hp', TRUE));
        $password = $this->input->post('password', TRUE);

        $this->form_validation->set_data([
            'nama'     => $nama,
            'email'    => $email,
            'no_hp'    => $no_hp,
            'password' => $password
        ]);

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');

        $error_message = '';

        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();

            // Prioritaskan deteksi error email dulu, dengan pesan yang lebih presisi
            if (!empty($errors['email'])) {
                $email_error = strtolower($errors['email']);
                if (strpos($email_error, 'is_unique') !== false) {
                    $error_message = 'Email sudah terdaftar. Silakan gunakan email lain.';
                } elseif (strpos($email_error, 'valid_email') !== false || strpos($email_error, 'tidak valid') !== false) {
                    $error_message = 'Format email tidak valid. Gunakan format yang benar (contoh: nama@email.com).';
                } else {
                    $error_message = 'Email: ' . $errors['email'];
                }
            } elseif (!empty($errors['password'])) {
                $error_message = 'Password wajib diisi minimal 6 karakter.';
            } elseif (!empty($errors['nama'])) {
                $error_message = 'Nama Lengkap wajib diisi.';
            } elseif (!empty($errors['no_hp'])) {
                $error_message = 'No HP wajib diisi.';
            } else {
                $error_message = 'Registrasi gagal. Silakan periksa data Anda.';
            }

            $this->load->view('auth/register', ['error_message' => $error_message]);
            return;
        }

        $data = [
            'nama'     => $nama,
            'email'    => $email,
            'password' => $password,
            'no_hp'    => $no_hp,
        ];

        $insert_id = $this->auth_model->register($data);

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

        $this->session->set_flashdata('error', 'Registrasi gagal. Silakan coba lagi.');
        redirect('auth/register');
    }

    public function logout() {
        $this->session->unset_userdata(['id_user', 'nama', 'email', 'role']);
        $this->session->sess_destroy();
        if (isset($_COOKIE['ci_session'])) {
            setcookie('ci_session', '', time() - 3600, '/');
        }
        redirect('auth/login');
    }

    // ==================== GOOGLE LOGIN ====================

    public function google() {
        // Load Google config
        $this->config->load('google', TRUE);
        $client_id = $this->config->item('google_client_id', 'google');
        $redirect_uri = $this->config->item('google_redirect_uri', 'google');

        // Build Google OAuth URL manually (without library for redirect)
        $params = http_build_query([
            'client_id' => $client_id,
            'redirect_uri' => $redirect_uri,
            'response_type' => 'code',
            'scope' => 'email profile',
            'access_type' => 'online',
            'prompt' => 'select_account'
        ]);

        redirect('https://accounts.google.com/o/oauth2/v2/auth?' . $params);
    }

    public function google_callback() {
        $code = $this->input->get('code');

        if (!$code) {
            $this->session->set_flashdata('error', 'Gagal login dengan Google. Silakan coba lagi.');
            redirect('auth/login');
        }

        // Load Google config
        $this->config->load('google', TRUE);
        $client_id = $this->config->item('google_client_id', 'google');
        $client_secret = $this->config->item('google_client_secret', 'google');
        $redirect_uri = $this->config->item('google_redirect_uri', 'google');

        // Tukar authorization code dengan access token via cURL
        $token_url = 'https://oauth2.googleapis.com/token';
        $post_data = [
            'code' => $code,
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => $redirect_uri,
            'grant_type' => 'authorization_code'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $token_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $token_response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code !== 200) {
            $this->session->set_flashdata('error', 'Gagal mendapatkan token dari Google. Silakan coba lagi.');
            redirect('auth/login');
        }

        $token_data = json_decode($token_response);
        $access_token = $token_data->access_token ?? null;

        if (!$access_token) {
            $this->session->set_flashdata('error', 'Gagal mendapatkan akses token. Silakan coba lagi.');
            redirect('auth/login');
        }

        // Ambil data profil user dari Google
        $userinfo_url = 'https://www.googleapis.com/oauth2/v2/userinfo?access_token=' . $access_token;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $userinfo_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $userinfo_response = curl_exec($ch);
        curl_close($ch);

        $google_user = json_decode($userinfo_response);

        if (!isset($google_user->email)) {
            $this->session->set_flashdata('error', 'Gagal mendapatkan data profil dari Google. Silakan coba lagi.');
            redirect('auth/login');
        }

        $google_id = $google_user->id;
        $email = $google_user->email;
        $nama = $google_user->name ?? explode('@', $email)[0];
        $avatar_url = $google_user->picture ?? null;

        // Cari user berdasarkan email
        $user = $this->auth_model->get_by_email($email);

        if ($user) {
            // User sudah ada: update google_id kalau belum ada, lalu login
            if (!$user->google_id) {
                $this->auth_model->update_google_id($email, $google_id, $avatar_url);
            }
        } else {
            // User baru: buat akun otomatis
            $new_user_data = [
                'nama' => $nama,
                'email' => $email,
                'password' => password_hash(bin2hex(random_bytes(16)), PASSWORD_DEFAULT),
                'no_hp' => '',
                'google_id' => $google_id,
                'avatar_url' => $avatar_url,
                'role' => 'pelanggan'
            ];
            $this->auth_model->insert_google_user($new_user_data);
        }

        // Login otomatis
        $user = $this->auth_model->get_by_email($email);
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
        }

        $this->session->set_flashdata('error', 'Gagal login dengan Google. Silakan coba lagi.');
        redirect('auth/login');
    }

    // ==================== LUPA PASSWORD ====================

    public function forgot_password() {
        // Cek sudah login? redirect
        if ($this->session->userdata('id_user')) {
            redirect('home');
        }
        $this->load->view('auth/forgot_password');
    }

    public function send_reset_link() {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/forgot_password', ['error_message' => 'Masukkan email yang valid.']);
            return;
        }

        $email = $this->input->post('email', TRUE);
        $user = $this->auth_model->get_by_email($email);

        if (!$user) {
            $this->session->set_flashdata('error', 'Email tidak terdaftar. Silakan periksa kembali.');
            redirect('auth/forgot_password');
        }

        // Generate token aman
        $token = bin2hex(random_bytes(32));
        $expired_at = date('Y-m-d H:i:s', strtotime('+60 minutes'));

        // Invalidate old tokens for this email
        $this->auth_model->invalidate_old_tokens($email);

        // Save token
        $this->auth_model->create_reset_token($email, $token, $expired_at);

        // Load config email & initialize library dengan config
        $this->config->load('email', TRUE);
        $email_config = [
            'protocol'    => $this->config->item('protocol', 'email'),
            'smtp_host'   => $this->config->item('smtp_host', 'email'),
            'smtp_port'   => $this->config->item('smtp_port', 'email'),
            'smtp_user'   => $this->config->item('smtp_user', 'email'),
            'smtp_pass'   => $this->config->item('smtp_pass', 'email'),
            'smtp_crypto' => $this->config->item('smtp_crypto', 'email'),
            'mailtype'    => $this->config->item('mailtype', 'email'),
            'charset'     => $this->config->item('charset', 'email'),
            'newline'     => $this->config->item('newline', 'email'),
        ];
        // Clear library lama & re-init dengan config baru
        $this->load->library('email', $email_config);

        $reset_link = base_url('auth/reset_password?token=' . $token);

        $this->email->from($email_config['smtp_user'], 'NINGNONG Kue Basah');
        $this->email->to($email);
        $this->email->subject('Reset Password - NINGNONG Kue Basah');
        $this->email->set_mailtype('html');

        // Plain text version (biar Gmail tidak tampil kosong)
        $alt_message = "Halo,\n\n";
        $alt_message .= "Kami menerima permintaan reset password untuk akun Anda.\n\n";
        $alt_message .= "Klik link berikut untuk mereset password:\n";
        $alt_message .= $reset_link . "\n\n";
        $alt_message .= "Link ini berlaku selama 60 menit.\n";
        $alt_message .= "Abaikan email ini jika Anda tidak meminta reset password.\n\n";
        $alt_message .= "— NINGNONG Kue Basah";
        $this->email->set_alt_message($alt_message);

        // HTML version
        $message = '
        <!DOCTYPE html>
        <html>
        <head><meta charset="UTF-8"></head>
        <body style="margin:0; padding:0; background-color:#F7F6F2; font-family:Arial, Helvetica, sans-serif;">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#F7F6F2; padding:20px 0;">
                <tr>
                    <td align="center">
                        <table role="presentation" width="500" cellpadding="0" cellspacing="0" style="background-color:#FFFFFF; border-radius:24px; border:1px solid #E5E3DE;">
                            <tr>
                                <td style="padding:40px; text-align:center;">
                                    <table role="presentation" width="60" cellpadding="0" cellspacing="0" style="background-color:#7C8C6C; border-radius:16px;">
                                        <tr>
                                            <td height="60" align="center" style="color:#FFFFFF; font-size:24px; font-weight:bold;">N</td>
                                        </tr>
                                    </table>
                                    <h2 style="color:#2C2C2C; font-family:Arial, sans-serif; margin-top:15px; font-size:22px;">Reset Password</h2>
                                    <p style="color:#6E6E6E; font-size:14px; line-height:1.5;">Klik tombol di bawah untuk mereset password akun Anda.</p>
                                    <table role="presentation" cellpadding="0" cellspacing="0" style="margin:30px auto;">
                                        <tr>
                                            <td align="center" style="background-color:#7C8C6C; border-radius:50px; padding:14px 40px;">
                                                <a href="' . $reset_link . '" style="color:#FFFFFF; text-decoration:none; font-weight:600; font-size:15px; display:inline-block;">Reset Password</a>
                                            </td>
                                        </tr>
                                    </table>
                                    <p style="color:#9A9A9A; font-size:12px; line-height:1.5;">Link ini berlaku selama 60 menit.<br>Abaikan email ini jika Anda tidak meminta reset password.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>';

        $this->email->message($message);

        // Coba kirim email
        $send_result = $this->email->send();

        if ($send_result) {
            $this->session->set_flashdata('success', 'Link reset password telah dikirim ke email Anda. Silakan cek inbox (atau folder spam).');
        } else {
            // Log detail error untuk debugging (tidak ditampilkan ke user)
            $debug_info = $this->email->print_debugger();
            log_message('error', 'Email reset password gagal dikirim ke ' . $email . '. Debug: ' . $debug_info);

            // Untuk development: tampilkan link reset langsung di halaman sebagai alternatif
            // (Hapus bagian ini setelah SMTP sudah berfungsi)
            $this->session->set_flashdata('reset_link', $reset_link);

            // Tampilkan pesan error yang user-friendly
            $this->session->set_flashdata('error', 'Gagal mengirim email reset password. Silakan periksa koneksi internet Anda dan coba lagi, atau hubungi admin.');
        }

        redirect('auth/forgot_password');
    }

    public function reset_password() {
        $token = $this->input->get('token');

        if (!$token) {
            $this->session->set_flashdata('error', 'Token reset tidak ditemukan.');
            redirect('auth/forgot_password');
        }

        // Validasi token
        $reset = $this->auth_model->get_reset_token($token);

        if (!$reset) {
            $data['error'] = 'Token tidak valid atau sudah kedaluwarsa. Silakan request ulang.';
            $this->load->view('auth/reset_password', $data);
            return;
        }

        $data['token'] = $token;
        $data['email'] = $reset->email;
        $this->load->view('auth/reset_password', $data);
    }

    public function proses_reset_password() {
        $token = $this->input->post('token', TRUE);
        $password = $this->input->post('password', TRUE);
        $konfirmasi_password = $this->input->post('konfirmasi_password', TRUE);

        $this->form_validation->set_rules('password', 'Password Baru', 'required|min_length[6]');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data['token'] = $token;
            $data['error'] = validation_errors('<p>', '</p>');
            $this->load->view('auth/reset_password', $data);
            return;
        }

        // Validasi token lagi
        $reset = $this->auth_model->get_reset_token($token);

        if (!$reset) {
            $this->session->set_flashdata('error', 'Token tidak valid atau sudah kedaluwarsa. Silakan request ulang.');
            redirect('auth/forgot_password');
        }

        // Update password
        $this->auth_model->update_password($reset->email, $password);

        // Invalidate token
        $this->auth_model->invalidate_reset_token($token);

        // Redirect ke login dengan flash message sukses
        $this->session->set_flashdata('success', 'Password berhasil direset. Silakan login dengan password baru Anda.');
        redirect('auth/login');
    }
}