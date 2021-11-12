<?php

class Product{

    //properties
    private $id;
    private $itemName;
    private $amount;
    private $price;
    private $description;
    private $seller_id;

    public function __construct($itemName,$amount, $price, $description, $seller_id) {

        $this->itemName = $itemName;
        $this->amount = $amount;
        $this->price = $price;
        $this->description = $description;
        $this->seller_id = $seller_id;
        
        return true;
    }

    public function saveProduct(){
        $sql = "INSERT INTO  products  (itemName,amount,price,description,seller_id) VALUES ('$this->itemName','$this->amount','$this->price','$this->description', '$this->seller_id')";
        return $sql;
    }
}

?>