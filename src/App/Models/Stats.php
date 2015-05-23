<?php
use App\Libs\ModelsInterface;
use App\Models\Usuarios;

class Stats implements ModelsInterface
{
	const BOT_API_URL_STATS = 'https://trackobot.com/profile/stats/classes.json?time_range=current_month&username={username}&token={token}';

	public $stats_total;
	public $stats_rogue;
	public $stats_warlock;
	public $stats_warrrior;
	public $stats_druid;
	public $stats_shaman;
	public $stats_hunter;
	public $stats_pala;
	public $stats_priest;
	public $stats_mage;

	public $db;

	public function __construct(){
        $this->db = DatabaseConnector::connect();
	}

	public function saveStats($usuarios){
		$model_usuarios = new Usuarios;
		$usuarios = $model_usuarios->getAllUsuarios();

		foreach ($usuarios as $usuario) {
			$url = $this->createUrlFromUserToken($usuario['username'], $usuario['token']);
			$data = $this->getJsonFromUrl($url);
			// aqui explotas los datos y los metes a la base de datos tal que asi
			$statemet = $this->db->prepare('INSERT INTO nombre_tabla (dato1, dato2, dato3) VALUES (:dato1, :dato2, :dato3)');
			$values = array(
			    "dato1" => $data['dato1'],
			    "dato2" => $data['dato2'],
			    "dato3" => $data['dato3']
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
}
