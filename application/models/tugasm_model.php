<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tugasm_model extends CI_Model
{

    function get_kelas()
    {
        $query = $this->db->get('kelas');
        return $query;
    }

    function save_instgs($judul, $file, $id_kelas)
    {
        $data = array(
            'judul' => $judul,
            'kelas_id' => $file,
            'file' => $id_kelas,
        );
        // print_r($data);
        // exit();
        $this->db->insert('instgs', $data);
    }

    function get_instgs()
    {
        $this->db->select('id_instgs,judul,tgl_upload,file,nama_kelas');
        $this->db->from('instgs');
        $this->db->join('kelas', 'kelas_id = id_kelas', 'left');
        $query = $this->db->get();
        return $query;
    }

    function get_kelas_by_id($id_kelas)
    {
        $query = $this->db->get_where('kelas', array('id_kelas' =>  $id_kelas));
        return $query;
    }
    public function download($id_instgs)
    {
        $query = $this->db->get_where('instgs', array('id_instgs' => $id_instgs));
        return $query->row_array();
    }

    public function delete_by_id($id_kelas)
    {
        $row = $this->db->get_where('instgs', ['id_instgs' => $id_kelas])->result_array();
        if (file_exists('./assets/file/' . $row[0]['file'])) {
            unlink('./assets/file/' . $row[0]['file']);
        }
        $this->db->delete('instgs', array('id_instgs' =>  $id_kelas));
        redirect('page/post_tugas_masuk');
    }
}
