<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{
    //cek username dan password admin
    function auth_admin($username, $password)
    {
        $query = $this->db->query("SELECT * FROM admin WHERE username='$username' AND password=MD5('$password') LIMIT 1");
        return $query;
    }

    //cek username dan password pengajar
    function auth_pengajar($username, $password)
    {
        $query = $this->db->query("SELECT * FROM pengajar WHERE username='$username' AND password=MD5('$password') LIMIT 1");
        return $query;
    }
}
