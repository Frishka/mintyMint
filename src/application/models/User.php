<?php

class User extends CI_Model
{

    private $table = 'users';

    public function get_user($id = false)
    {
        //if no id was passed use the current users id
        if (empty($id))
        {
            $id = $this->session->userdata('user_id');
        }

        $this->db->where($this->table.'.id', $id);
        $this->db->limit(1);

        return $this->db->get($this->table)->result();
    }

    public function get_users_by_username($username)
    {
        $this->db->where($this->table.'.username', $username);
        $this->db->limit(1);;

        return $this->db->get($this->table)->result();
    }
}