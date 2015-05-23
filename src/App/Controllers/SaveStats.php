<?php
use App\Libs\ModelsInterface;
use App\Models\Stats;

class SaveStats
{
	public $model;

    public function __construct(ModelsInterface $model) {
        $this->model = $model;
        //recupero usuarios + token de la bd?
       	$this->model->saveStats(); //array_urls como parametro
    }
}
