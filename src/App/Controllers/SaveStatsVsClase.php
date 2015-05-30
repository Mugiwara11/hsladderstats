<?php
namespace Controllers;

use Libs\ModelsInterface;
use Models\Stats;

class saveStatsVsClase
{
	public $model;

    public function __construct(ModelsInterface $model) {
        $this->model = $model;
       	$this->model->saveStatsVsClase();
    }
}
