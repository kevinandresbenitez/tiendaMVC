<?PHP 

require_once('./models/baseModel.php');

class User{
    use baseModel;

    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $password;
    private $rol;
    private $img;



    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return password_hash($this->db->real_escape_string($this->password),PASSWORD_BCRYPT,['cost'=> 4]);
    }
    public function getRol(){
        return $this->rol;
    }
    public function getImg(){
        return $this->img;
    }

    public function setId($id){
        $this->id = $this->db->real_escape_string($id);
    }
    public function  setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    public function  setApellido($apellido){
        $this->apellido = $this->db->real_escape_string($apellido);
    }
    public function  setEmail($email){
        $this->email = $this->db->real_escape_string($email);
    }
    public function  setPassword($password){
        $this->password = $password;
    }
    public function  setRol($rol){
        $this->rol = $this->db->real_escape_string($rol);
    }
    public function  setImg($img){
        $this->img = $this->db->real_escape_string($img);
    }


    public function save(){
        $count =$this->db->query("SELECT count(id) as count FROM USUARIO WHERE email = '{$this->getEmail()}'");
        $count = mysqli_fetch_row($count)[0];

        if($count > 0){
            return false;
        }

            // save user
        $query= "INSERT INTO USUARIO(nombre,apellido,email,contrasena,rol,image)
        VALUES('{$this->getNombre()}','{$this->getApellido()}','{$this->getEmail()}','{$this->getPassword()}','{$this->getRol()}','NULL');";
        $save= $this->db->query($query);

            // search user 
        $query = "SELECT * FROM USUARIO WHERE email = '$this->email';";
        $user = $this->db->query($query);
        $user =$user->fetch_object();

        return $save ? $user:false;
    }

    public function login(){

        // Verify user exists 
        $query ="SELECT * FROM USUARIO  where email = '$this->email'; ";
        $db = $this->db->query($query);

        if($db && $db->num_rows === 0){
            return false;
        }

        // validate user 
        $userInDatabase =$db->fetch_object();
        $hash = $userInDatabase->contrasena;
        $verify = password_verify($this->password,$hash);

        if($verify){
            return $userInDatabase;
        }else{
            return false;
        }


    }

    public function logout(){
        if($_SESSION['user']){
            unset($_SESSION['user']);
        }
    }
}
