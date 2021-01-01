<?php
class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('session');
    }

    function index()
    {
        $this->load->view('v_login');
    }

    function auth()
    {
        $username = htmlspecialchars($this->input->post('username', TRUE), ENT_QUOTES);
        $password = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);

        $cek_admin = $this->login_model->auth_admin($username, $password);

        if ($cek_admin->num_rows() > 0) { //jika login sebagai admin
            $data = $cek_admin->row_array();
            $this->session->set_userdata('masuk', TRUE);
            if ($data['level'] == '1') { //Akses admin
                $this->session->set_userdata('akses', '1');
                $this->session->set_userdata('ses_id', $data['id_admin']);
                $this->session->set_userdata('ses_nama', $data['nama']);
                redirect('page');
            } else { // jika username dan password tidak ditemukan atau salah
                $url = base_url();
                echo $this->session->set_flashdata('massage', '<div class="alert 
					alert-danger" role="alert">Username Atau Password Salah
					</div>');
                redirect($url);
            }
        } else { //jika login sebagai pengajar
            $cek_pengajar = $this->login_model->auth_pengajar($username, $password);
            if ($cek_pengajar->num_rows() > 0) {
                $data = $cek_pengajar->row_array();
                $this->session->set_userdata('masuk', TRUE);
                ($data['level'] == '2');
                $this->session->set_userdata('akses', '2');
                $this->session->set_userdata('ses_id', $data['id_pengajar']);
                $this->session->set_userdata('ses_nama', $data['nama']);
                redirect('page');
            } else {  // jika username dan password tidak ditemukan atau salah
                $url = base_url();
                echo $this->session->set_flashdata('massage', '<div class="alert 
					alert-danger" role="alert">Username Atau Password Salah
					</div>');
                redirect($url);
            }
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        $url = base_url('login');
        redirect($url);
    }
}
