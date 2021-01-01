<?php
class Page_siswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //validasi jika user belum login
        $this->load->library('session');
        $this->load->model('pengumuman_model');
        $this->load->model('materi_model');
        $this->load->model('tugas_model');
        $this->load->model('tugasm_model');

        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url('login_siswa');
            redirect($url);
        }
    }

    function index()
    {
        $this->load->view('beranda');
    }

    function pengumuman_lists()
    {
        // function ini hanya boleh diakses oleh admin 
        if ($this->session->userdata('akses') == '3') {
            $x['data'] = $this->pengumuman_model->get_all_pengumuman();
            $this->load->view('v_lists_pengumuman', $x);
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    function pengumuman_view()
    {
        // function ini hanya boleh diakses oleh admin 
        if ($this->session->userdata('akses') == '3') {
            $kode = $this->uri->segment(3);
            $x['data'] = $this->pengumuman_model->get_pengumuman_by_kode($kode);
            $this->load->view('v_view_pengumuman', $x);
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    function lists_materi()
    {
        // function ini hanya boleh diakses oleh admin
        if ($this->session->userdata('akses') == '3') {
            $data['materi'] = $this->materi_model->get_materi();
            $this->load->view('v_lists_materi', $data);
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    function lists_tugas()
    {
        // function ini hanya boleh diakses oleh admin
        if ($this->session->userdata('akses') == '3') {
            $data['tugas'] = $this->tugas_model->get_tugas();
            $this->load->view('v_lists_tugas', $data);
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    function upload_tugas()
    {
        // function ini hanya boleh diakses oleh admin
        if ($this->session->userdata('akses') == '3') {
            $data['kelas'] = $this->tugasm_model->get_kelas()->result();
            $this->load->view('vupload_tugas', $data);
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }
}
