<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Utils\DatabaseConnector;

class BaseAPIController extends AbstractController
{
    protected $db = Null;

    public function __construct(){ 
        $this->db = new DatabaseConnector();
        
    }
    
    protected function simpleRequest($req){
        
        $stmt = $this->db->request($req);
        $attributlist = array_keys($stmt[0]);
        $leg = ""; //"id".  ";" . "valeur" . ";" . "date";
        $bug = true;
        
        foreach ($attributlist as $attribut){
            if ($bug) {
                $leg = $leg . $attribut . ";" ;
            }
            $bug = ! $bug;
        }
        
        $tab = array();
        $pos = 0;
        foreach ($stmt as $row){
            $ligne = "";
            foreach ($row as $elem){
                if ($bug) {
                    $ligne = $ligne . $elem . ";" ;
                }
                $bug = ! $bug;
            }
            $tab[$pos] = $ligne;
            $pos++;
        }
        $response = $this->render('retour.csv.twig',[
            'tableau' => $tab,
            'nbLigne' => $pos,
            'legende' => $leg
        ]);
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="export.csv"');
        return $response;
        
    }
}

