<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_model extends CI_Model {
    protected $table = 'tbl_pesanan';

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        $this->db->join('tbl_user', 'tbl_user.id_user = tbl_pesanan.id_user');
        $this->db->order_by('tbl_pesanan.created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id) {
        $this->db->join('tbl_user', 'tbl_user.id_user = tbl_pesanan.id_user');
        return $this->db->get_where($this->table, ['id_pesanan' => $id])->row();
    }

    public function get_by_user($id_user) {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get_where($this->table, ['id_user' => $id_user])->result();
    }

    public function get_detail($id_pesanan) {
        $this->db->select('tbl_detail_pesanan.*, tbl_produk.nama_produk, tbl_produk.gambar');
        $this->db->join('tbl_produk', 'tbl_produk.id_produk = tbl_detail_pesanan.id_produk');
        return $this->db->get_where('tbl_detail_pesanan', ['id_pesanan' => $id_pesanan])->result();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function insert_detail($data) {
        return $this->db->insert('tbl_detail_pesanan', $data);
    }

    public function update($id, $data) {
        $this->db->where('id_pesanan', $id);
        return $this->db->update($this->table, $data);
    }

    public function update_status($id, $status) {
        $this->db->where('id_pesanan', $id);
        return $this->db->update($this->table, ['status' => $status]);
    }

    public function delete($id) {
        return $this->db->delete($this->table, ['id_pesanan' => $id]);
    }

    public function count_all() {
        return $this->db->count_all($this->table);
    }

    public function count_by_status($status) {
        return $this->db->where('status', $status)->count_all_results($this->table);
    }

    public function total_penjualan() {
        $this->db->select_sum('total_harga');
        $this->db->where('status !=', 'dibatalkan');
        $result = $this->db->get($this->table)->row();
        return $result->total_harga ?: 0;
    }

    public function laporan_periode($dari, $sampai) {
        $this->db->join('tbl_user', 'tbl_user.id_user = tbl_pesanan.id_user');
        $this->db->where('tbl_pesanan.created_at >=', $dari . ' 00:00:00');
        $this->db->where('tbl_pesanan.created_at <=', $sampai . ' 23:59:59');
        $this->db->where('status !=', 'dibatalkan');
        $this->db->order_by('tbl_pesanan.created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }
}
