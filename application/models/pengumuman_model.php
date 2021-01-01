<?php
class pengumuman_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function simpan_pengumuman($judul, $pengumuman, $gambar)
    {
        $hsl = $this->db->query("INSERT INTO pengumuman (judul_pengumuman,isi_pengumuman,image_pengumuman) VALUES ('$judul','$pengumuman','$gambar')");
        return $hsl;
    }

    function get_pengumuman_by_kode($kode)
    {
        $hsl = $this->db->query("SELECT * FROM pengumuman WHERE id_pengumuman='$kode'");
        return $hsl;
    }

    function get_all_pengumuman()
    {
        $hsl = $this->db->query("SELECT * FROM pengumuman ORDER BY id_pengumuman DESC");
        return $hsl;
    }
}
