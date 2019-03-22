<?php
namespace App\Controller;


class CollectorController extends BaseAPIController {       
    
    function InformationsSalle($id_salle){
        return $this->simpleRequest("SELECT * FROM salle WHERE id = ".$id_salle);
        
    }
    
    function meteo($date_debut,$date_fin, $prevision, $listetypeMeteo ){}
         
    
    function DonneeBase($date_debut, $date_fin, $type_lieu, $lieu, $typeDonne){
        /*http://localhost:8000/Data/2017-09-12%20::23::41/2017-09-12%20::23::45/Cluster/4/1 */
        switch ($type_lieu) {
            case "Cluster":               
                return $this->simpleRequest("SELECT valeur,date FROM mesure WHERE
                    date > '".$date_debut."' AND date < '".$date_fin."' AND typeMesure = ".$typeDonne." AND ilot =". $lieu);
                break;
            case "Building":
                return $this->simpleRequest("SELECT valeur,date FROM mesure, ilot, salle WHERE
                    date > '".$date_debut."'
                    AND date < '".$date_fin."' AND typeMesure = ".$typeDonne." AND mesure.ilot = ilot.id 
                    AND ilot.salle = salle.id AND salle.batiment = ". $lieu."");
                break;
            case "Room":
                return $this->simpleRequest("SELECT valeur,date FROM mesure, ilot WHERE
                    date > '".$date_debut."' 
                    AND date < '".$date_fin."' AND typeMesure = ".$typeDonne." AND mesure.ilot = ilot.id AND ilot.salle = ". $lieu."");
                break;
        }
        
    }
    
    function VectorSimple ($dateDebut, $dateFin, $type_lieu, $lieu, $liste_Types_Donne,$liste_Previsions, $liste_Type_Meteos, $methode_Regroupe, $taille_Plage ){
    }
      

    
}

