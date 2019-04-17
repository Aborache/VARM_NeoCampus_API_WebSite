<?php
namespace App\Utils;

use PDO;
use PDOException;
/**
 * 
 * classe dont le role est la gestion de la connexion avec la BD
 *
 */
class DatabaseConnector
{
    protected $conn;
    protected $servername = "localhost";    /*le nom du serveur et son adresse*/
    protected $dbname = "testapiv3";        /*le nom de la base de donn�es */
    protected $username = "root";           /*le nom de l'utilisateur */
    protected $password = "";               /*le mot de passe correspondant � l'utilisateur*/
    
    /**
     * fonction d'initialisation
     * du lien vers la base 
     * de donn�es
     */
    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }
   
    /**
     * fonction permetant de requeter
     * la base de donn�es
     * @param String la requete
     * @return array le r�sultat de la requete
     */
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
    /**
     * fonction permetant de requeter
     * la base de donn�es avec un jeu de requete
     * fonction non test�e et inutilis�e
     * @param array of string le jeu de requetes
     * @return array les r�sultats des requetes
     */
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

