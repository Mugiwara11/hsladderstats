<?php
use App\Libs\ModelsInterface;
use App\Libs\DatabaseConnector;

class Usuarios implements ModelsInterface
{
    public $db;

    public function __construct() {
        $this->db = DatabaseConnector::connect();
    }

    public function saveUser($username, $token) {
        echo 'salvo el usuario';
    }
}
