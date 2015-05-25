<?php
namespace Models;

use Libs\ModelsInterface;
use Libs\DatabaseConnector;

class Stats implements ModelsInterface
{
	const BOT_API_URL_STATS = 'https://trackobot.com/profile/stats/classes.json?mode=ranked&time_range=current_month&username={username}&token={token}';

	public $db;

	public function __construct(){
        $this->db = DatabaseConnector::connect();
	}

	public function saveStats(){
		$model_usuarios = new Usuarios;
		$usuarios = $model_usuarios->getAllUsuarios();

		foreach ($usuarios as $usuario) {
			print_r($usuario['username']);
			$url = $this->createUrlFromUserToken($usuario['username'], $usuario['token']);
			$data = $this->getJsonFromUrl($url);
			// aqui explotas los datos y los metes a la base de datos tal que asi
			$statement = $this->db->prepare("UPDATE stats_totales (total_wins, total_losses, total_games) SET (:total_wins, :total_losses, :total_games) WHERE 'stats_totales.token_usuario' ='".$usuario['token']."'");
			$values = array(
			    "total_wins" => $data['stats']['overall']['wins'],
			    "total_losses" => $data['stats']['overall']['losses'],
			    "total_games" => $data['stats']['overall']['total']
			);
			if(!$statement->execute($values))
				throw new \Exception('Error al insertar los valores');
		}
	}

	private function getJsonFromUrl($url) {
		return json_decode(file_get_contents($url), true);
	}

	private function createUrlFromUserToken($username, $token) {
		return str_replace(array('{username}', '{token}'), array($username, $token), self::BOT_API_URL_STATS);
	}

	public function getAllStats(){
		$gsent = $this->db->prepare("SELECT (total_wins, total_losses, total_games) FROM stats_totales");
        $gsent->execute();
        return $gsent->fetchAll();
	}
}
