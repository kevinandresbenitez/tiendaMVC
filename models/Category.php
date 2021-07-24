<?PHP 

require_once('./models/baseModel.php');

class Category{
    use baseModel;
    public  $id;
    public $nombre ;


    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }

    public function setId($id){
        $this->id = $this->db->real_escape_string($id);
    }
    public function  setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }


    public function getAll(){
        $category = $this->db->query('SELECT * FROM categoria');
        return $category;
    }

    public function save(){
        $query= "INSERT INTO categoria(nombre) values('{$this->getNombre()}');";
        $save = $this->db->query($query);
        return $save;
    }

    public function delete(){
        $query ="DELETE FROM CATEGORIA WHERE id = {$this->getId()} ;";
        $this->db->query($query);
    }

}


?>