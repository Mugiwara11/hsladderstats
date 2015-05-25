<?php
namespace Libs;

class DatabaseConnector
{
    static $conexion;

    public function connect() {
        if(!self::$conexion) {
	        try {
			   self::$conexion = new \PDO("mysql:host=localhost;port=3306;dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS);
			}
            catch (\PDOException $e) {
			   throw new \Exception('Error en la conexión a la base de datos: '.$e->getMessage());
			}
    	}

    	return self::$conexion;
    }
}
