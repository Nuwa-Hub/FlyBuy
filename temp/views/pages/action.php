<?php
include '../models/product.php';
session_start();

// Set total price of the product in the cart table
if (isset($_POST['pamount'])) {

    $pid = $_POST['pid'];
    $pamount = $_POST['pamount'];


    foreach ($_SESSION['cartarr'] as $product) {
        if ($product->item_id == $pid) {
            $product->amount = $pamount;
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
