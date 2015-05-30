<?php
namespace Models;

use Libs\ModelsInterface;
use Libs\DatabaseConnector;

class Clases implements ModelsInterface
{
	public $db;
    public $clases;

	public function __construct(){
        $this->db = DatabaseConnector::connect();
        $this->clases = $this->getAllClases();
	}

    public function getAllClases() {
        $statement = $this->db->prepare("SELECT * FROM clases");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getClaseById($id) {
        $statement = $this->db->prepare("SELECT * FROM clases WHERE id = :id");
        $statement->execute(array('id' => $id));
        return $statement->fetch();
    }

    public function getClaseByNombre($nombre) {
        $statement = $this->db->prepare("SELECT * FROM clases WHERE lower(nombre) = :nombre");
        $statement->execute(array('nombre' => $nombre));
        return $statement->fetch();
    }
}
