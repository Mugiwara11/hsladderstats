<?php
namespace Models;

use Libs\ModelsInterface;
use Libs\DatabaseConnector;

class Stats implements ModelsInterface
{
	const BOT_API_URL_STATS = 'https://trackobot.com/profile/stats/classes.json?mode=ranked&username={username}&token={token}'; //Eliminado el mes por abella que no tiene partidas xD

	public $db;

	public function __construct(){
        $this->db = DatabaseConnector::connect();
	}

	public function saveStats(){
		$model_usuarios = new Usuarios;
		$usuarios = $model_usuarios->getAllUsuarios();

		foreach ($usuarios as $usuario) {
			$url = $this->createUrlFromUserToken($usuario['username'], $usuario['token']);
			$data = $this->getJsonFromUrl($url);
			$clases = array("Druid", "Rogue", "Warlock", "Warrior", "Shaman", "Hunter", "Paladin", "Priest", "Mage");
			$statement = $this->db->prepare("SELECT COUNT(*) FROM stats_totales");
			$statement->execute();
			$vacio = $statement->fetchAll();					
			foreach($clases as $clase){
				if($vacio[0][0] < 18){
					$statement = $this->db->prepare("INSERT INTO stats_totales (token, wins, losses, games, class) VALUES (:token , :wins, :losses, :games, :class)");				
					$values = array(
						"token" => $usuario['token'],
						"wins" => $data['stats']['as_class'][$clase]['wins'],
						"losses" => $data['stats']['as_class'][$clase]['losses'],
						"games" => $data['stats']['as_class'][$clase]['total'],
					   	"class" => $clase
					);
					if(!$statement->execute($values))
					throw new \Exception('Error al insertar los valores');
				}else{
					$statement = $this->db->prepare("UPDATE stats_totales SET wins = :wins, losses = :losses, games = :games WHERE class = :class and token = :token");				
					$values = array(
						"token" => $usuario['token'],
						"wins" => $data['stats']['as_class'][$clase]['wins'],
						"losses" => $data['stats']['as_class'][$clase]['losses'],
						"games" => $data['stats']['as_class'][$clase]['total'],
					   	"class" => $clase
					);
					if(!$statement->execute($values))
					throw new \Exception('Error al insertar los valores');
				}			
			}			
			
		}
	}

	private function getJsonFromUrl($url) {
		return json_decode(file_get_contents($url), true);
	}

	private function createUrlFromUserToken($username, $token) {
		return str_replace(array('{username}', '{token}'), array($username, $token), self::BOT_API_URL_STATS);
	}

	public function getAllStats(){
		//winrates
		$clases = array("Druid", "Rogue", "Warlock", "Warrior", "Shaman", "Hunter", "Paladin", "Priest", "Mage");
		foreach($clases as $clase){

		}
		$gsent = $this->db->prepare("SELECT SUM(total_wins),SUM(total_losses),SUM(total_games),
		SUM(druid_wins),SUM(druid_losses),SUM(druid_games),
		SUM(rogue_wins),SUM(rogue_losses),SUM(rogue_games),
		SUM(warlock_wins),SUM(warlock_losses),SUM(warlock_games),
		SUM(warrior_wins),SUM(warrior_losses),SUM(warrior_games),
		SUM(hunter_wins),SUM(hunter_losses),SUM(hunter_games),
		SUM(shaman_wins),SUM(shaman_losses),SUM(shaman_games),
		SUM(paladin_wins),SUM(paladin_losses),SUM(paladin_games),
		SUM(priest_wins),SUM(priest_losses),SUM(priest_games),
		SUM(mage_wins),SUM(mage_losses),SUM(mage_games)
		FROM stats_totales");
        $gsent->execute();
        return $gsent->fetchAll();
	}
}
