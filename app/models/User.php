<?php

interface User {

    public function register($data);

    public function login($username, $password);

    public function findUserByEmail($email);

    public function findAllUsers();
    
}

?>