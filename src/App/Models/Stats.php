<?php
use App\Libs\ModelsInterface;

class Stats implements ModelsInterface
{
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

	public function __construct(){
		//conexion bd		
	}

	public function saveStats($array_url_json){
		//guardar datos json en las variables? for recorriendo el array?
	}

}