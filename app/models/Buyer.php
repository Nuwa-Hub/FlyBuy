<?php

class Buyer implements User{

    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function register($data){
        
        $data['signupData']['password'] = password_hash($data['signupData']['password'], PASSWORD_DEFAULT);

        $this->db->query('INSERT INTO buyers (username, email, telNo, address, password, vkey) VALUES(:username, :email, :telNo, :address, :password, :vkey)');

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

    public function login($email, $password){

        $this->db->query('SELECT * FROM buyers WHERE email = :email');

        //Bind value
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashedPassword = $row->password;

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    //Find user by email. Email is passed in by the Controller.
    public function checkEmailExistence($email){
        //Prepared statement
        $this->db->query('SELECT * FROM buyers WHERE email = :email');

        //Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        $resultSet = $this->db->resultSet();

        //Check if email is already registered
        if(count($resultSet) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findUserByVKey($vkey){
        //Prepared statement
        $this->db->query('SELECT * FROM buyers WHERE vkey = :vkey');

        $this->db->bind(':vkey', $vkey);

        $user = $this->db->single();

        return $user;
    }

    public function findAllUsers(){
        $this->db->query('SELECT * FROM buyers');
        
        $results = $this->db->resultSet();

        return $results;
    }

    public function verifyUser($vkey){
        $this->db->query('UPDATE buyers SET verified = :verified WHERE vkey = :vkey');

        $this->db->bind(':verified', 1);
        $this->db->bind(':vkey', $vkey);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>