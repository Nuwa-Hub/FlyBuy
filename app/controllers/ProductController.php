<?php 

class ProductController extends Controller{

    public function __construct(){}

    public function addItem(){
        print_r($_POST);
    }

    public function editItem(){
        
        if(isset($_POST['submitEditItem'])){

            $this->seller = $this->model('Product');
            $this->seller->updateEachFeild($_POST);

            $id = $_POST['seller_id'];

            header('location: ' . URLROOT . '/PageController/sellerAccount/' . $id);
        }
    }
}

?>