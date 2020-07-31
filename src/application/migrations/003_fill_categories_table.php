<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Fill_Categories_Table extends CI_Migration {

    public function up()
    {

        if ($this->db->table_exists('categories'))
        {

            $data = [
                [
                    'name' => 'Animals',
                    'desc' => 'Desc',
                    'parent_id' => 'NULL'
                ],[
                    'name' => 'Plants',
                    'desc' => 'Desc plants',
                    'parent_id' => 'NULL'
                ],[
                    'name' => 'Cats',
                    'desc' => 'Desc of cats',
                    'parent_id' => '1'
                ],[
                    'name' => 'Dogs',
                    'desc' => 'Desc dogs',
                    'parent_id' => '1'
                ],[
                    'name' => 'Horses',
                    'desc' => 'Desc horse',
                    'parent_id' => '1'
                ],[
                    'name' => 'Birds',
                    'desc' => 'Desc birds',
                    'parent_id' => '1'
                ],[
                    'name' => 'Trees',
                    'desc' => 'Desc trees',
                    'parent_id' => '2'
                ],[
                    'name' => 'Flowers',
                    'desc' => 'Desc trees',
                    'parent_id' => '2'
                ]
            ];

            $values = "";
            foreach($data as $value){
                $values .= "('$value[name]','$value[desc]',$value[parent_id]),";
            }


//            $this->db->query("INSERT INTO `categories` (`name`,`desc`,`parent_id`) VALUES ".substr($values,0,-1));

            $this->db->insert_batch('categories', $data);

        }
    }

    public function down()
    {
        //
    }
}