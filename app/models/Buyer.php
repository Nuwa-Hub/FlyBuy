<?php

require_once 'User.php';

class Buyer implements User{

    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function register($data) {
        
        $data['signupData']['password'] = password_hash($data['signupData']['password'], PASSWORD_DEFAULT);

        $this->db->query('INSERT INTO buyers (username, email, telNo, address, password, vkey) VALUES(:username, :email, :telNo, :address, :password, :vkey")');

        //Bind values
        $this->db->bind(':username', $data['signupData']['username']);
        $this->db->bind(':email', $data['signupData']['email']);
        $this->db->bind(':telNo', $data['signupData']['telNo']);
        $this->db->bind(':address', $data['signupData']['address']);
        $this->db->bind(':password', $data['signupData']['password']);
        $this->db->bind(':vkey', $data['vkey']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($data) {

        $email = $data['loginData']['email'];
        $password = $data['loginData']['password'];

        $this->db->query('SELECT * FROM buyers WHERE email = :email');

        //Bind value
        $this->db->bind(':email', $email);

        $id = $this->db->single()->buy_id;
        return $id;
        // $hashedPassword = $row->password;

        // if (password_verify($password, $hashedPassword)) {
        //     return $row;
        // } else {
        //     return false;
        // }
    }

    public function findUserById($id) {
        //Prepared statement
        $this->db->query('SELECT * FROM buyers WHERE buy_id = :id');

        //Email param will be binded with the email variable
        $this->db->bind(':id', $id);

        //Check if email is already registered
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
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

    public function findAllUsers(){
        $this->db->query('SELECT * FROM buyers');
        
        $results = $this->db->resultSet();

        return $results;
    }

    public function getAllProducts(){

        $this->db->query("SELECT * FROM  products");

        $results = $this->db->resultSet();

        return $results;
    }
}

?>