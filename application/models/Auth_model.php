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
}
