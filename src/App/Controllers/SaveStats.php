<?php
use Libs\ModelsInterface;
use Models\Stats;

class SaveStats
{
	public $model;

    public function __construct(ModelsInterface $model) {
        $this->model = $model;
        //recupero usuarios + token de la bd?
       	$this->model->saveStats(); //array_urls como parametro
    }
}
