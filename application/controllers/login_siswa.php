<?php
class Login_Siswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('login_msiswa');
        $this->load->library('session');
    }

    function index()
    {
        $this->load->view('vl_siswa');
    }

    function auth_siswa()
    {
        $username = htmlspecialchars($this->input->post('username', TRUE), ENT_QUOTES);
        $password = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);

        $cek_siswa = $this->login_msiswa->auth_siswa($username, $password);

        if ($cek_siswa->num_rows() > 0) {
            $data = $cek_siswa->row_array();
            $this->session->set_userdata('masuk', TRUE);
            if ($data['level'] == '3') {
                $url = base_url('page_siswa');
                $this->session->set_userdata('akses', '3');
                $this->session->set_userdata('ses_id', $data['id_siswa']);
                $this->session->set_userdata('ses_nama', $data['name']);
                redirect($url);
            } else {
                $url = base_url('login_siswa');
                echo $this->session->set_flashdata('massage', '<div class="alert 
					alert-danger" role="alert">Username Atau Password Salah
					</div>');
                redirect($url);
            }
        } else {  // jika username dan password tidak ditemukan atau salah
            $url = base_url('login_siswa');
            echo $this->session->set_flashdata('massage', '<div class="alert 
					alert-danger" role="alert">Username Atau Password Salah
					</div>');
            redirect($url);
        }
    }

    function logout_siswa()
    {
        $this->session->sess_destroy();
        $url = base_url('login_siswa');
        redirect($url);
    }
}
