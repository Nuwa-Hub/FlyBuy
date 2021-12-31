<?php

class ProductController extends Controller
{

    public function __construct()
    {
        $this->productmodel = $this->model('Product');
    }

    public function addItem()
    {
        if (isset($_POST['submitAddItem'])) {

            $file = $_FILES['itemImage'];

            $_POST['item_image'] = $this->uploadProductImage($file);
            $this->productmodel->addProduct($_POST);

            $id = $_POST['seller_id'];

            header('location: ' . URLROOT . '/PageController/sellerAccount/' . $id);
        }
    }

    public function editItem()
    {

        if (isset($_POST['submitEditItem'])) {
            
            $file = $_FILES['itemImage'];

            if($file['error'] === 0){
                $this->removeProductImage($_POST['item_id']);
                $_POST['item_image'] = $this->uploadProductImage($file);
            }

            $this->productmodel->updateEachFeild($_POST);

            $id = $_POST['seller_id'];

            header('location: ' . URLROOT . '/PageController/sellerAccount/' . $id);
        }
    }

    public function removeProductImage($id){

        $imgName = $this->productmodel->getProductImgNameById($id)->item_image;
        $defaultImg = "defaultItemImage.png";

        if(strcmp($imgName, $defaultImg) !== 0){
            $imageDestination = '../public/img/uploads/itemImages/' . $imgName;
            unlink($imageDestination);
        }
    }

    public function uploadProductImage($file){

        $imgNewName = 'defaultItemImage.png';

        if($file['error'] === 0){

            $tempExt = explode('.', $file['name']);
            $imgExt = strtolower(end($tempExt));

            $imgNewName = uniqid('', true) . '.' . $imgExt;
            $imgDestination = '../public/img/uploads/itemImages/' . $imgNewName;

            move_uploaded_file($file['tmp_name'], $imgDestination);
        }

        return $imgNewName;
    }

    public function deleteItem()
    {

        if (isset($_POST['submitDeleteItem'])) {

            $item_id = $_POST['item_id'];

            $this->removeProductImage($item_id);
            $this->productmodel->deleteItemById($item_id);

            $id = $_POST['seller_id'];

            header('location: ' . URLROOT . '/PageController/sellerAccount/' . $id);
        }
    }

    public function addToCart()
    {

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
                $ar = array($item->amount, $pqty);
                $item->amount = $ar;
                array_push($_SESSION['cartarr'], $item);
                header('location: ' . URLROOT . '/PageController/buyerAccount/' . $buyer_id);
            } else {
                print_r("Already added");
                header('location: ' . URLROOT . '/PageController/buyerAccount/' . $buyer_id);
            }
        }
    }

    public function updateCart()
    {

        if (isset($_POST['pamount'])) {
            
            echo'console.log("dfsdf")';
            

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
