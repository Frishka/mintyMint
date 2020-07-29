<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->library('authorization');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('url');
    }

    //redirect if needed, otherwise display the user list
    function index()
    {
        if (!$this->authorization->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //list the users
            $this->data['users'] = $this->authorization->get_users_array();
            $this->load->view('auth/index', $this->data);
        }
    }

    //log the user in
    public function login()
    {
        $this->data['title'] = "Login";

        $username = $this->input->post('username');
        $password = $this->input->post('password');



        if ($this->authorization->logged_in()) {
            //already logged in so no need to access this page
            redirect($this->config->item('base_url'), 'refresh');
        }

        //validate form input
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true) {
            $redirect = '/login';

            if ($this->authorization->login($username, $password)) {
                //redirect them back to the home page
                $this->session->set_flashdata('message', $this->authorization->messages());
                $redirect = '/';
            } else {
                $this->session->set_flashdata('message', $this->authorization->errors());
            }

            redirect($redirect, 'refresh');

        }

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        $this->data['username'] = [
            'name' => 'username',
            'id' => 'username',
            'type' => 'text',
            'class' => 'form-control',
            'placeholder' => 'Введите свой логин',
            'aria-required' => "true",
            'value' => 'test'
        ];
        $this->data['password'] = [
            'name' => 'password',
            'id' => 'password',
            'type' => 'password',
            'class' => 'form-control',
            'placeholder' => 'Введите свой пароль',
            'aria-required' => "true",
            'value' => '12345'
        ];

        $this->load->view('auth/login',$this->data);

    }

    //log the user out
    public function logout()
    {

        //log the user out
        $this->authorization->logout();

        //redirect them back to the page they came from
        redirect(base_url(), 'refresh');
    }
}
