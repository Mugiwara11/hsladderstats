<?php
namespace Models;

class BotService
{
    const BOT_API_URL_STATS = 'https://trackobot.com/profile/stats/classes.json?mode=ranked&username={username}&token={token}';
    const BOT_API_URL_CLASS = 'https://trackobot.com/profile/stats/classes.json?as_hero={clase}&mode=ranked&username={username}&token={token}';
	const BOT_API_URL_HISTORIAL = 'https://trackobot.com/profile/history.json?mode=ranked&username={username}&token={token}';

    public $username;
    public $token;

    public function __construct($username, $token) {
        $this->username = $username;
        $this->token = $token;
    }

    private function getJsonFromUrl($url) {
		return json_decode(file_get_contents($url), true);
	}

	public function getArrayTotals() {
		return $this->getJsonFromUrl(str_replace(array('{username}', '{token}'), array($this->username, $this->token), self::BOT_API_URL_STATS));
	}

	public function getArrayClase($clase) {
		return $this->getJsonFromUrl(str_replace(array('{username}', '{token}', '{clase}'), array($this->username, $this->token, $clase), self::BOT_API_URL_CLASS));
	}

    public function getArrayHistorial() {
		return $this->getJsonFromUrl(str_replace(array('{username}', '{token}'), array($this->username, $this->token), self::BOT_API_URL_HISTORIAL));
	}
}
