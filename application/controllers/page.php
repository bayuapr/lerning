<?php
class Page extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //validasi jika user belum login
        $this->load->library('session');
        $this->load->model('materi_model');
        $this->load->model('tugas_model');
        $this->load->model('tugasm_model');
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url('login');
            redirect($url);
        }
    }

    function index()
    {
        $this->load->view('awal');
    }

    function post_pengumuman()
    {
        // function ini hanya boleh diakses oleh admin 
        if ($this->session->userdata('akses') == '1') {
            $this->load->view('v_post_pengumuman');
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    function tabel_admin()
    {
        // function ini hanya boleh diakses oleh admin
        if ($this->session->userdata('akses') == '1') {
            $this->load->view('vtabel_admin');
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    function tabel_pengajar()
    {
        // function ini hanya boleh diakses oleh admin
        if ($this->session->userdata('akses') == '1') {
            $this->load->view('vtabel_pengajar');
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    function tabel_siswa()
    {
        // function ini hanya boleh diakses oleh admin
        if ($this->session->userdata('akses') == '1') {
            $this->load->view('vtabel_siswa');
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    function tabel_kelas()
    {
        // function ini hanya boleh diakses oleh admin
        if ($this->session->userdata('akses') == '1') {
            $this->load->view('vtabel_kelas');
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    function tabel_pengumuman()
    {
        // function ini hanya boleh diakses oleh admin
        if ($this->session->userdata('akses') == '1') {
            $this->load->view('vtabel_pengumuman');
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    function post_materi()
    {
        // function ini hanya boleh diakses oleh admin
        if ($this->session->userdata('akses') == '2') {
            $data['materi'] = $this->materi_model->get_materi();
            $this->load->view('v_materi', $data);
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    function tambah_materi()
    {
        // function ini hanya boleh diakses oleh admin
        if ($this->session->userdata('akses') == '2') {
            $data['kelas'] = $this->materi_model->get_kelas()->result();
            $this->load->view('vtambah_materi', $data);
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    function post_tugas()
    {
        // function ini hanya boleh diakses oleh admin
        if ($this->session->userdata('akses') == '2') {
            $data['tugas'] = $this->tugas_model->get_tugas();
            $this->load->view('v_tugas', $data);
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    function tambah_tugas()
    {
        // function ini hanya boleh diakses oleh admin
        if ($this->session->userdata('akses') == '2') {
            $data['kelas'] = $this->tugas_model->get_kelas()->result();
            $this->load->view('vtambah_tugas', $data);
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    function post_tugas_masuk()
    {
        // function ini hanya boleh diakses oleh admin
        if ($this->session->userdata('akses') == '2') {
            $data['instgs'] = $this->tugasm_model->get_instgs();
            $this->load->view('v_tugas_masuk', $data);
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }
}
