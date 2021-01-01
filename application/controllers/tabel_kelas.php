<?php
defined('BASEPATH') or exit('No direct script access allowed');

class tabel_kelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kelas_model', 'login');
    }

    public function index()
    {

        $this->load->view('vtabel_kelas');
    }

    public function ajax_list()
    {
        $list = $this->login->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $kelas) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $kelas->nama_kelas;
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_kelas(' . "'" . $kelas->id_kelas . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_kelas(' . "'" . $kelas->id_kelas . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

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

    public function ajax_edit($id)
    {
        $data = $this->login->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $this->_validate();
        $data = array(
            'nama_kelas' => htmlspecialchars($this->input->post('nama_kelas', true)),
        );
        $insert = $this->login->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'nama_kelas' => htmlspecialchars($this->input->post('nama_kelas', true)),
        );
        $this->login->update(array('id_kelas' => $this->input->post('id_kelas')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->login->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }


    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nama_kelas') == '') {
            $data['inputerror'][] = 'nama_kelas';
            $data['error_string'][] = 'Nama Kelas is required';
            $data['status'] = FALSE;
        }


        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
