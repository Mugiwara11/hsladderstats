<?php
namespace Models;

use Libs\ModelsInterface;
use Libs\DatabaseConnector;

class Historial implements ModelsInterface
{

	public $db;

	public function __construct(){
        $this->db = DatabaseConnector::connect();
	}

    public function saveHistory() {
        $model_usuarios = new Usuarios;
		$usuarios = $model_usuarios->getAllUsuarios();

		foreach ($usuarios as $usuario) {
            $bot_service = new BotService($usuario['username'], $usuario['token']);
			$data = $bot_service->getArrayHistorial();
            foreach ($data['history'] as $partida) {
				if(!$this->partidaExist($partida['id'])) {
					$model_clases = new Clases;
					$hero_clase = $model_clases->getClaseByNombre($partida['hero']);
					$opponent_clase = $model_clases->getClaseByNombre($partida['opponent']);
					$fecha = new \DateTime($partida['added']);

					$statement = $this->db->prepare("INSERT INTO partidas (usuarios_id, n_partida, mode, hero_id, opponent_id, coin, result, duration, rank, legend, added) VALUES (:usuarios_id , :n_partida, :mode, :hero_id, :opponent_id, :coin, :result, :duration, :rank, :legend, :added)");
					$values = array(
						"usuarios_id" => $usuario['id'],
						"n_partida" => $partida['id'],
						"mode" => $partida['mode'],
						"hero_id" => $hero_clase['id'],
						"opponent_id" => $opponent_clase['id'],
						"coin" => $partida['coin'],
						"result" => $partida['result'] == 'win' ? 1 : 0,
						"duration" => $partida['duration'],
						"rank" => $partida['rank'],
						"legend" => $partida['legend'],
						"added" => $fecha->getTimestamp()
					);
					if(!$statement->execute($values))
						throw new \Exception('Error al insertar los valores '.$statement->errorInfo());

					$partida_id = $this->db->lastInsertId();
					foreach ($partida['card_history'] as $carta) {
						$statement = $this->db->prepare("INSERT INTO cartas (partidas_id, carta, carta_name, player) VALUES (:partidas_id, :carta, :carta_name, :player)");
						$values = array(
							"partidas_id" => $partida_id,
							"carta" => $carta['card']['id'],
							"carta_name" => $carta['card']['name'],
							"player" => $carta['player']
						);
						if(!$statement->execute($values))
							throw new \Exception('Error al insertar los valores '.$statement->errorInfo());
					}
				}
            }
        }
    }

	public function getFullHistory() {
		// cartas jugadas + resultado + moneda
		$sql = "SELECT cartas.carta_name, sum(partidas.result) as wins, count(partidas.result) as total from cartas
		join partidas on cartas.partidas_id = partidas.id
		where cartas.player = 'me'
		group by cartas.carta_name";
		$statement = $this->db->prepare($sql);
		$statement -> execute();
		return $statement-> fetchAll();
	}

	public function partidaExist($n_partida) {
		$statement = $this->db->prepare("SELECT COUNT(*) FROM partidas WHERE n_partida = :n_partida");
        $statement->execute(array('n_partida' => $n_partida));
        return $statement->fetchColumn() > 0;

	}
}
