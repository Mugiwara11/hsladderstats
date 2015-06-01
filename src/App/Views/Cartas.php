<?php
namespace Views;

use Libs\ModelsInterface;
use Models\Historial;

class Cartas
{
	public $model;
	public $data;

	public function __construct(ModelsInterface $model)
	{
		$this->model = $model;
		$this->data = $this->model->getFullHistory();
		$this->printTemplate();
	}

	public function printTemplate() {
		include APP_PATH."\Templates\cartas.html";
	}
}
