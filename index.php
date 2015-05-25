<?php
define("ROOT_PATH", dirname(__FILE__).'/');
define("APP_PATH", dirname(__FILE__)."/src/App/");
include APP_PATH."autoload.php";
include APP_PATH."functions.php";
include APP_PATH."config.php";

$partes_url = parser($_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI']);
try {
    switch($partes_url[0]) {
        case '':
            $model = new Models\Stats;
            $controller = new Controllers\SaveStats($model);
            $view = new Views\Indice($model);
        break;
        case 'clase':

        break;
        case 'carta':

        break;
        case 'cartas':

        break;
        case 'participa':
            if(!empty($_POST)) {
                $model = new Models\Usuarios;
                $controller = new Controllers\FormularioParticipa($model);
                $view = new Views\FormularioParticipa($model);
            }
            else {
                $view = new Views\FormularioParticipa();
            }
        break;
        default:
            throw new Exception('Página no encontrada');
        break;
    }
}
catch(Exception $e) {
    die('Error: '.$e->getMessage());
}
