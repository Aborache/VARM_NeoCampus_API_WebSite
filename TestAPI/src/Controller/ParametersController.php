<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Utils\DatabaseConnector;

class ParametersController extends Controller
{
    protected $db = Null;
    
    private function checkDB(){
        if ($this->db == NULL){
            $this->db = new DatabaseConnector();
        }
    }
    
    private function simpleRequest($req){
        $this->checkDB();
        
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
    
    function Batiments(){
        return $this->simpleRequest("SELECT * FROM batiment");       
    }
    
    function Salles($id_batiment){
        return $this->simpleRequest("SELECT id, nomSalle FROM salle WHERE batiment = ".$id_batiment );
    }
    
    function Ilots($id_salle){
        return $this->simpleRequest("SELECT * FROM ilot WHERE salle = ".$id_salle );
    }
    function listeTypesdonnes(){
        return $this->simpleRequest("SELECT * FROM typemesure" );                      
    }
    function listeTypesMeteo(){
        $response = $this->render('retour.csv.twig',[
            'tableau' => array("temperature","humidite","pression","ventDirection","ventVitesse","nuage","precipitation ","tempsGeneral","sunrise","sunset"),
            'nbLigne' => 1, 	
            'legende' => "types of meteo informations"
        ]);
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="export.csv"');
        return $response;
        
    }
    function listePrevisions(){
        $response = $this->render('retour.csv.twig',[
            'tableau' => array("actuel","30minutes","2heures","8heures","24heures"),
            'nbLigne' => 1,
            'legende' => "times of predictions"
        ]);
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="export.csv"');
        return $response;
        
    }
    

    
}

