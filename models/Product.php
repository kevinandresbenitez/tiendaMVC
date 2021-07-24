<?PHP 

require_once('./models/baseModel.php');

class Product{
    use baseModel;

    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $oferta;
    private $stock;
    private $img;


    public function getId(){
        return $this->id;
    }
    public function getCategoriaId(){
        return $this->categoria_id;
    }
    
    public function getNombre(){
        return $this->nombre;
    }
    
    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function getOferta(){
        return $this->oferta;
    }

    public function getStock(){
        return $this->stock;
    }
    public function getImg(){
        return $this->img;
    }


    public function setId($id){
        $this->id = $id;
    }
    public function setCategoria($categoria_id){
        $this->categoria_id = $categoria_id;
    }
    
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion; 
    }

    public function setPrecio($precio){
       $this->precio = $precio;
    }

    public function setOferta($oferta){
        $this->oferta = $oferta;
    }

    public function setStock($stock){
       $this->stock = $stock;
    }

    public function setImg($img){
        $this->img = $img;
     }


    public function save (){
        $query ="INSERT INTO producto VALUES(null,{$this->getCategoriaId()},'{$this->getNombre()}','{$this->getDescripcion()}',{$this->getPrecio()},null,{$this->getStock()},CURRENT_TIMESTAMP(),'{$this->getImg()}');";
        $this->db->query($query);
    }

    public function update(){
        $query ="UPDATE producto SET categoria_id = {$this->getCategoriaId()},nombre = '{$this->getNombre()}',descripcion = '{$this->getDescripcion()}',precio = {$this->getPrecio()},stock = {$this->getStock()}";

        if($this->getImg()){
            $query.= ",img = '{$this->getImg()}' ";
        }
        
        $query .= "  WHERE id = {$this->getId()};";

        $this->db->query($query);
    }

    public function getAll($array = null){
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

    public function getProductRamdom($limit = 9){
        $query = "SELECT * FROM producto ORDER BY rand() limit $limit";
        return $this->db->query($query);
    }

    public function getByIDCategory($limit = 9){
        $query = "SELECT * FROM producto WHERE categoria_id = {$this->getCategoriaId()}  ORDER BY rand() limit $limit ;";
        return $this->db->query($query);
    }
 
    public function delete(){
        $query ="DELETE FROM producto WHERE id = {$this->getId()} ;";
        $this->db->query($query);
    }

    public function findById(){
        $query= "SELECT * FROM producto WHERE id = {$this->getId()}";
        return $this->db->query($query);
    }

}





?>