<?php

class PageController extends Controller{

    public function __construct(){
        $this->productModel = $this->model('Product');
    }

    public function index(){
        $allProducts = $this->productModel->findAllProducts();

        $data = [
            'products' => $allProducts
        ];

        $this->view('pages/homepage', $data);
    }

    public function loginSignup(){
        $this->view('pages/loginSignup');
    }
}

?>