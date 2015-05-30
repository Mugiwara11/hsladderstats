<?php
namespace Views;

use Libs\ModelsInterface;
use Models\Stats;

class Clase
{
	public $model;
	public $data;

	public function __construct(ModelsInterface $model)
	{
		$this->model = $model;
		$this->data = $this->model->getClaseStats();
		$this->printTemplate();
	}

	public function printTemplate() {
		include APP_PATH."\Templates\clase.html";
	}
}
