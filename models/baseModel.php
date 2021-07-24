<?PHP 

require_once('./config/database/Database.php');

trait baseModel{

    public $db;

    public function __construct(){
        $this->db = Database::connect();
    }



}



?>