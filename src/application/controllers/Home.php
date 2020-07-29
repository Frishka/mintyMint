<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['user']);

    }
    public function index()
    {
        $this->View('home/index',$this->data);
    }

}