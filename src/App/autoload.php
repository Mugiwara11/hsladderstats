<?php
function loader($class) {
    $file = APP_PATH.str_replace('\\', '/', $class) . '.php';
    if(!file_exists($file)) {
        throw new Exception('Clase no encontrada: '.$file);

    }

    require_once $file;
}
spl_autoload_register('loader');
