<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

    private $dataView = [];
    protected $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->dataView['session'] = $this->session->all_userdata();
    }

    public function checkAuth()
    {
        if (!$this->authorization->logged_in())
        {
            // redirect to login view
            redirect('/login', 'refresh');
        }

    }

    public function View ($view, $data = [])
    {
        $this->load->view('templates/header',$this->dataView + $data);
        $this->load->view($view, $this->dataView + $data);
        $this->load->view('templates/footer');
    }
}
