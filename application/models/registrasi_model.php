<?php
defined('BASEPATH') or exit('No direct script access allowed');

class registrasi_model extends CI_Model
{
    //menginputkan data siswa
    public function register($data)
    {
        return $this->db->insert('siswa', $data);
    }
}
