<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekomendasi extends CI_Model {
    protected $table = 'tbl_produk';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Content-Based Filtering Recommendation
     * Menghitung kemiripan produk berdasarkan:
     * - Kategori (exact match)
     * - Rasa (exact match)
     * - Rentang harga (within 20%)
     */
    public function get_rekomendasi($id_produk, $limit = 4) {
        $produk = $this->db->get_where('tbl_produk', ['id_produk' => $id_produk])->row();
        if (!$produk) return [];

        // Ambil semua produk kecuali yang sedang dilihat
        $this->db->where('id_produk !=', $id_produk);
        $this->db->where('stok >', 0);
        $semua_produk = $this->db->get('tbl_produk')->result();

        $skor_produk = [];
        $harga_target = (float) $produk->harga;
        $harga_min = $harga_target * 0.5;
        $harga_max = $harga_target * 1.5;

        foreach ($semua_produk as $p) {
            $skor = 0;

            // Bobot kategori (40%)
            if ($p->id_kategori == $produk->id_kategori) {
                $skor += 40;
            }

            // Bobot rasa (30%)
            if (strcasecmp($p->rasa, $produk->rasa) == 0) {
                $skor += 30;
            }

            // Bobot harga (30%) - semakin dekat harganya, semakin tinggi skor
            $harga_p = (float) $p->harga;
            if ($harga_p >= $harga_min && $harga_p <= $harga_max) {
                $selisih = abs($harga_p - $harga_target);
                $max_selisih = $harga_target * 0.5;
                $skor_harga = 30 * (1 - ($selisih / $max_selisih));
                $skor += max(0, $skor_harga);
            }

            if ($skor > 0) {
                $skor_produk[] = [
                    'produk' => $p,
                    'skor' => $skor
                ];
            }
        }

        // Urutkan berdasarkan skor tertinggi
        usort($skor_produk, function($a, $b) {
            return $b['skor'] <=> $a['skor'];
        });

        // Ambil top N
        $hasil = array_slice($skor_produk, 0, $limit);

        // Jika kurang dari limit, tambahkan produk random dari kategori yang sama
        if (count($hasil) < $limit) {
            $ids_exclude = array_merge([$id_produk], array_column($hasil, 'produk'));
            $ids = array_map(function($h) { return $h['produk']->id_produk; }, $hasil);
            $ids[] = $id_produk;
            
            $this->db->where('id_kategori', $produk->id_kategori);
            $this->db->where_not_in('id_produk', $ids);
            $this->db->where('stok >', 0);
            $this->db->limit($limit - count($hasil));
            $tambahan = $this->db->get('tbl_produk')->result();
            
            foreach ($tambahan as $t) {
                $hasil[] = [
                    'produk' => $t,
                    'skor' => 10
                ];
            }
        }

        // Jika masih kurang, tambahkan produk random
        if (count($hasil) < $limit) {
            $ids = array_map(function($h) { return $h['produk']->id_produk; }, $hasil);
            $ids[] = $id_produk;
            
            $this->db->where_not_in('id_produk', $ids);
            $this->db->where('stok >', 0);
            $this->db->limit($limit - count($hasil));
            $tambahan = $this->db->get('tbl_produk')->result();
            
            foreach ($tambahan as $t) {
                $hasil[] = [
                    'produk' => $t,
                    'skor' => 5
                ];
            }
        }

        return $hasil;
    }
}
