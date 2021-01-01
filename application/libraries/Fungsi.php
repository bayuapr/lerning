<?php

class Fungsi
{

    protected $ci;

    function __construct()
    {
        $this->ci = &get_instance();
    }
    public function t_awal()
    {
        $this->ci->load->model('pengajar_model');
        return $this->ci->pengajar_model->get()->num_rows();
    }
}
