<?PHP 

/* require product model */

require('./models/Product.php');

class trolleyController{

    public $product;

    public function __construct(){
        $this->product = new Product();
    }

    public function index(){



        if(isset($_SESSION['trolley']) && !empty($_SESSION['trolley'])){
            $productos = $this->product->getAll($_SESSION['trolley']);
            $productNums= $_SESSION['trolley'];
        }else{
            $productos = null;
            $productNums = null;
        }


        require_once('./views/partials/header.php');
        require_once('./views/partials/aside.php');
        require('./views/trolley/index.php');
        require_once('./views/partials/footer.php');
    }

    public function add(){
        $id = isset($_GET['id']) ? $_GET['id'] : false;
        $RedirectToTrolley = isset($_GET['redirect']) ? $_GET['redirect'] : false;

        if(!Utils::existProductId($id)){
            header('Location: '.base_url.'product/show');
            exit();   
        }

        if(isset($_SESSION['trolley'])){
            array_push($_SESSION['trolley'] , $id);
        }else{
            $_SESSION['trolley'] = array($id);
        }

        if($RedirectToTrolley){
            header('Location: '.base_url.'trolley/index');
            exit();  
        }else{
            header('Location: '.base_url.'product/show');
            exit();  
        }

 
        

    }

    public function delete(){
        $id = isset($_GET['id']) ? $_GET['id'] : false;

        var_dump($_SESSION['trolley']);
        
        if(isset($_SESSION['trolley'])){
            $key = (array_search($id,$_SESSION['trolley']));

            $array =$_SESSION['trolley'];
            unset($array[$key]);
            $_SESSION['trolley']=array_values($array);
        }


        header('Location: '.base_url.'trolley/index');
        exit();   

    }


    public function destroy(){
        
        if(isset($_SESSION['trolley'])){
            unset($_SESSION['trolley']);            
        }
        
        header('Location: '.base_url.'trolley/index');
        exit();   
    }

}

?>