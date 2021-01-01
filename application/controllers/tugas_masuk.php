<?php
class Tugas_masuk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('tugasm_model');
        $this->load->helper('url');
        $this->load->library('upload');
    }
    function index()
    {
        $data['instgs'] = $this->tugasm_model->get_instgs();
        $this->load->view('v_tugas_masuk', $data);
    }

    function tambah_tugas()
    {
        $data['kelas'] = $this->tugasm_model->get_kelas()->result();
        $this->load->view('vupload_tugas', $data);
    }

    function simpan_tugas()
    {
        $config['upload_path'] = './assets/file/'; //path folder
        $config['allowed_types'] = 'pptx|doc|docx|pdf'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        // print_r($_FILES);
        // exit;
        $this->upload->initialize($config);
        // print_r($this->upload->initialize($config));
        // exit();
        if (!empty($_FILES['filefoto']['name'])) {
            if ($this->upload->do_upload('filefoto')) {
                $gbr = $this->upload->data();
                // print_r($gbr);
                // exit();
                //Compress Image
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
                $judul = htmlspecialchars($this->input->post('judul', TRUE));
                $id_kelas = htmlspecialchars($this->input->post('kelas_id', TRUE));

                $this->tugasm_model->save_instgs($judul, $id_kelas, $file);
                $url = base_url('page_siswa/lists_tugas/');
                echo $this->session->set_flashdata('massage', '<div class="alert 
					alert-success" role="alert">Tugas berhasil diupload
					</div>');
                redirect($url);
            } else {
                $url = base_url('page_siswa/upload_tugas');
                echo $this->session->set_flashdata('massage', '<div class="alert 
					alert-danger" role="alert">tugas gagal diupload
					</div>');
                redirect($url);
            }
        } else {
            $url = base_url('page_siswa/upload_tugas');
            echo $this->session->set_flashdata('massage', '<div class="alert 
					alert-danger" role="alert">tugas gagal diupload
					</div>');
            redirect($url);
        }
    }

    public function download($id_instgs)
    {
        $this->load->helper('download');
        $fileinfo = $this->tugasm_model->download($id_instgs);
        $file = './assets/file/' . $fileinfo['file'];
        force_download($file, NULL);
    }

    public function delete()
    {

        $id_instgs = $this->uri->segment(3);
        $this->tugasm_model->delete_by_id($id_instgs);
        $this->session->set_flashdata('msg', '<div class="alert alert-success">Product Deleted</div>');
        redirect('page/post_tugas');
    }
}
