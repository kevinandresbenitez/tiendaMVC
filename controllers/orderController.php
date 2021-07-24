<?PHP 

require('./models/Order.php');

class orderController{

    public $order;

    public function __construct(){
        $this->order = new Order();
    }

    public function index(){

        if(!Utils::IsAdmin()){
            header('Location: '.base_url);
            exit();  
        }

        $orders =$this->order->findOrder();

        require_once('./views/partials/header.php');
        require_once('./views/partials/aside.php');
        require_once('./views/order/index.php');
        require_once('./views/partials/footer.php');



    }

    public function create(){

        if(!Utils::IsUser()){
            $mensaje = new sendInfoController();
            $mensaje = $mensaje->sendMenseje('Necesita estar registrado para poder realizar la compra');
            die();
        }

        require_once('./views/partials/header.php');
        require_once('./views/partials/aside.php');
        require_once('./views/order/create.php');
        require_once('./views/partials/footer.php');

    }

    public function details(){

        if(!Utils::IsUser()){
            header('Location: '.base_url);
            die();
        }

        $productID =isset($_GET['id']) ? $_GET['id']:false;

        if($productID){
            $this->order->setUsuario($_SESSION['user']->id);
            
            if($_SESSION['user']->rol === 'Admin'){
                $orders = $this->order->findOrder(false,$productID);
            }else{
                $orders = $this->order->findOrder(true,$productID);
            }

            if(!$orders){
                header('Location: '.base_url);
                die();
            }
            
        }else{
            header('Location: '.base_url);
            die();
        }
    


        require_once('./views/partials/header.php');
        require_once('./views/partials/aside.php');
        require_once('./views/order/details.php');
        require_once('./views/partials/footer.php');

    }

    public function update(){
        $id = isset($_GET['id']) ? $_GET['id']:false;
        $option =isset($_GET['option']) ? $_GET['option']:false;

        if(!Utils::IsAdmin()){
            header('Location: '.base_url);
            exit();  
        }
        $this->order->setId($id);
        $this->order->setEstado($option);
        $this->order->update();

        header('Location: '.base_url.'order/index');
        exit();          
    
    }

    public function show(){

        if(!Utils::IsUser()){
            header('Location: '.base_url);
            exit();  
        }

        $this->order->setUsuario($_SESSION['user']->id);
        $orders =$this->order->findOrder(true);


        require_once('./views/partials/header.php');
        require_once('./views/partials/aside.php');
        require_once('./views/order/show.php');
        require_once('./views/partials/footer.php');

    }

    public function save(){
        if(!Utils::IsUser()){
            header('Location: '.base_url);
            exit();  
        } 
        
        $id_usuario=$_SESSION['user']->id;
        $provincia =isset($_POST['provincia']) ? $_POST['provincia']:false ;
        $localidad = isset($_POST['localidad']) ? $_POST['localidad']:false;
        $direccion= isset($_POST['direccion']) ? $_POST['direccion']:false;
        $coste = Utils::trolleyCash();
        $estado = 'En espera';


        if($id_usuario && $provincia && $localidad && $direccion && $coste && $estado){
            $this->order->setUsuario($id_usuario);
            $this->order->setProvincia($provincia);
            $this->order->setLocalidad($localidad);
            $this->order->setDireccion($direccion);
            $this->order->setCoste($coste);
            $this->order->setEstado($estado);
            $this->order->save();
            $this->order->save_lineas($id_usuario);

            if(isset($_SESSION['trolley'])){
                unset($_SESSION['trolley']);            
            }



            $_SESSION['confirmation'] = true;
            header('Location: '.base_url.'order/show');
            exit();   
        }else{
            $error = new sendInfoController();
            $error->error('Necesita completar el formulario');
        }


    }


}


?>