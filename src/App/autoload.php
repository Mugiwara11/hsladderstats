<?php
function loader($class) {
    $file = APP_PATH.str_replace('\\', '/', $class) . '.php';
    print_r($file);
    if(!file_exists($file))
        throw new Exception('Clase no encontrada');

    require_once $file;
}
spl_autoload_register('loader');
