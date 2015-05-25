<?php
use Libs\ModelsInterface;
use Models\Usuarios;

class FormuarioParticipa
{
    public $model;

    public function __construct(ModelsInterface $model) {
        $this->model = $model;
        try {
            $this->model->saveUser($_POST['username'], $_POST['token']);
        }
        catch(Exception $e) {
            die('te kill you la vida');
        }
    }
}
