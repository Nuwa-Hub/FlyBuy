<?php

class PageController extends Controller{

    public function __construct(){
        $this->userModel = $this->model('Seller');
    }

    public function index(){
        $this->view('pages/homepage');
    }

    public function about(){
        $this->view('pages/about');
    }

    public function loginSignup(){
        $this->view('pages/loginSignup');
    }
}

?>