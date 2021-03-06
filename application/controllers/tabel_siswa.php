<?php
defined('BASEPATH') or exit('No direct script access allowed');

class tabel_siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('siswa_model', 'login');
        $this->load->library('excel');
    }

    public function index()
    {

        $this->load->view('vtabel_siswa');
    }

    public function ajax_list()
    {
        $list = $this->login->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $siswa) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $siswa->username;
            $row[] = $siswa->nama;
            $row[] = $siswa->email;
            $row[] = $siswa->alamat;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_siswa(' . "'" . $siswa->id_siswa . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_siswa(' . "'" . $siswa->id_siswa . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

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
            'email' => htmlspecialchars($this->input->post('email', true)),
            'password' => md5($this->input->post('password')),
            'level' => 3,
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
            'email' => htmlspecialchars($this->input->post('email', true)),
            'password' => md5($this->input->post('password')),
            'level' => 3,
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
        );
        $this->login->update(array('id_siswa' => $this->input->post('id_siswa')), $data);
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
        $data['is_unique'] = array();
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

        if ($this->input->post('email') == '') {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email is required';
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
    public function import()
    {

        if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $id_siswa = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $username = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $email = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $password = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $nama = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $level = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $alamat = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $data[] = array(
                        'id_siswa'  => $id_siswa,
                        'username'  => $username,
                        'email'   => $email,
                        'password'  => md5($password),
                        'nama'   => $nama,
                        'level' => $level,
                        'alamat' => $alamat
                    );
                }
            }
            $this->login->insert($data);
            echo 'Data berhasil disimpan';
        }
    }
}
