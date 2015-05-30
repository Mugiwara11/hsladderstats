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
            $controller = new Controllers\SaveStatsTotales($model);
            $view = new Views\Indice($model);
        break;
        case 'clase':
            $model = new Models\Stats;
            $controller = new Controllers\SaveStatsVsClase($model);
            $view = new Views\Clase($model);
        break;
        case 'carta':

        break;
        case 'cartas':
            $model = new Models\Historial;
            $controller = new Controllers\SaveHistorial($model);
            $view = new Views\Cartas($model);
        break;
        case 'participa':
            if(!empty($_POST)) {
                $model = new Models\Usuarios;
                $controller = new Controllers\FormularioParticipa($model);
                $view = new Views\FormularioParticipa;
            }
            else {
                $view = new Views\FormularioParticipa;
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
