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

        $loginClassNames = [
            'email' => '',
            'password' => ''
        ];

        $signupClassNames = [
            'username' => '',
            'email' => '',
            'tel' => '',
            'address' => '',
            'password' => '',
            'storeName' => ''
        ];

        $loginData = [
            'email' => '',
            'password' => ''
        ];

        $signupData = [
            'username' => '',
            'email' => '',
            'tel' => '',
            'address' => '',
            'password' => '',
            'storeName' => ''
        ];

        $data = [
            'loginClassNames' => $loginClassNames,
            'loginData' => $loginData,
            'signupClassNames' => $signupClassNames,
            'signupData' => $signupData
        ];

        $this->view('pages/loginSignup', $data);
    }
}

?>