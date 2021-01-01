<?php
class Pengumuman extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('pengumuman_model');
        $this->load->library('upload');
    }
    function index()
    {
        $this->load->view('v_post_pengumuman');
    }

    function simpan_post()
    {
        $config['upload_path'] = './assets/images/'; //path folder
        $config['allowed_types'] = 'jpg|jpeg|'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        // print_r($_FILES);
        // exit;
        $this->upload->initialize($config);
        if (!empty($_FILES['filefoto']['name'])) {
            if ($this->upload->do_upload('filefoto')) {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/images/' . $gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '50%';
                $config['width'] = 710;
                $config['height'] = 420;
                $config['new_image'] = './assets/images/' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $gambar = $gbr['file_name'];
                $judul = htmlspecialchars($this->input->post('judul_pengumuman'));
                $pengumuman = $this->input->post('isi_pengumuman');

                $this->pengumuman_model->simpan_pengumuman($judul, $pengumuman, $gambar);
                $url = base_url('page/tabel_pengumuman');
                echo $this->session->set_flashdata('massage', '<div class="alert 
					alert-success" role="alert">Pengumuman berhasil diupload
					</div>');
                redirect($url);
            } else {
                $url = base_url('page/post_pengumuman');
                echo $this->session->set_flashdata('massage', '<div class="alert 
					alert-danger" role="alert">Pengumuman gagal diupload
					</div>');
                redirect($url);
            }
        } else {
            $url = base_url('page/post_pengumuman');
            echo $this->session->set_flashdata('massage', '<div class="alert 
					alert-danger" role="alert">Pengumuman gagal diupload
					</div>');
            redirect($url);
        }
    }
}
