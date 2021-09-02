<?php 


class User {

        // Properties
        // private $id;
        private $username;
        private $password;
        private $email;
        private $type;
        public $verified;

        public function __construct($username,$password, $email, $type) {

            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
            $this->type = $type;
            $this->verified = true;
            
            return true;
        }

    }
?>