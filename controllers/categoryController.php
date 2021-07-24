<?PHP 

require('./models/Category.php');

class categoryController{

    public $category;

    public function __construct(){
        $this->category = new Category();
    }


    public function index(){
        Utils::IsAdmin();
        $categorias = $this->category->getAll();

        require_once('./views/partials/header.php');
        require_once('./views/partials/aside.php');
        require_once('./views/category/index.php');
        require_once('./views/partials/footer.php');
    }

    public function create(){
        Utils::IsAdmin();

        require_once('./views/partials/header.php');
        require_once('./views/partials/aside.php');
        require_once('./views/category/create.php');
        require_once('./views/partials/footer.php');
    }

    public function save(){
        Utils::IsAdmin();

        $nombre =isset($_POST['nombre']) ? $_POST['nombre']:false ;

        if($nombre){
            $this->category->setNombre($nombre);
            $save =$this->category->save();
            header('Location: '.base_url.'category/index');
            exit();   
        }else{
            $error = new sendInfoController();
            $error->error('Necesita ingresar un nuevo nombre de categoria');
        }        
    }


    public function delete(){
        Utils::IsAdmin();
        $id =isset($_GET['id']) ? $_GET['id']:false;

        if($id){
            $this->category->setId($id);
            $save =$this->category->delete();
            header('Location: '.base_url.'category/index');
            exit();   
        }else{
            $error = new sendInfoController();
            $error->error('Necesita especificar una categoria');
        }     

        
    }


}


?>