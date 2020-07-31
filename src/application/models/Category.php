<?php


class Category extends CI_Model
{

    private $table = 'categories';

    public function get_count()
    {
        $this->db->where('parent_id','0');
        return $this->db->get($this->table)->num_rows();
    }

    public function get_categories_paginate ($limit, $start)
    {
        $categories = $this->get_parent_categories();

        if(isset($categories[$start - 1]))
        {
            return [$categories[$start - 1]];
        }

        return [];
    }
    public function get_parent_categories ()
    {
        $this->db->where('parent_id','0');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_categories ()
    {

        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function create_category(string $name, string $desc, int $parent = null)
    {
        $this->db->insert($this->table, [
            'name' => $name,
            'desc' => $desc,
            'parent_id' => $parent
        ]);
    }

    public function get_category_by_id (int $id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table)->result();
    }

    public function delete_category(int $id)
    {

        $get_children = $this->db
            ->where('parent_id', $id)
            ->get($this->table)
            ->result();

        $categories_ids = [$id];

        foreach( $get_children as $child ) {
            $categories_ids[] = $child->id;
        }

        $this->db->where_in('id', $categories_ids);
        $this->db->delete($this->table);
    }

    public function update_category(int $id, array $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table,$data);
    }

    public function createTree($data)
    {
        $parents = [];
        foreach ($data as $key => $item):
            $parents[$item->parent_id][$item->id] = $item;
        endforeach;


        $treeElem = $parents[0];
        $this->generateElemTree($treeElem, $parents);
        return $treeElem;
    }

    private function generateElemTree(&$treeElem, $parents)
    {
        foreach ($treeElem as $key => $item):
            if (!isset($item->children)):
                $treeElem[$key]->children = [];
            endif;

            if (array_key_exists($key, $parents)):
                $treeElem[$key]->children = $parents[$key];
                $this->generateElemTree($treeElem[$key]->children, $parents);
            endif;
        endforeach;
    }

    public function get_options()
    {
        $categories = $this->get_categories();

        $options = [];
        foreach ($categories as $category)
        {
            $options[$category->id] = $category->name;
        }

        return $options;
    }

}
