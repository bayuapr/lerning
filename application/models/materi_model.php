<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Materi_model extends CI_Model
{

    function get_kelas()
    {
        $query = $this->db->get('kelas');
        return $query;
    }

    function save_materi($judul, $file, $id_kelas)
    {
        $data = array(
            'judul_materi' => $judul,
            'materi_kelas_id' => $file,
            'file_materi' => $id_kelas,
        );
        // print_r($data);
        // exit();
        $this->db->insert('materi', $data);
    }

    function get_materi()
    {
        $this->db->select('id_materi,judul_materi,file_materi,tgl_upload,nama_kelas');
        $this->db->from('materi');
        $this->db->join('kelas', 'materi_kelas_id = id_kelas', 'left');
        $query = $this->db->get();
        return $query;
    }

    function get_kelas_by_id($id_kelas)
    {
        $query = $this->db->get_where('kelas', array('id_kelas' =>  $id_kelas));
        return $query;
    }
    public function download($id_materi)
    {
        $query = $this->db->get_where('materi', array('id_materi' => $id_materi));
        return $query->row_array();
    }

    public function delete_by_id($id_materi)
    {
        $row = $this->db->get_where('materi', ['id_materi' => $id_materi])->result_array();
        if (file_exists('./assets/file/' . $row[0]['file_materi'])) {
            unlink('./assets/file/' . $row[0]['file_materi']);
        }
        $this->db->delete('materi', array('id_materi' =>  $id_materi));
        redirect('page/post_materi');
    }
}
