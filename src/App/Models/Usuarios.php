<?php
use Libs\ModelsInterface;
use Libs\DatabaseConnector;

class Usuarios implements ModelsInterface
{
    public $db;

    public function __construct() {
        $this->db = DatabaseConnector::connect();
    }

    public function getAllUsuarios() {
        $gsent = $this->db->prepare("SELECT * FROM usuarios");
        $gsent->execute();
        return $gsent->fetchAll();
    }

    public function saveUser($username, $token) {
        echo 'salvo el usuario';
    }
}
