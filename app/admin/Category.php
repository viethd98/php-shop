<?php


class Category extends ControllerClass
{
    
    public function index()
    {
        $title = config('name').' - Category List';

        $data['categories'] = $this->db->query('SELECT * FROM categories');

        $this->view('admin/category-index', ['data' => $data, 'title' => $title]);
    }

   
    public function create()
    {
        $category = [
            'id' => null,
            'parent_id' => null,
            'name' => null,
            'description' => null,
        ];

        $error = false;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $validation = true;

            $category['parent_id'] = $parent_id = filter($_POST['parent_id']);
            $category['name'] = $name = filter($_POST['name']);
            $category['slug'] = $slug = toKebabCase(filter($_POST['name']));
            $category['description'] = $description = filter($_POST['description']);
            $now = date('Y-m-d H:i:s');

            if ($validation) {
                $query = $this->db->query("INSERT INTO categories (parent_id, slug, name, description, created_at, updated_at) VALUES('$parent_id', '$slug', '$name', '$description', '$now', '$now')");

                if ($query === true) {
                    redirect('admin/category?message=success');
                } else {
                    $error = $query;
                }
            }
        }

        $data['parentCategories'] = [];
        $query = $this->db->query('SELECT * FROM categories');
        if ($query) $data['parentCategories'] = $query;

        $title = config('name').' - Create Category';
        $data['title'] = 'Input Category';
        $data['category'] = $category;
        $data['submitUrl'] = baseurl('admin/category/create');
        $data['error'] = $error;

        $this->view('admin/category-form', ['data' => $data, 'title' => $title]);
    }

    
    public function edit($id = null)
    {
        $id = filter($id);
        $category = $this->db->query("SELECT * FROM categories WHERE id = '$id'");

        if ( ! $category ) {
            $this->error404();
        }
        $category = $category[0];

        $error = false;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $validation = true;

            // Assign POST Data
            $category['parent_id'] = $parent_id = filter($_POST['parent_id']);
            $category['name'] = $name = filter($_POST['name']);
            $category['slug'] = $slug = toKebabCase(filter($_POST['name']));
            $category['description'] = $description = filter($_POST['description']);
            $now = date('Y-m-d H:i:s');

            if ($validation) {
                $query = $this->db->query("UPDATE categories SET parent_id = '$parent_id', slug = '$slug', name = '$name', description = '$description', updated_at = '$now' WHERE id = '$id'");

                if ($query === true) {
                    redirect('admin/category?message=success');
                } else {
                    $error = $query;
                }
            }
        }

        $data['parentCategories'] = [];
        $query = $this->db->query('SELECT * FROM categories');
        if ($query) $data['parentCategories'] = $query;

        $title = config('name').' - Edit '.$category['name'];
        $data['title'] = 'Edit Category';
        $data['category'] = $category;
        $data['submitUrl'] = baseurl('admin/category/edit/'.$id);
        $data['error'] = $error;

        $this->view('admin/category-form', ['data' => $data, 'title' => $title]);
    }

    public function delete($id = null)
    {
        $id = filter($id);
        $result = $this->db->query("DELETE FROM categories WHERE id = '$id'");

        if ($result) {
            redirect('admin/category?message=success');
        } else {
            redirect('admin/category?message=failed');
        }
    }

}

?>