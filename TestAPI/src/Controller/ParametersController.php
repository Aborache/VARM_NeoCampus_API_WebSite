<?php
namespace App\Controller;


class ParametersController extends BaseAPIController {
    
    
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

