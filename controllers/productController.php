<?PHP 

require('./models/Product.php');

class productController{

    public $product;

    public function __construct(){
        $this->product = new Product();
    }

    public function index(){

        if(!Utils::IsAdmin()){
            header('Location: '.base_url);
            exit();  
        }
        

        $products = $this->product->getAll();

        require_once('./views/partials/header.php');
        require_once('./views/partials/aside.php');
        require_once('./views/products/index.php');
        require_once('./views/partials/footer.php');

    }

    public function show(){
        $productos = $this->product->getProductRamdom(9);

        require_once('./views/partials/header.php');
        require_once('./views/partials/aside.php');
        require('./views/products/products.php');
        require_once('./views/partials/footer.php');
    }

    public function create(){
        if(!Utils::IsAdmin()){
            header('Location: '.base_url);
            exit();  
        }
        require_once('./views/partials/header.php');
        require_once('./views/partials/aside.php');
        require('./views/products/create.php');
        require_once('./views/partials/footer.php');

    }

    public function save(){
        if(!Utils::IsAdmin()){
            header('Location: '.base_url);
            exit();  
        }

        $nombre =isset($_POST['nombre']) ? $_POST['nombre']:false ;
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion']:false;
        $precio = isset($_POST['precio']) ? $_POST['precio']:false;
        $stock= isset($_POST['stock']) ? $_POST['stock']:false;
        $categoria =isset($_POST['categoria']) ? $_POST['categoria']:false ;
        $imagen = isset($_FILES['img']) ? $_FILES['img']:false;
        


        if($nombre && $descripcion && $stock && $categoria && $imagen && $precio){
            $this->product->setNombre($nombre);
            $this->product->setDescripcion($descripcion);
            $this->product->setStock($stock);
            $this->product->setPrecio($precio);
            $this->product->setCategoria($categoria);

            if($imagen['type'] == 'image/jpg' || $imagen['type'] == 'image/png' || $imagen['type'] == 'image/jpeg' || $imagen['type'] == 'image/jfif'){
                move_uploaded_file($imagen['tmp_name'], 'assets/img/products/'.$nombre.'.png');
                $this->product->setImg($nombre);
            }


            $save =$this->product->save();       

            header('Location: '.base_url.'product/index');
            exit();   

        }else{
            $error = new sendInfoController();
            $error->error('Necesita completar el formulario');
        }



    }

    public function delete(){
        if(!Utils::IsAdmin()){
            header('Location: '.base_url);
            exit();  
        }

        $id =isset($_GET['id']) ? $_GET['id']:false;

        if($id){
            Utils::deleteImgForId($id);
            $this->product->setId($id);
            $this->product->delete();
            header('Location: '.base_url.'product/index');
            exit();   
        }else{
            $error = new sendInfoController();
            $error->error('Necesita especificar un producto');
        }     

    }

    public function edit(){
        if(!Utils::IsAdmin()){
            header('Location: '.base_url);
            exit();  
        }

        $id =isset($_GET['id']) ? $_GET['id']:false;

        if($id){
            $this->product->setId($id);
            $productos = $this->product->findById();


            require_once('./views/partials/header.php');
            require_once('./views/partials/aside.php');
            require('./views/products/edit.php');
            require_once('./views/partials/footer.php');
        }else{
            $error = new sendInfoController();
            $error->error('Necesita especificar un producto');
        }  

    }

    public function update(){
        if(!Utils::IsAdmin()){
            header('Location: '.base_url);
            exit();  
        }

        $id =isset($_GET['id']) ? $_GET['id']:false ;
        $nombre =isset($_POST['nombre']) ? $_POST['nombre']:false ;
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion']:false;
        $precio = isset($_POST['precio']) ? $_POST['precio']:false;
        $stock= isset($_POST['stock']) ? $_POST['stock']:false;
        $categoria =isset($_POST['categoria']) ? $_POST['categoria']:false ;
        $imagen = isset($_FILES['img']) ? $_FILES['img']:false;
        

        if($nombre  && $stock && $categoria  && $precio && $id){
            $this->product->setId($id);
            $this->product->setNombre($nombre);
            $this->product->setDescripcion($descripcion);
            $this->product->setStock($stock);
            $this->product->setPrecio($precio);
            $this->product->setCategoria($categoria);


            if($imagen &&  $imagen['type'] == 'image/jpg' || $imagen &&  $imagen['type'] == 'image/png'){
                Utils::deleteImgForId($id);
                move_uploaded_file($imagen['tmp_name'], 'assets/img/products/'.$nombre.'.png');
                $this->product->setImg($nombre);
            }


            $this->product->update();       
            header('Location: '.base_url.'product/index');
            exit();   

        }else{
            $error = new sendInfoController();
            $error->error('Necesita completar el formulario');
        }

    }

    public function showByCategory(){

        $id = isset($_GET['id']) ? $_GET['id'] : false;

        if(!Utils::existCategoryId($id)){
            header('Location: '.base_url.'product/show');
            exit();   
        }

        $this->product->setCategoria($id);
        $productos = $this->product->getByIDCategory();
        $categorias = Utils::showCategory($id);
       

        require_once('./views/partials/header.php');
        require_once('./views/partials/aside.php');
        require('./views/products/products.php');
        require_once('./views/partials/footer.php');

    }


    public function showById(){
        $id = isset($_GET['id']) ? $_GET['id'] : false;


        if(!Utils::existProductId($id)){
            header('Location: '.base_url.'product/show');
            exit();   
        }

        $this->product->setId($id);
        $productos = $this->product->findById();
       

        require_once('./views/partials/header.php');
        require_once('./views/partials/aside.php');
        require('./views/products/details.php');
        require_once('./views/partials/footer.php');


    }

}


?>