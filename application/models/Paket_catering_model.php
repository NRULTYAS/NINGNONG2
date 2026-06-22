<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket_catering_model extends CI_Model {
    protected $table = 'paket_catering';

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        if (!$this->db->table_exists($this->table)) {
            return [];
        }
        return $this->db->order_by('created_at', 'DESC')->get($this->table)->result();
    }

    public function get_active() {
        // Cek apakah tabel sudah ada (untuk kompatibilitas sebelum migration)
        if (!$this->db->table_exists($this->table)) {
            return [];
        }
        return $this->db->get_where($this->table, ['status' => 'aktif'])->result();
    }

    public function get_by_id($id) {
        if (!$this->db->table_exists($this->table)) {
            return null;
        }
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id) {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    public function count_all() {
        if (!$this->db->table_exists($this->table)) {
            return 0;
        }
        return $this->db->count_all($this->table);
    }
}