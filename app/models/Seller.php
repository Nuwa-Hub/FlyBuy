<?php

require_once 'User.php';

class Seller implements User{

    private $db;

    public function __construct(){
        
        $this->db = new Database;
    }

    public function register($data) {

        $this->db->query('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');

        //Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($data) {

        $email = $data['loginData']['email'];
        // $password = $data['loginData']['password'];

        $this->db->query('SELECT * FROM sellers WHERE email = :email');

        //Bind value
        $this->db->bind(':email', $email);
        $id = $this->db->single()->seller_id;

        return $id;
    }

    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email) {
        //Prepared statement
        $this->db->query('SELECT * FROM users WHERE email = :email');

        //Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        //Check if email is already registered
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findUserById($id) {

        $this->db->query('SELECT * FROM sellers WHERE seller_id = :id');
        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    public function findAllUsers(){

        $this->db->query('SELECT * FROM sellers');
        $results = $this->db->resultSet();

        return $results;
    }

    public function findAllSellerProducts($seller_id){

        $this->db->query("SELECT * FROM  products WHERE seller_id = '$seller_id'");
        $results = $this->db->resultSet();

        return $results;
    }
}

?>