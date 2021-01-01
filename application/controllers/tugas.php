<?php
class Tugas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('tugas_model');
        $this->load->helper('url');
        $this->load->library('upload');
    }
    function index()
    {
        $data['tugas'] = $this->tugas_model->get_tugas();
        $this->load->view('v_tugas', $data);
    }

    function tambah_tugas()
    {
        $data['kelas'] = $this->tugas_model->get_kelas()->result();
        $this->load->view('vtambah_tugas', $data);
    }

    function simpan_tugas()
    {
        $config['upload_path'] = './assets/file/'; //path folder
        $config['allowed_types'] = 'pptx|doc|docx|pdf'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

        $this->upload->initialize($config);

        if (!empty($_FILES['filefoto']['name'])) {
            if ($this->upload->do_upload('filefoto')) {
                $gbr = $this->upload->data();

                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/file' . $gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '60%';
                $config['width'] = 710;
                $config['height'] = 420;
                $config['new_image'] = './assets/file' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $file = $gbr['file_name'];
                $judul = htmlspecialchars($this->input->post('judul_tugas', TRUE));
                $id_kelas = htmlspecialchars($this->input->post('tugas_kelas_id', TRUE));
                $tanggal = htmlspecialchars($this->input->post('tgl_kumpul', TRUE));

                $this->tugas_model->save_tugas($judul, $id_kelas, $file, $tanggal);
                $url = base_url('page/post_tugas');
                echo $this->session->set_flashdata('massage', '<div class="alert 
					alert-success" role="alert">tugas berhasil diupload
					</div>');
                redirect($url);
            } else {
                $url = base_url('page/tambah_tugas');
                echo $this->session->set_flashdata('massage', '<div class="alert 
					alert-danger" role="alert">tugas gagal diupload
					</div>');
                redirect($url);
            }
        } else {
            $url = base_url('page/tambah_tugas');
            echo $this->session->set_flashdata('massage', '<div class="alert 
					alert-danger" role="alert">tugas gagal diupload
					</div>');
            redirect($url);
        }
    }

    public function download($id_tugas)
    {
        $this->load->helper('download');
        $fileinfo = $this->tugas_model->download($id_tugas);
        $file = './assets/file/' . $fileinfo['file_tugas'];
        force_download($file, NULL);
    }

    public function delete()
    {

        $id_tugas = $this->uri->segment(3);
        $this->tugas_model->delete_by_id($id_tugas);
        $this->session->set_flashdata('msg', '<div class="alert alert-success">Product Deleted</div>');
        redirect('page/post_tugas');
    }
}
