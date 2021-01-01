<?php
defined('BASEPATH') or exit('No direct script access allowed');

class tabel_admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model', 'login');
    }

    public function index()
    {

        $this->load->view('vtabel_admin');
    }

    public function ajax_list()
    {
        $list = $this->login->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $admin) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $admin->username;
            $row[] = $admin->nama;
            $row[] = $admin->alamat;
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_admin(' . "'" . $admin->id_admin . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_admin(' . "'" . $admin->id_admin . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
            'username' => htmlspecialchars($this->input->post('username', true)),
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'password' => md5($this->input->post('password')),
            'level' => 1,
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
        );
        $insert = $this->login->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'username' => htmlspecialchars($this->input->post('username', true)),
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'password' => md5($this->input->post('password')),
            'level' => 1,
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
        );
        $this->login->update(array('id_admin' => $this->input->post('id_admin')), $data);
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

        if ($this->input->post('username') == '') {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('nama') == '') {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('password') == '') {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Password of Birth is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('alamat') == '') {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Alamat is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
