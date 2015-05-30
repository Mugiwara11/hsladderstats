<?php
namespace Controllers;

use Libs\ModelsInterface;
use Models\Stats;

class saveStatsTotales
{
	public $model;

    public function __construct(ModelsInterface $model) {
        $this->model = $model;
       	$this->model->saveStatsTotales();
    }
}
