<?php

class ProductController extends Controller{

    public function __construct(){
        $this->productmodel = $this->model('Product');
    }

    public function addItem(){

        if(isset($_POST['submitAddItem'])){

            $this->product = $this->model('Product');
            $this->product->addProduct($_POST);

            $id = $_POST['seller_id'];
            
            header('location: ' . URLROOT . '/PageController/sellerAccount/' . $id);
        }
    }

    public function editItem(){

        if (isset($_POST['submitEditItem'])) {

            $this->product = $this->model('Product');
            $this->product->updateEachFeild($_POST);

            $id = $_POST['seller_id'];

            header('location: ' . URLROOT . '/PageController/sellerAccount/' . $id);
        }
    }

    public function addToCart(){

        if (isset($_POST['addTocart'])) {
            $item = true;
            $pid = $_POST['pid'];
            $pqty = $_POST['pqty'];
            $buyer_id = $_POST['buyer_id'];
            
            foreach ($_SESSION['cartarr'] as $product) {

                if ($product->item_id == $pid) {
                    $item = false;
                }
            }
            
            if ($item) {
                $item = $this->productmodel->findProductById($pid);
                $ar=array( $item->amount,$pqty);
                $item->amount = $ar;
                array_push($_SESSION['cartarr'], $item);
                header('location: ' . URLROOT . '/PageController/buyerAccount/' . $buyer_id);
            } else {
                print_r("Already added");
                header('location: ' . URLROOT . '/PageController/buyerAccount/' . $buyer_id);
            }
        }
    }

    public function removeFromCart(){
        
        if (isset($_POST['pamount'])) {

            $pid = $_POST['pid'];
            $pamount = $_POST['pamount'];


            foreach ($_SESSION['cartarr'] as $product) {
                if ($product->item_id == $pid) {
                    $product->amount[1] = $pamount;
                }
            }
        }

        //for delete the cart item when click the remove utton
        if (isset($_POST['ppid'])) {
            $ppid = $_POST['ppid'];
            foreach ($_SESSION['cartarr'] as $product) {

                if (($key = array_search($product, $_SESSION['cartarr'])) !== false && $product->item_id == $ppid) {
                    unset($_SESSION['cartarr'][$key]);
                }
            }
        }

        // Get no.of items available in the cart table
        if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
            echo sizeof($_SESSION['cartarr']);
        }
    }
}
