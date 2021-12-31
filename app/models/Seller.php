<?php

class Seller implements User{

    private $db;
    private static $instance;

    private function __construct()
    {
        $this->db = new Database;
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Seller();
        }
        return self::$instance;
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

    public function getProfilePicNameById($id){

        $this->db->query("SELECT profilePic FROM sellers WHERE seller_id = :id");
        $this->db->bind(':id', $id);

        $profilePicName = $this->db->single();

        return $profilePicName;
    }

    public function updateProfilePicName($id, $newImgName){

        $this->db->query("UPDATE sellers SET profilePic = :profilePic WHERE seller_id = :id");

        $this->db->bind(':id', $id);
        $this->db->bind(':profilePic', $newImgName);
        
        $this->db->updateField();
    }

    public function saveNotification($buyer_id, $seller_id, $data){

        $order_price = $data['order_price'];
        unset($data['order_price']);

        $selrialized = serialize($data);

        $this->db->query('INSERT INTO notifications (seller_id, buy_id, item_list, order_price) VALUES(:seller_id, :buy_id, :item_list, :order_price)');

        //Bind values
        $this->db->bind(':seller_id', $seller_id);
        $this->db->bind(':buy_id', $buyer_id);
        $this->db->bind(':item_list', $selrialized);
        $this->db->bind(':order_price', $order_price);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function notificationCount($id){

        $this->db->query("SELECT * FROM  notifications WHERE seller_id = '$id' AND marked = 0");
        $results = $this->db->resultSet();
        $count = count($results);

        return $count;
    }

    public function getSalesHistoryById($id){

        $this->db->query("SELECT 
                        YEAR(created_at) as yr, 
                        COUNT(*) as year_order_count, 
                        SUM(order_price) as year_income
                        FROM `notifications` 
                        WHERE seller_id = '$id' AND marked = 1 
                        GROUP BY yr");
        $resultsY = $this->db->resultSet();

        $this->db->query("SELECT 
                        CONCAT(YEAR(created_at),'-',MONTHNAME(created_at)) as ym ,
                        COUNT(*) as month_order_count,
                        SUM(order_price) as month_income
                        FROM `notifications` 
                        WHERE seller_id = '$id' AND marked = 1 
                        GROUP BY ym");
        $resultsYM = $this->db->resultSet();

        $data = [
            'salesByYear' => $resultsY,
            'salesByYearMonth' => $resultsYM
        ];

        return $data;
    }

    public function getAllNotificationsById($id, $type){

        switch ($type) {
            case 'all':
                $this->db->query("SELECT * FROM  notifications WHERE seller_id = '$id'");
                break;

            case 'marked':
                $this->db->query("SELECT * FROM  notifications WHERE seller_id = '$id' AND marked = 1");
                break;

            case 'unmarked':
                $this->db->query("SELECT * FROM  notifications WHERE seller_id = '$id' AND marked = 0");
                break;
            
            default:
                break;
        }

        $results = $this->db->resultSet();

        return $results;
    }

    public function markNotificationById($id){

        $this->db->query("UPDATE notifications SET marked = 1 WHERE notify_id = :notify_id");
        $this->db->bind(':notify_id', $id);
        
        $this->db->updateField();
    }
}

?>