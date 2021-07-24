<?PHP

    session_start();

    include('./autoload.php');
    require_once('./config/parameters.php');

    
    $controller = (isset($_GET['controller']) ? $_GET['controller'].'Controller':controller_default);        

    
    if(class_exists($controller)){
        if(isset($_GET['action']) && method_exists($controller,$_GET['action'])){
            $action = $_GET['action'];                
        }else{
            $controller = controller_default;
            $action = action_default;                
        }      
        

    }else{


        header('Location: '.base_url);
        exit();
        // $errorPage = new sendInfoController();
        // $errorPage->error('Esta clase no existe');
    }


    $controller = new $controller();
    $controller->$action();

?>