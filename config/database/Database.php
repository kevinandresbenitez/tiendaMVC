<?PHP

class Database{

    public static function connect(){
        $db = new mysqli('localhost','root','','tiendamvc');
        $db->query("SET NAMES 'utf8' ");
        return $db;
    }


}


?>