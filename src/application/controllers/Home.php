<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkAuth();
        $this->load->model(['category']);
    }
    public function index()
    {
        $categories = $this->category->get_categories();

        if(empty($categories))
        {
            $this->data['categories'] = [];
        }
        else {
            $this->data['categories'] = $this->category->createTree($categories);
        }

        $this->data['title'] = 'Home Page';

        $this->data['options'] = array_merge([ '0' => 'No parent'],$this->category->get_options());

        $this->View('home/index',$this->data);
    }


}