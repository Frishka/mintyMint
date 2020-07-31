<?php


class Category_controller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['category']);
        $this->checkAuth();
    }

    public function index()
    {

        $categories = $this->get_categories_with_pagination();

        $this->data["links"] = $this->pagination->create_links();

        $this->data['categories'] = $categories;

        $this->data['title'] = 'Home Page';

        $options = $this->category->get_options();
        $options[0] = 'No parent';

        $this->data['options'] = $options;

        $this->View('home/index', $this->data);
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

    public function search_category (&$categories,$needle)
    {
        foreach ($categories as $key => $category){
            if(key_exists($needle,$category->children))
            {
                return $category->children[$needle]->children;
            }
            else if($category->id == $needle)
            {
                return $category->children;
            }else{
                $this->search_category($category->children,$needle);
            }
        }
        return [];
    }

    public function show (int $id)
    {
        if(!$id)
        {
            redirect('/');
            die();
        }

        $categories = $this->category->get_categories();
        $categories = $this->category->createTree($categories);
        $children = $this->search_category($categories, $id);

        $this->data['children'] = $children;

        $this->data['category'] = $this->category->get_category_by_id($id)[0];
        $this->View('category/index', $this->data);
    }

    private function get_categories_with_pagination ()
    {
        $this->load->library('pagination');

        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $config = $this->get_pagination_config();

        $categories = $this->category->get_categories();


        if(empty($categories))
        {
            return [];
        }

        $categories = $this->category->createTree($categories);
        $total_pages = round($config['total_rows'] / $config["per_page"]);

        if($page-1 < 0 || $page > $total_pages){
            redirect('/home/1');
            die();
        }
        $this->pagination->initialize($config);

        return array_chunk($categories,$config["per_page"])[$page-1];

    }

    private function get_pagination_config()
    {
        $config['base_url'] = base_url().'/home/';
        $config['total_rows'] = $this->category->get_count();
        $config['per_page'] = 2;
        $config["uri_segment"] = 2;

        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = '';
        $config['first_tag_open'] = '';
        $config['first_tag_close'] = '';

        $config['last_link'] = '';
        $config['last_tag_open'] = '';
        $config['last_tag_close'] = '';

        $config['next_link'] = '<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '<span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        return $config;
    }
}
