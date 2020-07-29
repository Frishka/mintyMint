<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Users_Table extends CI_Migration {

    public function up()
    {

        if (!$this->db->table_exists('users')) {
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'username' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                ),
                'email' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => TRUE,
                ),
                'password' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => TRUE,
                ),
                'created_at' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'null' => TRUE,
                ),
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->add_key('username');
            $this->dbforge->create_table('users');

            $ci = &get_instance();

            $this->db->insert('users', [
                'username' => 'test',
                'password' => $ci->authorization->genPassHash('12345')
            ]);

        }
    }

    public function down()
    {
//        $this->dbforge->drop_table('users');
    }
}