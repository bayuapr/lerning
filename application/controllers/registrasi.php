<?php
class registrasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('registrasi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('v_registrasi');
    }

    public function auth_registrasi()
    {
        //valiadsi inputan 

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[siswa.email]',
            [
                'is_unique' => 'This email has already registered!'
            ]
        );
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('v_registrasi');
        } else {
            $data = [

                'username' => htmlspecialchars($this->input->post('username', true)),
                'email' =>  htmlspecialchars($this->input->post('email', true)),
                'password' => MD5($this->input->post('password1')),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'level' => 3,
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            ];

            $this->db->insert('siswa', $data);
            $this->session->set_flashdata('massage', '<div class="alert 
			alert-success" role="alert">Selamat akun anda sudah terdaftar, silahkan login!
			</div>');
            redirect('login_siswa');
        }
    }
}
