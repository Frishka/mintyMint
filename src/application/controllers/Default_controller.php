<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Default_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->authorization->logged_in()) {
            // redirect to login view

            redirect('/login', 'refresh');
        } redirect('/home', 'refresh');
    }
    public function index () {


    }
}