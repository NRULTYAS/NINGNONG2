<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_paket_model extends CI_Model {
    protected $table = 'item_paket_catering';

    public function __construct() {
        parent::__construct();
    }

    public function get_by_paket($paket_id) {
        return $this->db
            ->order_by('kategori, is_default DESC, id')
            ->get_where($this->table, ['paket_id' => $paket_id])
            ->result();
    }

    public function get_kategori_by_paket($paket_id) {
        $this->db->distinct();
        $this->db->select('kategori');
        $this->db->order_by('FIELD(kategori, "Nasi", "Lauk", "Sayur", "Tambahan")');
        return $this->db->get_where($this->table, ['paket_id' => $paket_id])->result();
    }

    public function get_by_paket_kategori($paket_id, $kategori) {
        return $this->db
            ->order_by('is_default DESC, id')
            ->get_where($this->table, ['paket_id' => $paket_id, 'kategori' => $kategori])
            ->result();
    }

    public function get_default_by_paket($paket_id) {
        return $this->db
            ->order_by('kategori, id')
            ->get_where($this->table, ['paket_id' => $paket_id, 'is_default' => 1])
            ->result();
    }

    public function get_by_id($id) {
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

    public function unset_defaults($paket_id, $kategori) {
        $this->db->where('paket_id', $paket_id);
        $this->db->where('kategori', $kategori);
        return $this->db->update($this->table, ['is_default' => 0]);
    }
}