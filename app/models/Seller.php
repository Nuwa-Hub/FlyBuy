<?php

class Seller implements User{

    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function register($data) {

        $data['signupData']['password'] = password_hash($data['signupData']['password'], PASSWORD_DEFAULT);

        $this->db->query('INSERT INTO sellers (username, email, telNo, address, password, storeName, vkey) VALUES(:username, :email, :telNo, :address, :password, :storeName, :vkey)');

        //Bind values
        $this->db->bind(':username', $data['signupData']['username']);
        $this->db->bind(':email', $data['signupData']['email']);
        $this->db->bind(':telNo', $data['signupData']['telNo']);
        $this->db->bind(':address', $data['signupData']['address']);
        $this->db->bind(':password', $data['signupData']['password']);
        $this->db->bind(':storeName', $data['signupData']['storeName']);
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
        // $password = $data['loginData']['password'];

        $this->db->query('SELECT * FROM sellers WHERE email = :email');

        //Bind value
        $this->db->bind(':email', $email);
        $id = $this->db->single()->seller_id;

        return $id;
    }

    public function checkEmailExistence($email) {
        //Prepared statement
        $this->db->query('SELECT * FROM sellers WHERE email = :email');

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

    public function findUserById($id) {

        $this->db->query('SELECT * FROM sellers WHERE seller_id = :id');
        $this->db->bind(':id', $id);

        return $this->db->single();
    }
    
    public function findUserByVKey($vkey){
        //Prepared statement
        $this->db->query('SELECT * FROM sellers WHERE vkey = :vkey');

        $this->db->bind(':vkey', $vkey);

        $user = $this->db->single();

        return $user;
    }

    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM sellers WHERE email = :email');

        $this->db->bind(':email', $email);

        $user = $this->db->single();

        return $user;
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

    public function verifyUser($vkey){
        $this->db->query('UPDATE sellers SET verified = :verified WHERE vkey = :vkey');

        $this->db->bind(':verified', 1);
        $this->db->bind(':vkey', $vkey);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUserData($data){

        $vkey = $data['vkey'];
        
        if(isset($data['username']) and !empty($data['username'])){
            
            $this->db->query("UPDATE sellers SET username = :username WHERE vkey = :vkey");
            $this->db->bind(':vkey', $vkey);
            $this->db->bind(':username', $data['username']);
            $this->db->updateField();
        }

        if(isset($data['password']) and !empty($data['password'])){

            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            
            $this->db->query("UPDATE sellers SET password = :password  WHERE vkey = :vkey");
            $this->db->bind(':vkey', $vkey);
            $this->db->bind(':password', $data['password']);
            $this->db->updateField();
        }

        if(isset($data['address']) and !empty($data['address'])){
            
            $this->db->query("UPDATE sellers SET address = :address WHERE vkey = :vkey");
            $this->db->bind(':vkey', $vkey);
            $this->db->bind(':address', $data['address']);
            $this->db->updateField();
        }

        if(isset($data['telNo']) and !empty($data['telNo'])){
            
            $this->db->query("UPDATE sellers SET telNo = :telNo WHERE vkey = :vkey");
            $this->db->bind(':vkey', $vkey);
            $this->db->bind(':telNo', $data['telNo']);
            $this->db->updateField();
        }

        if(isset($data['storeName']) and !empty($data['storeName'])){
            
            $this->db->query("UPDATE sellers SET storeName = :storeName WHERE vkey = :vkey");
            $this->db->bind(':vkey', $vkey);
            $this->db->bind(':storeName', $data['storeName']);
            $this->db->updateField();
        }
    }

    public function saveNotification($buyer_id, $seller_id, $data){

        $selrialized = serialize($data);

        $this->db->query('INSERT INTO notifications (seller_id, buy_id, notification) VALUES(:seller_id, :buy_id, :notification)');

        //Bind values
        $this->db->bind(':seller_id', $seller_id);
        $this->db->bind(':buy_id', $buyer_id);
        $this->db->bind(':notification', $selrialized);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function notificationCount($id){

        $this->db->query("SELECT * FROM  notifications WHERE seller_id = '$id' AND isRead = 0");
        $results = $this->db->resultSet();
        $count = count($results);

        return $count;
    }

    public function getAllNotificationsById($id){

        $this->db->query("SELECT * FROM  notifications WHERE seller_id = '$id'");
        $results = $this->db->resultSet();

        return $results;
    }

    public function markAsReadById($id){

        $this->db->query("UPDATE notifications SET isRead = 1 WHERE notify_id = :notify_id");
        $this->db->bind(':notify_id', $id);
        
        $this->db->updateField();
    }
}

?>