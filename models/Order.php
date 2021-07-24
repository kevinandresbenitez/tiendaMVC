<?PHP 

require_once('./models/baseModel.php');


class Order{
    use baseModel;


    public $id;
    public $usuario_id;
    public $provincia;
    public $localidad;
    public $direccion;
    public $coste;
    public $estado;
  
    public function getId(){
        return $this->id;
    }
    public function getUsuario(){
        return $this->usuario_id;
    }
    public function getProvincia(){
        return $this->provincia;
    }
    public function getLocalidad(){
        return $this->localidad;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getCoste(){
        return $this->coste;
    }
    public function getEstado(){
        return $this->estado;
    }

    public function setId($id){
        $this->id = $this->db->real_escape_string($id);
    }
    public function setUsuario($id){
        $this->usuario_id = $this->db->real_escape_string($id);
    }
    public function  setProvincia($provincia){
        $this->provincia = $this->db->real_escape_string($provincia);
    }
    public function  setLocalidad($localidad){
        $this->localidad = $this->db->real_escape_string($localidad);
    }
    public function  setDireccion($direccion){
        $this->direccion = $this->db->real_escape_string($direccion);
    }
    public function  setCoste($coste){
        $this->coste = $this->db->real_escape_string($coste);
    }
    public function  setEstado($estado){
        $this->estado = $this->db->real_escape_string($estado);
    }

    public function delete(){
        $query ="DELETE FROM pedido WHERE id = {$this->getId()} ;";
        $this->db->query($query);
    }

    public function findOrder($OneUser = false,$pedidoId = false){
        $query = "SELECT * FROM pedido_linea join pedido on pedido_id = pedido.id ";

        if($OneUser){
            $query.= "  where usuario_id = {$this->getUsuario()}";
        }
        if($pedidoId){
            $query.= " && pedido_id = {$pedidoId}; ";
        }



        $data = $this->db->query($query);
        if($data->num_rows > 0){
            return $data;
        }else{
            return false;
        }

    }
    
    public function save(){
        $query ="INSERT INTO pedido VALUES(null,{$this->getUsuario()},'{$this->getProvincia()}','{$this->getLocalidad()}','{$this->getDireccion()}',{$this->getCoste()},'{$this->getEstado()}',CURRENT_TIMESTAMP());";
        $this->db->query($query);
    }

    public function save_lineas($id_usuario){

            // sobre los pedidos
        $query ="SELECT * FROM pedido where usuario_id = {$id_usuario} ORDER BY id DESC LIMIT 1 ;";
        $data =$this->db->query($query);
        $id_pedido =mysqli_fetch_assoc($data)['id'];


            // sobre los productos
        if(isset($_SESSION['trolley']) && !empty($_SESSION['trolley'])){
            $productos = $this->getAllProducts($_SESSION['trolley']);
            $productNums= $_SESSION['trolley'];
        }else{
            $productos = null;
            $productNums = null;
        }

        while($producto = mysqli_fetch_assoc($productos)){
            $countProduct = null;
            foreach($productNums as $key => $obj){
                if($obj == $producto['id']){
                    $countProduct ++;
                }
            }
                /*Add product in order_line */
            $query = "INSERT INTO pedido_linea values(null,$id_pedido,{$producto['id']},$countProduct )";
            $this->db->query($query);
                /*Reduce product in stock */
            $query = "UPDATE producto SET stock = stock - $countProduct WHERE id = {$producto['id']};";
            $this->db->query($query);

        }



    }

    public function getAllProducts($array){
        $query = "SELECT * FROM producto ";

        if($array){
            $newArray= null ;
            $arrayCouunt = count($array) -1 ;  
            foreach($array as $key => $obj){
                if($key === $arrayCouunt){
                    $newArray .=$obj;
                }else{
                    $newArray .=$obj.',';
                }
            }

            $query.="WHERE ID IN ($newArray)";
        }

        return $this->db->query($query);
    }

    public function update(){
        $query="UPDATE pedido set estado = '{$this->getEstado()}' where id = {$this->getId()} ";
        $this->db->query($query);
    }

}


?>