<?php


class Category_controller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['category']);
        $this->checkAuth();
    }

    public function add()
    {
        $data = $this->input->post();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('category_name', 'Name', 'required|is_unique[categories.name]', [
            'required' => 'Category name is required.',
            'is_unique[categories.name]' => 'Category name must be unique.',
        ]);
        $this->form_validation->set_rules('parent_id', 'Parent', 'required', [
            'required' => 'Parent category is required'
        ]);


        if ($this->form_validation->run() == TRUE)
        {
            $this->category->create_category($data['category_name'],$data['category_desc'],$data['parent_id']);
        }

        redirect('/');
    }

    public function delete ()
    {
        $id = $this->input->post('id');
        if($id)
        {

            $this->category->delete_category($id);
        }
        redirect('/');
    }

    public function edit ()
    {
        $post = $this->input->post();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('category_name', 'Name', 'required', [
            'required' => 'Category name is required.',
        ]);
        $this->form_validation->set_rules('category_desc', 'Desc', 'required', [
            'required' => 'Category description is required.',
        ]);
        $this->form_validation->set_rules('parent_id', 'Parent', 'required', [
            'required' => 'Parent category is required'
        ]);

        $data = [
            'name' => $post['category_name'],
            'desc' => $post['category_desc'],
            'parent_id' => $post['parent_id'],
        ];
        $id = $post['id'];
        $this->category->update_category($id,$data);

        redirect('/');
    }

    public function show (int $id)
    {
        if(!$id)
        {
            redirect('/');
            die();
        }

        $this->data['category'] = $this->category->get_category_by_id($id)[0];
        $this->View('category/index', $this->data);
    }
}
