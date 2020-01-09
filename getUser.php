<?php
require_once 'pdo_connect.class.php';
require_once 'Logger.class.php';


class User extends PDO_CONNECTION {

    public function getUser(){
        $this->executeQuery("SELECT * FROM users");
        return $this->fetchResults();
    }
}

$user = new User();
//echo json_encode($user->getUser());
Logging::Log($user->getUser());
