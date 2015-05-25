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
		echo 'estoy en indice.php';
		$this->model = $model;
		$this->data = $this->model->getAllStats();
		$this->printTemplate();
	}

	public function printTemplate() {
		include APP_PATH."\Templates\indice.html";
	}
}
