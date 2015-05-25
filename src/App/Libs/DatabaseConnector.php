<?php
namespace Libs;

class DatabaseConnector
{
    static $conexion;

    public function connect() {
        if(!self::$conexion) {
	        try {
			   self::$conexion = new \PDO('mysql:host=localhost;dbname='.DB_NAME, DB_USER, DB_PASS);
			}
            catch (\PDOException $e) {
			   throw new \Exception('Error en la conexión a la base de datos: '.$e->getMessage());
			}
    	}

    	return self::$conexion;
    }
}
