<?php
use Libs\ModelsInterface;
use Models\Stats;

class Indice
{	
	public $model;
	public $data;

	public function __construct(ModelsInterface $model)
	{
		$this->model = $model;
		$this->data = $this->model->getStats();	
	}
}