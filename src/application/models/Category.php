<?php


class Category extends CI_Model
{

    public function get_categories ()
    {
        $query = $this->db->get('categories')->result();
        return $query;
    }

    public function create_category(string $name, string $desc, int $parent = null)
    {
        $this->db->insert('categories', [
            'name' => $name,
            'desc' => $desc,
            'parent_id' => $parent
        ]);
    }

    public function get_category_by_id (int $id)
    {
        $this->db->where('id', $id);
        return $this->db->get('categories')->result();
    }

    public function delete_category(int $id)
    {

        $get_children = $this->db
            ->where('parent_id', $id)
            ->get('categories')
            ->result();

        $categories_ids = [$id];

        foreach( $get_children as $child ) {
            $categories_ids[] = $child->id;
        }

        $this->db->where_in('id', $categories_ids);
        $this->db->delete('categories');
    }

    public function update_category(int $id, array $data)
    {
        $this->db->where('id', $id);
        $this->db->update('categories',$data);
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
