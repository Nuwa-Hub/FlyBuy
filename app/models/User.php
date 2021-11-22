<?php

interface User {

    public function register($data);

    public function login($username, $password);

    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email);
}

?>