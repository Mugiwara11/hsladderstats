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

    public function updateOverall($usuario_id, $wins, $losses, $total) {
        $statement = $this->db->prepare("UPDATE usuarios SET wins = :wins, losses = :losses, total = :total WHERE id = :usuario_id");
        $values = array(
            "usuario_id" => $usuario_id,
            "wins" => $wins,
            "losses" => $losses,
            "total" => $total,
        );
        return $statement->execute($values);
    }

    public function userHasPreviousDataTotals($usuario_id) {
        $statement = $this->db->prepare("SELECT COUNT(*) FROM stats_totales WHERE usuarios_id = :usuario_id");
        $statement->execute(array('usuario_id' => $usuario_id));
        return $statement->fetchColumn() == 9;
    }


    public function userHasPreviousDataVsClase($usuario_id, $clase_id) {
        $statement = $this->db->prepare("SELECT COUNT(*) FROM stats_vs_clases WHERE usuarios_id = :usuario_id AND clases_id = :clase_id");
        $statement->execute(array('usuario_id' => $usuario_id, 'clase_id' => $clase_id));
        return $statement->fetchColumn() == 9;
    }
}
