<?php


class Home extends ControllerClass
{
   
    public function index()
    {
        if (getSession('fix_image') == null) {
            setSession('fix_image', '1');
            $this->fixImage();
        }

        $data['products'] = $this->db->query("SELECT products.*, categories.name AS category_name FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE products.quantity > 0");

        $this->view('home', ['data' => $data]);
    }

   
    public function fixImage()
    {
        $cleanFiles = isset($_GET['clean']) ? true : false;
        $usedFiles = [];
        $directory = getcwd().'\public\images\products\\';

        $prevProducts = $this->db->query("SELECT id, images FROM products WHERE images <> ''");
        $productIds = [];
        $sqlCase = "";

        foreach ($prevProducts as $key => $product) {

            $prevLinks = json_decode($product['images']);
            $newLinks = [];

            foreach ($prevLinks as $link) {
               
                $filename = array_values( array_slice( explode('/', $link), -1) )[0];
                $newLinks[] = baseurl('public/images/products/').$filename;

                $usedFiles[] = $filename;
            }

            $productIds[] = $product['id'];
            $newLinks = json_encode($newLinks);
            $sqlCase .= "WHEN id = '$product[id]' THEN '$newLinks'";

        }

        if (count($productIds) > 0) {

            $productIds = implode(', ', $productIds);
            $sql = "UPDATE products SET images = (CASE $sqlCase END) WHERE id IN ($productIds)";
            $this->db->query($sql);

        }

        if ($cleanFiles) {

            $files = scandir($directory);
            $usedFiles = array_merge($usedFiles, ['.', '..']);

            foreach ($files as $file) {
                if ( ! in_array($file, $usedFiles) ) {
                    unlink($directory.$file);
                }
            }

        }

        redirect('/');
    }

}

?>