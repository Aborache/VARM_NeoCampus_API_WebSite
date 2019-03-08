<?php
namespace App\Utils;

use PDO;
use PDOException;

class DatabaseConnector
{
    protected $conn;
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=neocampusapi", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }
   
    public function request($req){
        try {
            $stmt = $this->conn->prepare($req);
            $stmt->execute();
            $res = $stmt->fetchAll();
            return $res;
        }
        catch(PDOException $e)
        {
            echo "request fail: " . $e->getMessage();
        }
    }
    public function requestsMultiples($reqMultiple){
        $res = array();
        foreach($reqMultiple as $req){
            $stmt = $this->conn->prepare($req);
            $stmt->execute();
            $res[] = $stmt->fetchAll();
        }
        return($res);
    }
}

