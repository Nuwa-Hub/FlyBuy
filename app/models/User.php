<?php

interface User {

    public function register($data);

    public function login($username, $password);

    public function checkEmailExistence($email);

    public function findUserByVKey($vkey);

    public function findAllUsers();

    public function verifyUser($vkey);
    
}

?>