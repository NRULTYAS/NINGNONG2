<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
    protected $table = 'tbl_user';

    public function __construct() {
        parent::__construct();
    }

    public function register($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['role'] = 'pelanggan';
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function login($email, $password) {
        $user = $this->db->get_where($this->table, ['email' => $email])->row();
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }

    public function get_by_email($email) {
        return $this->db->get_where($this->table, ['email' => $email])->row();
    }

    public function get_by_google_id($google_id) {
        return $this->db->get_where($this->table, ['google_id' => $google_id])->row();
    }

    public function insert_google_user($data) {
        $data['role'] = 'pelanggan';
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update_google_id($email, $google_id, $avatar_url = null) {
        $update_data = ['google_id' => $google_id];
        if ($avatar_url !== null) {
            $update_data['avatar_url'] = $avatar_url;
        }
        $this->db->where('email', $email);
        return $this->db->update($this->table, $update_data);
    }

    // Password Reset Methods
    public function create_reset_token($email, $token, $expired_at) {
        $data = [
            'email' => $email,
            'token' => $token,
            'expired_at' => $expired_at
        ];
        return $this->db->insert('password_resets', $data);
    }

    public function get_reset_token($token) {
        $this->db->where('token', $token);
        $this->db->where('used', 0);
        $this->db->where('expired_at >', date('Y-m-d H:i:s'));
        return $this->db->get('password_resets')->row();
    }

    public function invalidate_reset_token($token) {
        $this->db->where('token', $token);
        return $this->db->update('password_resets', ['used' => 1]);
    }

    public function invalidate_old_tokens($email) {
        $this->db->where('email', $email);
        return $this->db->update('password_resets', ['used' => 1]);
    }

    public function update_password($email, $password) {
        $this->db->where('email', $email);
        return $this->db->update($this->table, ['password' => password_hash($password, PASSWORD_DEFAULT)]);
    }
}