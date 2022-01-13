<?php

class Buyer implements User
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
            self::$instance = new Buyer();
        }
        return self::$instance;
    }

    public function register($data)
    {

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

    public function login($data)
    {

        $email = $data['loginData']['email'];
        // $password = $data['loginData']['password'];

        $this->db->query('SELECT * FROM buyers WHERE email = :email LIMIT 1');
        $this->db->bind(':email', $email);
        $id = $this->db->single()->buy_id;

        return $id;
    }

    public function findUserById($id)
    {

        $this->db->query('SELECT * FROM buyers WHERE buy_id = :id');
        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    //Find user by email. Email is passed in by the Controller.
    public function checkEmailExistence($email)
    {
        //Prepared statement
        $this->db->query('SELECT * FROM buyers WHERE email = :email');

        //Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        $resultSet = $this->db->resultSet();

        //Check if email is already registered
        if (count($resultSet) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findUserByVKey($vkey)
    {
        //Prepared statement
        $this->db->query('SELECT * FROM buyers WHERE vkey = :vkey LIMIT 1');

        $this->db->bind(':vkey', $vkey);

        $user = $this->db->single();

        return $user;
    }

    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM buyers WHERE email = :email LIMIT 1');

        $this->db->bind(':email', $email);

        $user = $this->db->single();

        return $user;
    }

    public function findAllUsers()
    {

        $this->db->query('SELECT * FROM buyers');
        $results = $this->db->resultSet();

        return $results;
    }

    public function verifyUser($vkey)
    {

        $this->db->query('UPDATE buyers SET verified = :verified WHERE vkey = :vkey');

        $this->db->bind(':verified', 1);
        $this->db->bind(':vkey', $vkey);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUserData($data)
    {

        $vkey = $data['vkey'];

        if (isset($data['username']) and !empty($data['username'])) {

            $this->db->query("UPDATE buyers SET username = :username WHERE vkey = :vkey");
            $this->db->bind(':vkey', $vkey);
            $this->db->bind(':username', $data['username']);
            $this->db->updateField();
        }

        if (isset($data['password']) and !empty($data['password'])) {

            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            $this->db->query("UPDATE buyers SET password = :password  WHERE vkey = :vkey");
            $this->db->bind(':vkey', $vkey);
            $this->db->bind(':password', $data['password']);
            $this->db->updateField();
        }

        if (isset($data['address']) and !empty($data['address'])) {

            $this->db->query("UPDATE buyers SET address = :address WHERE vkey = :vkey");
            $this->db->bind(':vkey', $vkey);
            $this->db->bind(':address', $data['address']);
            $this->db->updateField();
        }

        if (isset($data['telNo']) and !empty($data['telNo'])) {

            $this->db->query("UPDATE buyers SET telNo = :telNo WHERE vkey = :vkey");
            $this->db->bind(':vkey', $vkey);
            $this->db->bind(':telNo', $data['telNo']);
            $this->db->updateField();
        }
    }

    public function getProfilePicNameById($id){

        $this->db->query("SELECT profilePic FROM buyers WHERE buy_id = :id");
        $this->db->bind(':id', $id);

        $profilePicName = $this->db->single();

        return $profilePicName;
    }

    public function updateProfilePicName($id, $newImgName){

        $this->db->query("UPDATE buyers SET profilePic = :profilePic WHERE buy_id = :id");

        $this->db->bind(':id', $id);
        $this->db->bind(':profilePic', $newImgName);
        
        $this->db->updateField();
    }

    public function saveCart($id, $data)
    {

        $selrialized = serialize($data);

        $this->db->query('INSERT INTO carts (buy_id, cart) VALUES(:buy_id, :cart)');

        //Bind values
        $this->db->bind(':buy_id', $id);
        $this->db->bind(':cart', $selrialized);

        //Execute function
        if ($this->db->execute()) {

            $lastID=$this->db->lastInsertID();
            $_SESSION['last_id']=$lastID;
            return true;
        } else {
            return false;
        }
    }

    public function updateTempRating($seller_id, $rating){
     
        $this->db->query('SELECT * FROM temp_rating WHERE seller_id = :seller_id');
        $this->db->bind(':seller_id', $seller_id);

        $tempRating_arr = $this->db->resultSet(); //this returns a single object, hence error(uncountable)!

        if(count($tempRating_arr) === 0){

            $this->db->query('INSERT INTO temp_rating (seller_id, tempRating_sum, tempRating_count) VALUES(:seller_id, :tempRating_sum, :tempRating_count)');

            //Bind values
            $this->db->bind(':seller_id', $seller_id);
            $this->db->bind(':tempRating_sum', $rating);
            $this->db->bind(':tempRating_count', 1);
        }
        else{

            $cur_sum = $tempRating_arr[0]->tempRating_sum;
            $cur_count = $tempRating_arr[0]->tempRating_count;

            $this->db->query("UPDATE temp_rating SET tempRating_sum = :tempRating_sum, tempRating_count = :tempRating_count WHERE seller_id = :seller_id");
            $this->db->bind(':tempRating_sum', $cur_sum + $rating);
            $this->db->bind(':tempRating_count', $cur_count + 1);
            $this->db->bind(':seller_id', $seller_id);
        }

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllCartsById($id){

        $this->db->query("SELECT * FROM carts WHERE buy_id = :id");
        $this->db->bind(':id', $id);

        $results = $this->db->resultSet();

        return $results;
    }

    public function clearUserFields($id){

        $this->db->query("UPDATE buyers SET email = :email WHERE buy_id = :id");

        $this->db->bind(':id', $id);
        $this->db->bind(':email', '');

        $this->db->execute();
    }
}
