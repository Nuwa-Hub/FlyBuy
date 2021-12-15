<?php 

class ProductController extends Controller{

    public function __construct(){}

    public function addItem(){

        if(isset($_POST['submitAddItem'])){

            $this->product = $this->model('Product');
            $this->product->addProduct($_POST);

            $id = $_POST['seller_id'];
            
            header('location: ' . URLROOT . '/PageController/sellerAccount/' . $id);
        }
    }

    public function editItem(){
        
        if(isset($_POST['submitEditItem'])){

            $this->product = $this->model('Product');
            $this->product->updateEachFeild($_POST);

            $id = $_POST['seller_id'];

            header('location: ' . URLROOT . '/PageController/sellerAccount/' . $id);
        }
    }
}

?>