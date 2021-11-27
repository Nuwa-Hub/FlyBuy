<?php

interface User {

    public function register($data);

    public function login($data);

    public function findUserByEmail($email);

    public function findUserById($id);

    public function findAllUsers();

    // public function findAllSellerProducts($id = '');
    
}

?>