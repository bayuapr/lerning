<?php
defined('BASEPATH') or exit('No direct script access allowed');

class login_msiswa extends CI_Model
{
    //cek username dan password admin
    function auth_siswa($username, $password)
    {
        $query = $this->db->query("SELECT * FROM siswa WHERE username='$username' AND password=MD5('$password') LIMIT 1");
        return $query;
    }
}
