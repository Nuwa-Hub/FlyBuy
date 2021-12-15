<?php

class Product
{

    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function findAllProducts(){

        $this->db->query('SELECT * FROM  products');
        $results = $this->db->resultSet();

        return $results;
    }

    public function addProduct($data){

        $this->db->query('INSERT INTO  products  (itemName,amount,price,description,seller_id) VALUES (:itemName, :amount, :price, :description, :seller_id)');

        //Bind values
        $this->db->bind(':itemName', $data['itemName']);
        $this->db->bind(':amount', $data['amount']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':seller_id', $data['seller_id']);

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
    }
}
