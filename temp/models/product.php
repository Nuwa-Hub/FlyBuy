<?php

class Product{

    //properties
    private $id;
    public $itemName;
    public $amount;
    public $price;
    public $description;
    public $seller_id;
    public $image;
    public $maxAmount;
    public $item_id;

    public function __construct($itemName,$amount, $price, $description, $seller_id,$image,$maxAmount,$item_id) {

        $this->itemName = $itemName;
        $this->amount = $amount;
        $this->price = $price;
        $this->description = $description;
        $this->seller_id = $seller_id;
        $this->image=$image;
        $this->maxAmount=$maxAmount;
        $this->item_id=$item_id;
        
        return true;
    }

    public function saveProduct(){
        $sql = "INSERT INTO  products  (itemName,amount,price,description,seller_id) VALUES ('$this->itemName','$this->amount','$this->price','$this->description', '$this->seller_id')";
        return $sql;
    }
}

?>