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

    public function verifyEmail($userType, $vkey){

        if ($userType == 'buyer'){
            $user = $this->buyerModel->findUserByVKey($vkey);
        }
        else{
            $user = $this->sellerModel->findUserByVKey($vkey);
        }

        if (isset($_POST['submitSendAgain'])){
            $additionalData  = ['vkey' => $vkey, 'table' => $userType];
            $email = $user->email;
            $path = URLROOT . "/PageController/emailVerified/";
            $type = 'signup';

            sendMail($email, $type, $additionalData, $path);
            header('location: ' . URLROOT . '/PageController/verifyEmail/' . $userType . '/' . $vkey);
        }

        $this->view('pages/verifyEmail');
    }

    public function emailVerified($userType, $vkey){

        if ($userType == 'buyer'){
            $this->buyerModel->verifyUser($vkey);
        }
        else{
            $this->sellerModel->verifyUser($vkey);
        }

        $this->view('pages/emailVerified');
    }

    public function forgotPassword(){

        if (isset($_POST['submit'])){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $email = $_POST['email'];
            $type = 'forgotPsw';

            $additionalData = [];
            $path = '';

            sendMail($email, $type, $additionalData, $path);
        }

        $this->view('pages/forgotPsw');
    }
}

?>