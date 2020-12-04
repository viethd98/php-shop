<?php


class Cart extends ControllerClass
{
   
    public function index()
    {
        $userId = getSession('user_id', randomString(5));
        $now = date('Y-m-d H:i:s');

        
        $carts = $this->db->query("SELECT carts.*, cart_products.* FROM carts JOIN cart_products ON carts.id = cart_products.cart_id WHERE carts.user_id = '$userId'");

        
        $productIds = implode(', ', pluck($carts, 'product_id'));
        $products = $this->db->query("SELECT id, price, quantity FROM products WHERE id IN ($productIds)");
        $products = keyBy($products, 'id');

        $totalPrice = 0;
        foreach ($carts as $key => $cart) {
            $productId = $cart['product_id'];
            $cart['total_item_price'] = $products[$productId]['price'] * $cart['quantity'];
            $cart['max_qty'] = $products[$productId]['quantity'];
            $carts[$key] = $cart;
            $totalPrice += $cart['total_item_price'];
        }

        $title = config('name').' - Cart List';
        $data['carts'] = $carts;
        $data['total_price'] = $totalPrice;

        $this->view('cart', ['data' => $data, 'title' => $title]);
    }

    public function process()
    {
        
        header('Content-Type: application/json');

        $status = true;
        $response = 'OK';
        $userId = getSession('user_id', randomString(5));
        $now = date('Y-m-d H:i:s');

      
        $cartProductIds = [];
        $carts = $this->db->query("SELECT * FROM carts WHERE user_id = '$userId'");

        if (count($carts) > 0) {
            $cartId = $carts[0]['id'];
            $cartProducts = $this->db->query("SELECT * FROM cart_products WHERE cart_id = '$cartId'");
            $cartProductIds = pluck($cartProducts, 'product_id');
            $cartProductsKeyId = keyBy($cartProducts, 'product_id');
        } else {
            $sql = "INSERT INTO carts (user_id, created_at, updated_at) VALUES('$userId', '$now', '$now')";
            $query = $this->db->query($sql, true);
            $cartId = $query->insert_id;
        }
        

        
        if (isset($_POST['product_id'])) {

            
            $bulkInsertCarts = $bulkUpdateCarts = $bulkDeleteCarts = [];

           
            $quantities = $_POST['qty'] ?? [1];
            if ( ! is_array($quantities) ) $quantities = [$quantities];

            
            $methods = $_POST['method'] ?? [];
            if ( ! is_array($methods) ) $methods = [$methods];

            
            $postProductIds = $_POST['product_id'];

            if (is_array($postProductIds)) {
                
                foreach ($postProductIds as $key => $idProduct) {
                    $postProductIds[$key] = filter($idProduct);
                }
                $sql = "WHERE products.id IN (".implode(', ', $postProductIds).")";
            } else {
                $postProductIds = filter($postProductIds);
                $sql = "WHERE products.id = '$postProductIds'";
            }

            $sql = "SELECT products.*, categories.name AS category_name FROM products LEFT JOIN categories ON products.category_id = categories.id $sql";
            $products = $this->db->query($sql);
            $products = keyBy($products, 'id');
            

           
            foreach ($methods as $key => $method) {

               
                $idProduct = $postProductIds[$key];
                $product = $products[$idProduct];

               
                $qty = intval($quantities[$key]);
                if ( $qty < 1 ) $qty = 1;

                if ($method == 'add') {
                    $prevQty = isset($cartProductsKeyId[$idProduct]['quantity']) ? intval($cartProductsKeyId[$idProduct]['quantity']) : 0;
                    $qty = $prevQty + $qty;
                }

                if ( $qty > $product['quantity'] ) $qty = $product['quantity'];
                if ( $qty < 1) $method = 'delete';

              
                switch ($method) {
                    case 'delete':
                        $bulkDeleteCarts[] = $idProduct;
                        break;
                    case 'add':
                    case 'update':
                    default:
                        if ( ! in_array($idProduct, $cartProductIds) ) {
                            
                            $bulkInsertCarts[] = "('$cartId', '$product[id]', '$product[category_id]', '$product[category_name]', '$product[name]', '$product[description]', '$product[price]', '$product[images]', '$qty', '$now', '$now')";
                        } else {
                            
                            $bulks = [];
                            $bulks['product_id'] = $idProduct;
                            $bulks['case_category_id'] = "WHEN product_id = '$idProduct' THEN '$product[category_id]'";
                            $bulks['case_category_name'] = "WHEN product_id = '$idProduct' THEN '$product[category_name]'";
                            $bulks['case_name'] = "WHEN product_id = '$idProduct' THEN '$product[name]'";
                            $bulks['case_description'] = "WHEN product_id = '$idProduct' THEN '$product[description]'";
                            $bulks['case_price'] = "WHEN product_id = '$idProduct' THEN '$product[price]'";
                            $bulks['case_images'] = "WHEN product_id = '$idProduct' THEN '$product[images]'";
                            $bulks['case_quantity'] = "WHEN product_id = '$idProduct' THEN '$qty'";
                            $bulkUpdateCarts[] = $bulks;
                        }
                        break;
                }

            }

           
            if (count($bulkInsertCarts) > 0) {

                $bulkInsertCarts = implode(', ', $bulkInsertCarts);

                $sql = "INSERT INTO cart_products (cart_id, product_id, category_id, category_name, name, description, price, images, quantity, created_at, updated_at)  VALUES $bulkInsertCarts";

                $this->db->query($sql);
            }

           
            if (count($bulkUpdateCarts) > 0) {

                $bulkProductIds = implode(', ', pluck($bulkUpdateCarts, 'product_id'));
                $caseCategoryId = implode(' ', pluck($bulkUpdateCarts, 'case_category_id'));
                $caseCategoryName = implode(' ', pluck($bulkUpdateCarts, 'case_category_name'));
                $caseName = implode(' ', pluck($bulkUpdateCarts, 'case_name'));
                $caseDescription = implode(' ', pluck($bulkUpdateCarts, 'case_description'));
                $casePrice = implode(' ', pluck($bulkUpdateCarts, 'case_price'));
                $caseImages = implode(' ', pluck($bulkUpdateCarts, 'case_images'));
                $caseQuantity = implode(' ', pluck($bulkUpdateCarts, 'case_quantity'));

                $sql = "UPDATE cart_products SET
                    category_id = (CASE $caseCategoryId END),
                    category_name = (CASE $caseCategoryName END),
                    name = (CASE $caseName END),
                    description = (CASE $caseDescription END),
                    price = (CASE $casePrice END),
                    images = (CASE $caseImages END),
                    quantity = (CASE $caseQuantity END),
                    updated_at = '$now'
                WHERE cart_id = '$cartId' AND product_id IN ($bulkProductIds)";

                
                $sql = trim(preg_replace("/\s\s+/", " ", $sql));

                $this->db->query($sql);
            }

          
            if (count($bulkDeleteCarts) > 0) {

                $bulkDeleteCarts = implode(', ', $bulkDeleteCarts);

                $sql = "DELETE FROM cart_products WHERE cart_id = '$cartId' AND product_id IN ($bulkDeleteCarts)";

                $this->db->query($sql);
            }

        }
        

       
        echo json_encode([
            'status' => $status,
            'response' => $response,
            'redirect' => baseurl('cart'),
        ]);
    }

   
    public function checkout()
    {
        $userId = getSession('user_id', randomString(5));
        $now = date('Y-m-d H:i:s');

        
        $name = isset($_POST['name']) ? filter($_POST['name']) : null;
        $address = isset($_POST['address']) ? filter($_POST['address']) : null;

        
        $carts = $this->db->query("SELECT carts.*, cart_products.* FROM carts JOIN cart_products ON carts.id = cart_products.cart_id WHERE carts.user_id = '$userId'");

        if (count($carts) > 0 && $name && $address) {

           
            $productIds = implode(', ', pluck($carts, 'product_id'));
            $sql = "SELECT products.*, categories.name AS category_name FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE products.quantity > 0 AND products.id IN ($productIds)";
            $products = $this->db->query($sql);
            $products = keyBy($products, 'id');

            
            if (count($carts) == count($products)) {

              
                $sql = "INSERT INTO orders (user_id, name, address, created_at, updated_at) VALUES('$userId', '$name', '$address', '$now', '$now')";
                $query = $this->db->query($sql, true);
                $orderId = $query->insert_id;

              
                $bulkInsertOrders = $bulkUpdateProducts = [];
                $totalPrice = 0;
                foreach ($carts as $cart) {
                    $idProduct = $cart['product_id'];
                    $product = $products[$idProduct];
                    $qtyLeft = $product['quantity'] - $cart['quantity'];
                    $totalPrice += ( $product['price'] * $cart['quantity'] );

                    
                    $bulkInsertOrders[] = "('$orderId', '$idProduct', '$product[category_id]', '$product[category_name]', '$product[name]', '$product[description]', '$product[price]', '$product[images]', '$cart[quantity]', '$now', '$now')";

                    
                    $bulks = [];
                    $bulks['id'] = $idProduct;
                    $bulks['case'] = "WHEN id = '$idProduct' THEN '$qtyLeft'";
                    $bulkUpdateProducts[] = $bulks;
                }

              
                $bulkInsertOrders = implode(', ', $bulkInsertOrders);
                $sql = "INSERT INTO order_products (order_id, product_id, category_id, category_name, name, description, price, images, quantity, created_at, updated_at) VALUES $bulkInsertOrders";
                $this->db->query($sql);

               
                $sql = "UPDATE orders SET total_price = '$totalPrice' WHERE id = '$orderId'";
                $this->db->query($sql);

               
                $productIds = implode(', ', pluck($bulkUpdateProducts, 'id'));
                $qtyCases = implode(' ', pluck($bulkUpdateProducts, 'case'));
                $sql = "UPDATE products SET quantity = (CASE $qtyCases END) WHERE id IN ($productIds)";
                $this->db->query($sql);

                
                $cartId = $carts[0]['cart_id'];
                $sql = "DELETE FROM carts WHERE id = '$cartId'";
                $this->db->query($sql);
                $sql = "DELETE FROM cart_products WHERE cart_id = '$cartId'";
                $this->db->query($sql);

                
                $this->view('checkout-success');
            }
        } else {

           
            redirect('/');
        }
    }

}

?>