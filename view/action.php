<?php
include '../models/product.php';
session_start();

// Set total price of the product in the cart table
if (isset($_POST['pid'])) {

    $pid = $_POST['pid'];
    $pamount = $_POST['pamount'];


    foreach ($_SESSION['cartArr'] as $product) {
        print_r($product->amount);
        if ($product->item_id == $pid) {
            $product->amount = $pamount;
        }
    }

    //$tprice = $qty * $pprice;

    // $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
    // $stmt->bind_param('isi', $qty, $tprice, $pid);
    // $stmt->execute();
}?>

 <script type = "text/javascript">  
            alert (<?php $pamount ?>);  
            console.log(<?php $pamount ?>);  
      </script>     

   