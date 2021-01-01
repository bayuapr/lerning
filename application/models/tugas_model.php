<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tugas_model extends CI_Model
{

    function get_kelas()
    {
        $query = $this->db->get('kelas');
        return $query;
    }

    function save_tugas($judul, $file, $id_kelas, $tanggal)
    {
        $data = array(
            'judul_tugas' => $judul,
            'tugas_kelas_id' => $file,
            'file_tugas' => $id_kelas,
            'tgl_kumpul' => $tanggal,
        );
        // print_r($data);
        // exit();
        $this->db->insert('tugas', $data);
    }

    function get_tugas()
    {
        $this->db->select('id_tugas,judul_tugas,tgl_upload,tgl_kumpul,file_tugas,nama_kelas');
        $this->db->from('tugas');
        $this->db->join('kelas', 'tugas_kelas_id = id_kelas', 'left');
        $query = $this->db->get();
        return $query;
    }

    function get_kelas_by_id($id_kelas)
    {
        $query = $this->db->get_where('kelas', array('id_kelas' =>  $id_kelas));
        return $query;
    }
    public function download($id_tugas)
    {
        $query = $this->db->get_where('tugas', array('id_tugas' => $id_tugas));
        return $query->row_array();
    }

    public function delete_by_id($id_kelas)
    {
        $row = $this->db->get_where('tugas', ['id_tugas' => $id_kelas])->result_array();
        if (file_exists('./assets/file/' . $row[0]['file_tugas'])) {
            unlink('./assets/file/' . $row[0]['file_tugas']);
        }
        $this->db->delete('tugas', array('id_tugas' =>  $id_kelas));
        redirect('page/post_tugas');
    }
}
