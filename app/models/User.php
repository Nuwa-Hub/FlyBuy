<?php

interface User {

    public function register($data);

    public function login($data);

    public function checkEmailExistence($email);

    public function findUserByVKey($vkey);

    public function findUserByEmail($email);

    public function findUserById($id);

    public function findAllUsers();

    public function verifyUser($vkey);

    public function updateUserData($data);
    
}

?>