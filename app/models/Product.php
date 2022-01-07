<?php

use Product as GlobalProduct;

class Product
{

    private $db;
    private static $instance;

    private function __construct()
    {
        $this->db = new Database;
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Product();
        }
        return self::$instance;
    }
    public function findAllProducts(){

        $this->db->query('SELECT * FROM  products');
        $results = $this->db->resultSet();

        return $results;
    }

    public function addProduct($data){

        $this->db->query('INSERT INTO  products  (itemName,amount,price,description,seller_id,item_image) VALUES (:itemName, :amount, :price, :description, :seller_id, :item_image)');

        //Bind values
        $this->db->bind(':itemName', $data['itemName']);
        $this->db->bind(':amount', $data['amount']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':seller_id', $data['seller_id']);
        $this->db->bind(':item_image', $data['item_image']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }
    }

    public function findProductById($id) {
        
        $this->db->query('SELECT * FROM products WHERE item_id = :id');
        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    public function getProductImgNameById($id){

        $this->db->query('SELECT item_image FROM products WHERE item_id = :id');
        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    public function updateEachFeild($data){

        $item_id = $data['item_id'];

        if (!empty($data['itemName'])) {

            $this->db->query("UPDATE products SET itemName = :itemName WHERE item_id = :item_id");
            $this->db->bind(':item_id', $item_id);
            $this->db->bind(':itemName', $data['itemName']);
            $this->db->updateField();
        }

        if (!empty($data['amount'])) {

            $this->db->query("UPDATE products SET amount = :amount  WHERE item_id = :item_id");
            $this->db->bind(':item_id', $item_id);
            $this->db->bind(':amount', $data['amount']);
            $this->db->updateField();
        }

        if (!empty($data['price'])) {

            $this->db->query("UPDATE products SET price = :price WHERE item_id = :item_id");
            $this->db->bind(':item_id', $item_id);
            $this->db->bind(':price', $data['price']);
            $this->db->updateField();
        }

        $this->db->query("UPDATE products SET description = :description WHERE item_id = :item_id");
        $this->db->bind(':item_id', $item_id);
        $this->db->bind(':description', $data['description']);
        $this->db->updateField();

        if(isset($data['item_image'])){
            $this->db->query("UPDATE products SET item_image = :item_image WHERE item_id = :item_id");
            $this->db->bind(':item_id', $item_id);
            $this->db->bind(':item_image', $data['item_image']);
            $this->db->updateField();
        }
    }

    public function reduceAmount($data){
        $this->db->query("UPDATE products SET amount = :amount  WHERE item_id = :item_id");
        $this->db->bind(':item_id', $data['item_id']);
        $this->db->bind(':amount', $data['amount']);
        $this->db->updateField();
    }

    public function deleteItemById($id){

        $this->db->query('DELETE FROM products WHERE item_id = :id');
        $this->db->bind(':id', $id);

        //Execute function
        if ($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }
    }
}
