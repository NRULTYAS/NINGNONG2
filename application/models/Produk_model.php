<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {
    protected $table = 'tbl_produk';

    public function __construct() {
        parent::__construct();
    }

    public function get_all($limit = null, $offset = null) {
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori');
        if ($limit) $this->db->limit($limit, $offset);
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id) {
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori');
        return $this->db->get_where($this->table, ['id_produk' => $id])->row();
    }

    public function get_by_kategori($id_kategori) {
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori');
        return $this->db->get_where($this->table, ['tbl_produk.id_kategori' => $id_kategori])->result();
    }

    public function search($keyword, $id_kategori = null) {
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori');
        $this->db->like('nama_produk', $keyword);
        $this->db->or_like('rasa', $keyword);
        if ($id_kategori) {
            $this->db->where('tbl_produk.id_kategori', $id_kategori);
        }
        return $this->db->get($this->table)->result();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id_produk', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id) {
        return $this->db->delete($this->table, ['id_produk' => $id]);
    }

    public function count_all() {
        return $this->db->count_all($this->table);
    }

    public function get_latest($limit = 6) {
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori');
        $this->db->order_by('id_produk', 'DESC');
        $this->db->limit($limit);
        return $this->db->get($this->table)->result();
    }
}
