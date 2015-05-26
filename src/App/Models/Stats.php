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
			$statement = $this->db->prepare("UPDATE stats_totales SET total_wins = :total_wins, total_losses = :total_losses, total_games = :total_games,
			druid_wins = :druid_wins, druid_losses = :druid_losses, druid_games = :druid_games,
			rogue_wins = :rogue_wins, rogue_losses = :rogue_losses, rogue_games = :rogue_games,
			warlock_wins = :warlock_wins, warlock_losses = :warlock_losses, warlock_games = :warlock_games,
			warrior_wins = :warrior_wins, warrior_losses = :warrior_losses, warrior_games = :warrior_games,
			hunter_wins = :hunter_wins, hunter_losses = :hunter_losses, hunter_games = :hunter_games,
			shaman_wins = :shaman_wins, shaman_losses = :shaman_losses, shaman_games = :shaman_games,
			paladin_wins = :paladin_wins, paladin_losses = :paladin_losses, paladin_games = :paladin_games,
			priest_wins = :priest_wins, priest_losses = :priest_losses, priest_games = :priest_games,
			mage_wins = :mage_wins, mage_losses = :mage_losses, mage_games = :mage_games
			WHERE token_usuario = :token");
			$values = array(
			    "total_wins" => $data['stats']['overall']['wins'],
			    "total_losses" => $data['stats']['overall']['losses'],
			    "total_games" => $data['stats']['overall']['total'],
			    "druid_wins" => $data['stats']['as_class']['Druid']['wins'],
			    "druid_losses" => $data['stats']['as_class']['Druid']['losses'],
			    "druid_games" => $data['stats']['as_class']['Druid']['total'],
			    "rogue_wins" => $data['stats']['as_class']['Rogue']['wins'],
			    "rogue_losses" => $data['stats']['as_class']['Rogue']['losses'],
			    "rogue_games" => $data['stats']['as_class']['Rogue']['total'],
			    "warlock_wins" => $data['stats']['as_class']['Warlock']['wins'],
			    "warlock_losses" => $data['stats']['as_class']['Warlock']['losses'],
			    "warlock_games" => $data['stats']['as_class']['Warlock']['total'],
			    "warrior_wins" => $data['stats']['as_class']['Warrior']['wins'],
			    "warrior_losses" => $data['stats']['as_class']['Warrior']['losses'],
			    "warrior_games" => $data['stats']['as_class']['Warrior']['total'],
			    "hunter_wins" => $data['stats']['as_class']['Hunter']['wins'],
			    "hunter_losses" => $data['stats']['as_class']['Hunter']['losses'],
			    "hunter_games" => $data['stats']['as_class']['Hunter']['total'],
			    "shaman_wins" => $data['stats']['as_class']['Shaman']['wins'],
			    "shaman_losses" => $data['stats']['as_class']['Shaman']['losses'],
			    "shaman_games" => $data['stats']['as_class']['Shaman']['total'],
			    "paladin_wins" => $data['stats']['as_class']['Paladin']['wins'],
			    "paladin_losses" => $data['stats']['as_class']['Paladin']['losses'],
			    "paladin_games" => $data['stats']['as_class']['Paladin']['total'],
			    "priest_wins" => $data['stats']['as_class']['Priest']['wins'],
			    "priest_losses" => $data['stats']['as_class']['Priest']['losses'],
			    "priest_games" => $data['stats']['as_class']['Priest']['total'],
			    "mage_wins" => $data['stats']['as_class']['Mage']['wins'],
			    "mage_losses" => $data['stats']['as_class']['Mage']['losses'],
			    "mage_games" => $data['stats']['as_class']['Mage']['total'],
			    "token" => $usuario['token']
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
		//winrates
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
