<?php
include '../models/product.php';
session_start();

$_SESSION['cartArr']=array();
array_push($_SESSION['cartArr'],new Product('Carrot', 12, 123, 'sdfdf', 11, '../images/user.png',12,1));
array_push($_SESSION['cartArr'],new Product('Carrot', 12, 123, 'sdfdf', 11, '../images/user.png',11,2));
array_push($_SESSION['cartArr'],new Product('Carrot', 12, 123, 'sdfdf', 11, '../images/user.png',4,3));
array_push($_SESSION['cartArr'],new Product('Carrot', 12, 123, 'sdfdf', 11, '../images/user.png',5,4));
array_push($_SESSION['cartArr'],new Product('Carrot', 12, 123, 'sdfdf', 11, '../images/user.png',4,5));


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="shopping_cart.php">Visit Cart!</a>
</body>
</html>