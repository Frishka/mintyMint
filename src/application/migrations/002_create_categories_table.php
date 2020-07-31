<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Categories_Table extends CI_Migration {

    public function up()
    {

        if (!$this->db->table_exists('categories'))
        {
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'parent_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'null' => TRUE,
                ),
                'name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                ),
                'desc' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => TRUE,
                ),
            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->add_key('parent_id');
            $this->dbforge->create_table('categories');

        }
    }

    public function down()
    {
//        $this->dbforge->drop_table('categories');
    }
}