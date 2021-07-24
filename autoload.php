<?PHP 

function controller_auto_load($class){


    include_once __DIR__.'/controllers/'.$class.'.php';


}

spl_autoload_register('controller_auto_load');





?>