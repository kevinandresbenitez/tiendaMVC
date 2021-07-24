<?PHP 

include_once('./models/User.php');

class userController{

    public $user;

    public function __construct(){
        $this->user = new User();
    }

    public function login(){
        $email = isset($_POST['email']) ? $_POST['email']:false;
        $contraseña= isset($_POST['contrasena']) ? $_POST['contrasena']:false;  

        /*if user exist redirect else include headers and send menseje*/

        if($email && $contraseña){
            $this->user->setEmail($email);
            $this->user->setPassword($contraseña);
            $login =$this->user->login();

            if($login){
                $_SESSION['user']=$login; 
                header('Location: '.base_url);
                exit();   
            }else{
                $error = new sendInfoController();
                $error->error('Usuario no encontrado');
            }

        }else{
            $error = new sendInfoController();
            $error->error('Necesita completar el formulario');
        }

    }

    public function save(){
        $nombre =isset($_POST['nombre']) ? $_POST['nombre']:false ;
        $email = isset($_POST['email']) ? $_POST['email']:false;
        $contraseña= isset($_POST['contrasena']) ? $_POST['contrasena']:false;
        
        if($nombre && $email && $contraseña){
            $this->user->setNombre($nombre);
            $this->user->setEmail($email);
            $this->user->setPassword($contraseña);
            $save =$this->user->save();

            if($save){
                $_SESSION['user']=$save; 
                header('Location: '.base_url);
                exit();   
            }else{
                $error = new sendInfoController();
                $error->error('Este usuario se encuentra registrado');
            }        
        }else{
            $error = new sendInfoController();
            $error->error('Necesita completar el formulario');
        }



    }

    public function logout(){
        $this->user->logout();     
        header('Location: '.base_url);
        exit();   
    }

    

}


?>