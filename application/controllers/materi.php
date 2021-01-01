<?php
class Materi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('materi_model');
        $this->load->helper('url');
        $this->load->library('upload');
    }
    function index()
    {
        $data['materi'] = $this->materi_model->get_materi();
        $this->load->view('v_materi', $data);
    }

    function tambah_materi()
    {
        $data['kelas'] = $this->materi_model->get_kelas()->result();
        $this->load->view('v_lists_materi', $data);
    }

    function simpan_materi()
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
                $judul = htmlspecialchars($this->input->post('judul_materi', TRUE));
                $id_kelas = htmlspecialchars($this->input->post('materi_kelas_id', TRUE));;

                $this->materi_model->save_materi($judul, $id_kelas, $file);
                $url = base_url('page/post_materi');
                echo $this->session->set_flashdata('massage', '<div class="alert 
					alert-success" role="alert">Materi berhasil diupload
					</div>');
                redirect($url);
            } else {
                $url = base_url('page/tambah_materi');
                echo $this->session->set_flashdata('massage', '<div class="alert 
					alert-danger" role="alert">materi gagal diupload
					</div>');
                redirect($url);
            }
        } else {
            $url = base_url('page/tambah_materi');
            echo $this->session->set_flashdata('massage', '<div class="alert 
					alert-danger" role="alert">materi gagal diupload
					</div>');
            redirect($url);
        }
    }

    public function download($id_materi)
    {
        $this->load->helper('download');
        $fileinfo = $this->materi_model->download($id_materi);
        $file = './assets/file/' . $fileinfo['file_materi'];
        force_download($file, NULL);
    }

    public function delete()
    {
        $id_materi = $this->uri->segment(3);
        $this->materi_model->delete_by_id($id_materi);
        $url = base_url('page/post_materi');
        echo $this->session->set_flashdata('massage', '<div class="alert 
					alert-success" role="alert">Materi berhasil diupload
					</div>');
        redirect($url);
    }
}
