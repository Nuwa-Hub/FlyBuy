<?php

class PageController extends Controller{

    public function __construct(){
        $this->productModel = $this->model('Product');
        $this->buyerModel = $this->model('Buyer');
        $this->sellerModel = $this->model('Seller');
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

    public function buyerAccount($id){

        $data = [
            'buyer_id' => $id,
            'user' => $this->buyerModel->findUserById($id),
            'products' => $this->buyerModel->getAllProducts($id)
        ];
        print_r($data);
        // $this->view('pages/buyerAccount', $data);
    }

    public function sellerAccount($id){

        $data = [
            'seller_id' => $id,
            'user' => $this->sellerModel->findUserById($id),
            'products' => $this->sellerModel->findAllSellerProducts($id)
        ];
        print_r($data);
        // $this->view('pages/sellerAccount', $data);
    }
}

?>