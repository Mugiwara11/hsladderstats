<?php
namespace Models;

use Libs\ModelsInterface;
use Libs\DatabaseConnector;

class Stats implements ModelsInterface
{
	public $db;
	public $clases;
	public $stats;

	public function __construct(){
        $this->db = DatabaseConnector::connect();
		$model_clases = new Clases;
		$this->clases = $model_clases->getAllClases();
	}

	public function saveStatsTotales(){
		$model_usuarios = new Usuarios;
		$usuarios = $model_usuarios->getAllUsuarios();

		foreach ($usuarios as $usuario) {
			$bot_service = new BotService($usuario['username'], $usuario['token']);
			$data = $bot_service->getArrayTotals();
			$model_usuarios->updateOverall($usuario['id'], $data['stats']['overall']['wins'], $data['stats']['overall']['losses'], $data['stats']['overall']['total']);
			foreach ($this->clases as $clase) {
				$statement = $model_usuarios->userHasPreviousDataTotals($usuario['id'])
					? $this->db->prepare("UPDATE stats_totales SET wins = :wins, losses = :losses, games = :games WHERE clases_id = :clases_id and usuarios_id = :usuarios_id")
					: $this->db->prepare("INSERT INTO stats_totales (usuarios_id, wins, losses, games, clases_id) VALUES (:usuarios_id , :wins, :losses, :games, :clases_id)");
				$values = array(
					"usuarios_id" => $usuario['id'],
					"wins" => $data['stats']['as_class'][$clase['nombre']]['wins'],
					"losses" => $data['stats']['as_class'][$clase['nombre']]['losses'],
					"games" => $data['stats']['as_class'][$clase['nombre']]['total'],
					"clases_id" => $clase['id']
				);
				if(!$statement->execute($values))
					throw new \Exception('Error al insertar los valores');
			}
		}
	}

	public function saveStatsVsClase() {
		$partes_url = parser($_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI']);
		$model_clases = new Clases;
		$clase_stats = $model_clases->getClaseByNombre($partes_url[1]);
		print_r($clase_stats);
		$model_usuarios = new Usuarios;
		$usuarios = $model_usuarios->getAllUsuarios();
		foreach ($usuarios as $usuario) {
			$bot_service = new BotService($usuario['username'], $usuario['token']);
			$data = $bot_service->getArrayClase(strtolower($clase_stats['nombre']));
			foreach ($this->clases as $clase) {
				$statement = $model_usuarios->userHasPreviousDataVsClase($usuario['id'], $clase_stats['id'])
					? $this->db->prepare("UPDATE stats_vs_clases SET wins = :wins, losses = :losses, games = :games WHERE clases_id = :clases_id and usuarios_id = :usuarios_id and vs_clases_id = :vs_clases_id")
					: $this->db->prepare("INSERT INTO stats_vs_clases (usuarios_id, wins, losses, games, clases_id, vs_clases_id) VALUES (:usuarios_id , :wins, :losses, :games, :clases_id, :vs_clases_id)");
				$values = array(
					"usuarios_id" => $usuario['id'],
					"wins" => $data['stats']['vs_class'][$clase['nombre']]['wins'],
					"losses" => $data['stats']['vs_class'][$clase['nombre']]['losses'],
					"games" => $data['stats']['vs_class'][$clase['nombre']]['total'],
					"clases_id" => $clase_stats['id'],
					"vs_clases_id" => $clase['id']
				);
				if(!$statement->execute($values))
					throw new \Exception('Error al insertar los valores');
			}
		}
	}

	public function getAllStats(){
			//winrates
			$data = array();
			foreach ($this->clases as $clase) {
				$gsent = $this->db->prepare("SELECT SUM(wins) as 'Wins', SUM(losses) as 'Losses' FROM stats_totales where clases_id = :clases_id");				
				$gsent->execute(array('clases_id' => $clase['id']));
				array_push($data, $gsent->fetchAll());
			}		
			return $data;
	}

	public function getClaseStats() {
		$partes_url = parser($_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI']);
		$clase = $partes_url[1];
		// winrates clase		
	}
}
