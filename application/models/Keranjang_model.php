<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang_model extends CI_Model {
    protected $table = 'tbl_keranjang';

    public function __construct() {
        parent::__construct();
    }

    public function get_by_user($id_user) {
        $this->db->select('tbl_keranjang.*, tbl_produk.nama_produk, tbl_produk.harga, tbl_produk.gambar, tbl_produk.stok, tbl_kategori.nama_kategori');
        $this->db->join('tbl_produk', 'tbl_produk.id_produk = tbl_keranjang.id_produk');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori');
        return $this->db->get_where($this->table, ['id_user' => $id_user])->result();
    }

    public function get_by_user_produk($id_user, $id_produk) {
        return $this->db->get_where($this->table, ['id_user' => $id_user, 'id_produk' => $id_produk])->row();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id_keranjang', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id) {
        return $this->db->delete($this->table, ['id_keranjang' => $id]);
    }

    public function delete_by_user($id_user) {
        return $this->db->delete($this->table, ['id_user' => $id_user]);
    }

    public function count_by_user($id_user) {
        return $this->db->where('id_user', $id_user)->count_all_results($this->table);
    }
}
