<?php
use Libs\ModelsInterface;
use Models\Usuarios;

class Stats implements ModelsInterface
{
	const BOT_API_URL_STATS = 'https://trackobot.com/profile/stats/classes.json?mode=ranked&time_range=current_month&username={username}&token={token}';

	public $data;
	public $db;

	public function __construct(){
        $this->db = DatabaseConnector::connect();
	}

	public function saveStats($usuarios){
		$model_usuarios = new Usuarios;
		$usuarios = $model_usuarios->getAllUsuarios();

		foreach ($usuarios as $usuario) {
			$url = $this->createUrlFromUserToken($usuario['username'], $usuario['token']);
			$this->$data = $this->getJsonFromUrl($url);
			$data_totales = $data[0];
			// aqui explotas los datos y los metes a la base de datos tal que asi
			$statemet = $this->db->prepare('INSERT INTO stats_totales (total_wins, total_losses, total_games) VALUES (:dato1, :dato2, :dato3)');
			$values = array(
			    "dato1" => $data_totales[0], //'dato1'
			    "dato2" => $data_totales[1], //'dato2'
			    "dato3" => $data_totales[2] //'dato3'
			);
			if(!$statement->execute($values))
				throw new Exception('Error al insertar los valores');
		}
	}

	private function getJsonFromUrl($url) {
		return json_decode(file_get_contents($url));
	}

	private function createUrlFromUserToken($username, $token) {
		return str_replace(array('{username}', '{token}'), array($username, $token), self::BOT_API_URL_STATS);
	}

	public function getStats(){
		return $data;
	}
}
