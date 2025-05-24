<?php

include 'app/policy/userPolicy.php';

class productController extends controller
{
    use userPolicy;

    public function show_products()
    {
        include 'app/model/product.php';

        $new_product = new product();
        $products = $new_product->getProducts();

        // Example : controller::nav() can be used here
        // $this->nav('header');
        $this->view('productsList', ['product' => $products]);
    }

    public function showProduct($slug)
    {
        if (!$this->is_admin())
        {
            return var_dump("Access Denied");
        }
        echo $slug;
    }
}
