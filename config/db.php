<?php
class Database {
    private $host = "localhost";
    private $db_name = "YOUR DATABASE";
    private $username = "YOUR USERNAME";
    private $password = "YOUR PASSWORD";
    public $conn;

    public function getConnection(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $e){
            echo "Connection error :" . $e->getMessage();
        }
        return $this->conn;
    }

}

?>