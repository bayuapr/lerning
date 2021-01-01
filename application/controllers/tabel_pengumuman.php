<?php
defined('BASEPATH') or exit('No direct script access allowed');

class tabel_pengumuman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tm_pengumuman', 'login');
    }

    public function index()
    {

        $this->load->view('vtabel_pengumuman');
    }

    public function ajax_list()
    {
        $list = $this->login->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pengumuman) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $pengumuman->judul_pengumuman;
            $row[] = $pengumuman->image_pengumuman;
            $row[] = $pengumuman->tgl_posting;
            //add html for action
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_pengumuman(' . "'" . $pengumuman->id_pengumuman . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->login->count_all(),
            "recordsFiltered" => $this->login->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_delete($id)
    {
        $this->login->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
}
