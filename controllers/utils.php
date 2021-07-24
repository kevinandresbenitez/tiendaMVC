<?PHP 
    include_once( './models/Category.php');
    include_once( './models/Product.php');

    class Utils{


        static public function IsAdmin(){

            if(isset($_SESSION['user']) && $_SESSION['user']->rol === 'Admin'){
                return true ;
            }else{
                return false;
            }

        }

        static public function IsUser(){
         
            if(isset($_SESSION['user'])){
                return true ;
            }else{
                return false;
            }
        }

        static public function showCategory($id = null){
            $query= 'SELECT * FROM categoria ';


            if($id){
                $query.="WHERE id = {$id} ;";
            }

            $categorias = new Category();            
            $categorias = $categorias->db->query($query);
            return $categorias; 
        }

        static public function deleteImgForId($id){
            $product = new Product();
            $product->setId($id);
            $productAfter = $product->findById();
            $productIMG = mysqli_fetch_assoc($productAfter)['img'];
    
            if(file_exists("./assets/img/products/".$productIMG.".png")){
                unlink("./assets/img/products/".$productIMG.".png");
            }
        }

        static public function existCategoryId($id){
            $categorias = new Category();
            $categorias = $categorias->db->query("SELECT * FROM categoria WHERE id = $id");


            if($categorias && $categorias->num_rows > 0){
                return true;
            }else{
                return false;
            }

        }

        static public function existProductId($id){
            $query = "SELECT * FROM producto WHERE id = $id ;";
            $productos = new Product();
            $producto = $productos->db->query($query);

            if($producto && $producto->num_rows > 0){
                return true;
            }else{
                return false;
            }

        }

        static public function trolleyCount(){

            if(isset($_SESSION['trolley']) && !empty($_SESSION['trolley'])){
                return  count($_SESSION['trolley']);
            }else{
                return null;
            }

        }

        static public function trolleyCash(){
            
            if(isset($_SESSION['trolley']) && !empty($_SESSION['trolley'])){
                $productos = new Product();
                $productos = $productos->getAll($_SESSION['trolley']);
                $productNums= $_SESSION['trolley'];
    
                $precioFinal=null;
                                
                while($producto = mysqli_fetch_assoc($productos)){
                    $count = null;
                    foreach($productNums as $key => $obj){
                        if($obj == $producto['id']){
                            $count ++;
                        }

                    }

                    $precioFinal += $producto['precio'] * $count ;
                }

                return $precioFinal;

            }else{
                return null;
            }
        }

        static public function showProductByID($id){
            $query = "SELECT * FROM producto where id = $id";
            $producto = new Product();
            return $producto->db->query($query);            
        }



        
    }
