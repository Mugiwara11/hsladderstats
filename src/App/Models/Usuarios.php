<?php
namespace Models;

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
        $statemet = $this->db->prepare("INSERT INTO usuarios (username , token) VALUES ('".$username."','".$token."')");
        $statemet->execute();
        $statemet = $this->db->prepare("INSERT INTO stats_totales (token_usuario) VALUES ('".$token."')");
        $statemet->execute();
    }
}
