<?php

interface User {

    public function register($data);

    public function login($username, $password);

    public function checkEmailExistence($email);

    public function findUserByVKey($vkey);

    public function findUserByEmail($email);

    public function findAllUsers();

    public function verifyUser($vkey);

    public function updateUserData($data);
    
}

?>