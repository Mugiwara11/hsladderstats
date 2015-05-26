<?php
namespace Views;

use Libs\ModelsInterface;
use Models\Stats;

class Indice
{
	public $model;
	public $data;

	public function __construct(ModelsInterface $model)
	{		
		$this->model = $model;
		var_dump($model);
		$this->data = $this->model->getAllStats();
		var_dump($data);
		$this->printTemplate();
	}

	public function printTemplate() {
		include APP_PATH."\Templates\indice.html";
	}
}
