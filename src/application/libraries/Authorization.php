<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Authorization
{

    protected $ci;
    protected $table = 'users';
    protected $errors = [];
    protected $messages;
    protected $password_salt = 'SALT';

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->library('session');
        $this->ci->load->model('user');
        $this->ci->load->helper('cookie');
    }

    public function logged_in()
    {
        return (bool) $this->ci->session->userdata('username');
    }
    public function genPassHash (string $password)
    {
        return password_hash($this->password_salt . $password, PASSWORD_BCRYPT);
    }

    private function username_check(string $username = '')
    {
        if (empty($username))
        {
            return FALSE;
        }
        return count($this->ci->user->get_users_by_username($username))  > 0;
    }

    public function check_password($password, $password_hash)
    {
        if (empty($password))
        {
            return FALSE;
        }

        if (password_verify($this->password_salt . $password, $password_hash))
        {
            return TRUE;
        }

        return FALSE;
    }


    public function login (string $username, string $password)
    {
        if (empty($username) || empty($password) || !$this->username_check($username))
        {
            return FALSE;
        }


        $user = $this->ci->user->get_users_by_username($username);

        if ($user)
        {

            if ($this->check_password($password,$user[0]->password))
            {
                $session_data = array(
                    'username' => $user[0]->username,
                    'id'       => $user[0]->id,
                );

                $this->ci->session->set_userdata($session_data);

                return TRUE;
            }
        }

        return FALSE;
    }

    public function logout ()
    {

        $this->ci->session->unset_userdata('username');
        $this->ci->session->unset_userdata('id');
        $this->ci->session->unset_userdata('user_id');

        //delete the remember me cookies if they exist
        if (get_cookie('identity'))
        {
            delete_cookie('identity');
        }
        if (get_cookie('remember_code'))
        {
            delete_cookie('remember_code');
        }

        $this->ci->session->sess_destroy();

        $this->set_message('logout_successful');
        return TRUE;
    }

    public function set_message($message)
    {
        $this->messages[] = $message;

        return $message;
    }

    public function messages()
    {
        $_output = '';
        foreach ($this->messages ?? [] as $message)
        {
            $_output .= $this->message_start_delimiter . $this->ci->lang->line($message) . $this->message_end_delimiter;
        }

        return $_output;
    }


    public function set_error($error)
    {
        $this->errors[] = $error;

        return $error;
    }


    public function errors()
    {
        $_output = '';
        foreach ($this->errors as $error)
        {
            $_output .= $this->error_start_delimiter . $this->ci->lang->line($error) . $this->error_end_delimiter;
        }

        return $_output;
    }


}